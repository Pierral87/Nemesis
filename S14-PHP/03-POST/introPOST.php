<?php 


/*

Le protocole POST est l'un des deux principaux protocoles utilisés pour envoyer des données d'un navigateur web vers un serveur, l'autre on le connait, c'est GET  ! 
Contrairement à GET qui envoie les données dans l'URL, POST les envoie lui dans le corps de la requête HTTP, ce qui permet de transmettre des informations plus sensibles mais aussi plus volumineuses. POST est beaucoup plus sécurisé que GET

        Transmission de données : 
            POST est principalement utilisé pour envoyer des données qui ne doivent pas être visibles dans l'URL, comme des formulaires d'inscription avec des données perso (notamment les password, les systèmes de paiement)
            Telechargement de fichiers également ça passe par POST. 

        Sécurisation des données :
            POST est privilégié pour l'envoi de données sensibles, elles ne seront pas visibles par l'utilisateur, ce qui offre un certains degré de protection. Egalement pas de limite de taille sur les envoies POST 
            
        Syntaxe d'utilisation de POST en PHP : 
            En PHP, lorsque l'on utilise un form en méthode POST, alors nous avons accès à ces informations via une superglobale nommée $_POST, encore une fois, c'est un tableau array 

        Tout comme $_GET on fera une vérification isset() pour être sûr de lancer les traitements uniquement lorsque j'ai bien tous les éléments attendus
        MAIS AUSSI, on fera une vérification de type if($_SERVER["REQUEST_METHOD"] == "POST")
        $_SERVER est une superglobale contenant nombreuses informations sur le client et le serveur 

*/

// var_dump($_SERVER);

var_dump($_POST);

$content = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["name"], $_POST["email"], $_POST["message"] )) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $content = "
    <div class='card'>
        <div class='card-header bg-primary text-white'>
            <h5>Informations reçues</h5>
        </div>
        <div class='card-body'>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong> $message</p>
        </div>
    </div>";
}
// else {
//     $content .= "Méthode non autorisée.";
// }



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire avec POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Contactez-nous</h1>
                <!-- Dans la balise form, il faut renseigner l'attribut method pour lui mettre method="POST" -->
                 <!-- Si je ne mets pas method POST je serai pas défaut en GET -->
                <form action="" method="POST" class="mb-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <!-- attribut obligatoire à mettre dans nos input/textarea et tous les autres, le name !!
                         Si je ne renseigne pas le name alors je ne récupèrerai jamais les saisies de ce champ -->
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

                <!-- Affichage des informations soumises -->
                <?= $content ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>