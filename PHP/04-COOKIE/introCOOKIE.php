<?php

/*
    Les cookies ce sont des petits fichiers de données que les serveurs stockent sur le navigateur de l'utilisateur pendant la navigation. 
    Ils permettent aux applications web de conserver des informations d'une session à une autre, telles que, les préférences d'un utilisateur ou les informations de session. 
    Même après fermeture du navigateur ou même la "déconnexion" de l'utilisateur, les données seront conservées et réutilisable.
    En PHP on gère les cookies au travers de : encore une fois, une super globale : $_COOKIE 
    superglobale = encore une fois, un array !  

    Utilisation des cookies en PHP 

        - Stockage d'informations à long terme : Contrairement à $_SESSION qui stocke des données côté serveur et généralement (sauf réglage contraire) expire lorsque l'utilisateur ferme son navigateur, un cookie persistera plus longtemps (souvent réglé à 1 an de durée de vie)
        - Personnalisation : Ils peuvent être utilisés pour enregistrer des préférences, comme la langue, le thème clair/sombre, le choix d'une devise préférée, d'un setup particulier (sur booking.com si vous recherchez toujours des chambres pour 2 adultes 2 enfants)
        - Suivi utilisateur : Ils permettent de suivre les utilisateurs d'une page à l'autre, voire d'un site à l'autre 

    Syntaxe et manipulation des cookies en PHP : 

        - Création d'un cookie :
            Pour créer un cookie en PHP on utilise la fonction setcookie()
                ATTENTION cela fait partie des fonctions PHP qui ne fonctionnent plus une fois les entêtes HTTP envoyés 

                // setcookie(name, value, expire, path, domain, secure, httponly);

                name : Nom du cookie (obligatoire)
                value : Valeur du cookie (obligatoire)
                expire : Timestamp de la date d'expiration, par défaut un cookie expire à la fermeture du navigateur 
                path : Chemin sur le serveur où le cookie sera accessible, généralement sur la totalité de l'application/siteweb 
                domain : Domaine pour lequel le cookie est valable, généralement sur le domaine sur lequel il est créé 
                secure : Si défini à true, le cookie sera envoyé uniquement via HTTPS 
                httponly : Si défini à true, le cookie ne sera accessible que côté serveur et pas par les langages front tel que JS 
*/

// setcookie("username", "Pierra", time() + 3600);
// setcookie("id", "6548971", time() + 3600);




// Ici Lecture d'un cookie 
// Les cookies définis par notre fonction setcookie(), peuvent être lus via la superglobale $_COOKIE, sous forme de clé valeur du array
// Le nom du cookie c'est l'indice du array et sa valeur, sera la valeur associée à cette indice dans le array 
// if (isset($_COOKIE["username"])) {
//     echo "Bonjour " . $_COOKIE["username"] . " bon retour sur notre site ! ";
// } else {
//     echo "Bonjour, nouveau visiteur";
// }

// Suppression d'un cookie 
// Pour supprimer un cookie, il faut lui définir une date passée 
// La date d'expiration étant passée, le système le supprime 
// setcookie("username", "", time() - 10);


// On fera toujours en sorte de créer un cookie à l'utilisateur quoi qu'il en soit !
// Même s'il ne fait pas de choix, on lui créera un cookie avec la valeur souhaitée par défaut

// ------------------------------------------------------------------------

// ------------ Ci dessous un système de cookie me permettant de switcher entre un thème clair et thème sombre et de conserver cette préférence utilisateur
var_dump($_COOKIE);

// Création d'un cookie qui dure 7 jours, avec le thème par défaut "clair"
if (!isset($_COOKIE["theme"])) {
    setcookie("theme", "clair", time() + (7 * 24 * 3600));
}


// Modification de la valeur du cookie en fonction du thème sélectionné via les liens 
if (isset($_GET["theme"])) {
    $selectedTheme = $_GET["theme"];
    setcookie("theme", $selectedTheme, time() + (7 * 24 * 3600));
    // Rechargement de page pour appliquer immédiatement le changement de thème
        // Un cookie ne se crée réellement qu'en fin de script, d'où la nécessité de faire ce rechargement 
    header("location:introCOOKIE.php");
    exit;
}

// Lecture du cookie et application du thème
$theme = $_COOKIE["theme"] ?? "clair";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de gestion de thème avec cookie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: <?= $theme === 'sombre' ? '#333' : '#fff'; ?>; color: <?= $theme === 'sombre' ? '#fff' : '#000'; ?>;">
    <div class="container mt-5">
        <h1>Choisir un thème</h1>
        <p>
            <a href="?theme=clair" class="btn btn-light <?= $theme === 'clair' ? 'disabled' : ''; ?>">Thème Clair</a>
            <a href="?theme=sombre" class="btn btn-dark <?= $theme === 'sombre' ? 'disabled' : ''; ?>">Thème Sombre</a>
        </p>
        <p>Thème actuel : <strong><?= ucfirst($theme) ?></strong></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>