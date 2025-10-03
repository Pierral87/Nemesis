<?php

/* 

    $_FILES est une superglobale en PHP, encore une fois un array !  

    Elle est utilisée pour récupérer des pièces jointes dans des formulaires HTML 

    ATTENTION, il y a un attribut à rajouter dans la balise form pour permettre la récupération des pièces jointes : enctype="multipart/form-data" 

    $_FILES est un array associatif avec les clés qui représentent les informations de notre fichier 

*/

var_dump($_POST);
var_dump($_FILES);

$uploadDir = "upload/";
$uploadMessage = "";

// Extensions autorisées 
$extensions = ["jpg", "jpeg", "png", "gif"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["fichier"]["tmp_name"]; // Ici on récupère la représentation physique de notre pièce jointe, il faut la traiter avant la fin du script ! sinon le fichier sera perdu
        $fileName = $_FILES["fichier"]["name"]; // Je récupère ici le nom du fichier, pourquoi ? Car je vais vouloir appliquer quelques filtres sur ce nom de fichier 
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Ici je récupère l'extension du fichier pour pouvoir la comparer à mes extensions autorisées
        // var_dump($fileExtension);

        // Vérification de l'extension du fichier 
        if (in_array($fileExtension, $extensions)) {

            // Filtrage du nom du fichier par une regex 
            $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName);

            // Ajout d'un uniqid devant le nom du fichier pour éviter les collisions avec des fichiers de même nom 
            $fileName = uniqid() . "_" . $fileName;

            var_dump($fileName);

            

            $destPath = $uploadDir . $fileName; // Je modélise ici la destination du fichier, c'est à dire le chemin /dossier/nomdufichier.extension

            if (move_uploaded_file($fileTmpPath, $destPath)) { // move_uploaded_file permet de déplacer un fichier temporaire (correspond au tmp_name de l'upload) vers un autre path (path défini au dessus) Si ça renvoie true, le déplacement a fonctionné ! Le fichier est bien uploadé ! 
                $uploadMessage = "Fichier envoyé avec succès !";
            } else { // Sinon, erreur d'upload 
                $uploadMessage = "Erreur d'upload de fichier !";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Upload de fichier</h1>

                <!-- <?= $uploadMessage ?> -->

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Sélectionnez un fichier à télécharger</label>
                        <input type="file" class="form-control" id="fichier" name="fichier">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>