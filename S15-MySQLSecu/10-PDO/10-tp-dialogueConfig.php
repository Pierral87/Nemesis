<?php

/* 

// Pour éviter les injections XSS (du code css ou js mis dans les commentaires ou les pseudo ou autre)
// Il est possible d'utiliser des fonctions comme htmlspecialchars, htmlentities, strip_tags
// Qui vont permettre de transformer les caractères problématique (les balises, les guillemets etc) en entités html
// Elles seront bien affichées mais ne seront pas interprétées par le code ! 
// par exemple un <hr> saisi sera réellement : &lt;hr&gt; 

// Les injections XSS qui nous poseraient soucis, seraient par exemple :
// En CSS : 
<!-- // body display none :  <style>body{display:none;}</style> -->
// Plus possible d'intéragir avec le site, il faut aller supprimer dans phpmyadmin ou avec la console, l'energistrement
// En JS : 
<!-- // une boucle infinie ! <script>while(true){alert("coucou");}</script> -->

// Les injections SQL sont un concept de piratage qui nous permet d'insérer du code SQL directement dans un formulaire html ou une url 

// On comprends que le système est sensible aux injections soit par divers messages d'erreurs lorsque l'on tape des messages avec des quote ou double quote, sinon on peut toujours tenter de lancer un DO SLEEP(10) pour voir s'il est interprété (cela rajoute un temps de délais avant de lancer une requete)

// Quelques opérations pénibles via injection SQL
// Des delete, des truncate, des drop table ou base !  

// Si je veux faire une injection au travers de mon champ message, je dois faire en sorte de "cloturer" la requête prévue à l'origine, donc d'abord fermer le champs message avant de fermer le champ date_enregistrement
// Par exemple :
    // ', NOW()); DROP DATABASE dialogue;

// En fonction des droits de l'utilisateur BDD actuellement connecté sur la page, je peux peut être avoir des droits plus étendus encore, par exemple les manipulations de fichier
// Il est possible en MySQL de créer des fichiers dans le dossier tmp/temp de notre serveur, et ainsi y stocker le nom de la BDD récupérée via un SELECT DATABASE() (car par défaut on ne connait pas le nom de la base), le nom des tables de la base avec un SHOW TABLES()
// Egalement, appeler des données d'autres tables (user, produit, commande, info CB ou autre), pour les insérer dans le fichier et les réinsérer dans la table qui m'est visible sur cette page, pour les récupérer et les vendre sur le dark web !!! :o 

// Donc, il faut bien comprendre que lorsqu'une injection est possible sur notre site, alors l'intégralité du système et des données sont compromises !  

// Bien sûr, il est maintenant très rare de faire face à des formulaires sensibles aux injections car c'est vraiment une protection BASIQUE, toujours mise en place sur nos form, que ce soit à la main, ou auto géré par des librairies et les framework

EXERCICE :
----------------------

- Creation d'un espace de dialogue / tchat 

- 01 - Création de la BDD : dialogue 
    - Table : commentaire 
    - Champs de la table commentaire : 
        - id_commentaire        INT PK AI 
        - pseudo                VARCHAR 255
        - message               TEXT
        - date_enregistrement   DATETIME

- 02 - Créer une connexion à cette base avec PDO 
- 03 - Création d'un formulaire html permettant de poster un message 
    - Champs du form : 
            - pseudo 
            - message
            - bouton d'envoi
- 04 - Récupération des saisies du form et application de contrôles
- 05 - Déclenchement d'une requête d'enregistrement pour enregistrer la saisie dans la BDD
- 06 - Requête de récupération des messages afin de les afficher dans cette page 
- 07 - Affichage des messages avec un peu de mise en forme 
- 08 - Affichage en haut des messages du nombre de messages présents dans la bdd
- 09 - Affichage de la date au format jour/mois/année 
- 10 - Amélioration du CSS 

*/

// - 02 - Créer une connexion à cette base avec PDO 


// Meme TP mais en récupérant les informations de connexion à la BDD dans un fichier extérieur à celui (pour raison de sécurité)
// Ici avec json, ça pourait être un php, un xml aussi
try {
    $config = json_decode(file_get_contents("config.json"), true);
    var_dump($config);
    $dbHost = $config["db_host"];
    $dbName = $config["db_name"];
    $host = "mysql:host=$dbHost;dbname=$dbName";
    $login = $config["db_user"];
    $password = $config["db_password"];
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Erreur de site web";
    exit;
}





try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de BDD";
    exit;
}

// var_dump($pdo);

// var_dump($_POST);

$errors = array();
$req = "";
$messages = "";

// - 04 - Récupération des saisies du form et application de contrôles
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"], $_POST["message"])) {

    $pseudo = trim($_POST["pseudo"]);
    $message = trim($_POST["message"]);

    // Contrôles de validation 
    // Champs obligatoires
    if (empty($pseudo) || empty($message)) {
        $errors[] = "Tous les champs requis.";
    }

    // Pseudo trop court ou trop long
    if (iconv_strlen($pseudo) < 4 || iconv_strlen($pseudo) > 20) {
        $errors[] = "Le pseudo doit faire entre 4 et 20 caractères";
    }

    // Message trop court
    if (iconv_strlen($message) < 3) {
        $errors[] = "Le message doit faire au moins 3 caractères";
    }

    if (empty($errors)) {

        // - 05 - Déclenchement d'une requête d'enregistrement pour enregistrer la saisie dans la BDD
        // Je mets ici ma requête dans une variable pour l'afficher plus bas
        $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
        // $pdo->query($req);
        $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
        $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);
        $stmt->execute();

        // Pour éviter de renvoyer une nouvelle fois le form à l'actualisation de la page on peut faire une redirection vers la même page pour perdre les données du POST
        // header("location:10-tp-dialogue.php");
    }
}

// - 06 - Requête de récupération des messages afin de les afficher dans cette page 
$stmt = $pdo->query("SELECT id_commentaire, pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y à %T') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC");
// Ici avec fetchAll je récupère la totalité de mes messages en une seule var
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Je compte le nombre d'éléments dans mon array récupéré avec fetchAll, c'est le nombre de message dans la base
$nbMessages = sizeof($messages);
// var_dump($messages);

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
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <!-- - 03 - Création d'un formulaire html permettant de poster un message  -->
                <form method="POST" class="mt-5 mx-auto w-50 border p-3 bg-white">
                    <!-- Affichage de la requête lancée -->
                    <?= $req ?>
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
                <p class="w-75 mx-auto mb-3">Il y a : <b><?= $nbMessages ?></b> messages</p>
                <!-- - 07 - Affichage des messages avec un peu de mise en forme  -->
                <?php foreach ($messages as $message): ?>
                    <div class="card w-75 mx-auto mb-3">
                        <div class="card-header bg-dark text-white">
                            Par : <?= htmlspecialchars($message["pseudo"]) ?>, le : <?= htmlspecialchars($message["date_fr"]) ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($message["message"]) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>