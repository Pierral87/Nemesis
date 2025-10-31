<?php

/*

On peut aussi simplement stocker les informations dans un fichier s'il n'y a rien de sensible grâce aux fonctions "f"   fopen fwrite fclose pour manipuler des fichiers 
Structure du code avec fichier

Les données seront enregistrées dans un fichier texte (par exemple commentaires.txt) sous forme de lignes, chaque ligne représentant un enregistrement avec le format :
    pseudo|message|date

*/

$req = '';
// - 04 - Récupération des saisies du form avec controle 
if (isset($_POST['pseudo']) && isset($_POST['message'])) {
    $pseudo = trim($_POST['pseudo']);
    $message = trim($_POST['message']);
    $date = date('d/m/Y à H:i:s');

    // Préparation de la ligne à écrire
    $ligne = "$pseudo|$message|$date" . PHP_EOL;

    // Ouverture du fichier en mode ajout
    $fichier = fopen('commentaires.txt', 'a');
    if ($fichier) {
        fwrite($fichier, $ligne);
        fclose($fichier);
    }
}

// - 06 - Requete de récupération des messages afin de les afficher dans cette page
$commentaires = [];
if (file_exists('commentaires.txt')) {
    // Lecture des lignes du fichier
    $lignes = file('commentaires.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lignes as $ligne) {
        // Chaque ligne est séparée par des "|"
        list($pseudo, $message, $date) = explode('|', $ligne);
        $commentaires[] = [
            'pseudo' => htmlspecialchars($pseudo),
            'message' => htmlspecialchars($message),
            'date' => htmlspecialchars($date),
        ];
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Playfair display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>

    <title>Dialogue</title>
</head>

<body class="bg-secondary">
    <div class="container bg-light g-0">
        <div class='row '>
            <div class="col-12">
                <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>
                <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">

                    <?php echo $req; // on affiche la requete pour voir les injections SQL 
                    ?>

                    <hr>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo <i class="fas fa-user-alt"></i></label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message <i class="fas fa-feather-alt"></i></label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="mb-3">
                        <hr>
                        <button type="submit" class="btn btn-secondary w-100" id="enregistrer" name="enregistrer"><i class="fas fa-keyboard"></i> Enregistrer <i class="fas fa-keyboard"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class='row mt-5'>
            <div class="col-12">
                <!-- Affichage des commentaire -->
                <p class="w-75 mx-auto mb-3"><?php
                                                // - 08 - Affichage en haut des messages du nombre de message présent dans la bdd
                                                echo 'il y a : <b>' . sizeof($commentaires) . '</b> messages';
                                                ?></p>
                <?php
                // var_dump($commentaires);
                // - 07 - Affichage des commentaire avec un peu mise en forme
                foreach ($commentaires as $commentaire) {
                    echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' . htmlspecialchars($commentaire['message']) . '</p>
                                    </div>
                                </div>';
                }


                ?>

            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>