<?php 
require_once("partials/_config.php"); // Jamais d'espace, de saut de ligne avant l'ouverture de PHP, l'ouverture de PHP est toujours réalisée en première ligne et premier caractère de nos pages
// On ajoute ensuite nos fichiers config, functions, classes ou autre 
require_once("partials/_functions.php");

// Ici une découpe banale d'un projet simple en PHP procédural 

// Il est toujours bon d'initialiser nos variables à vide pour éviter les erreurs undefined 
$msg = "";
$msgError = "";


// ICI CODE PHP DE LA PAGE EN COURS // PAR EXEMPLE TRAITEMENT INSCRIPTION, CONNEXION, ENVOI MAIL DE CONTACT, SUPPRESSION D'UNE LISTE ETC


    // On fera toujours en sorte en PHP de ne pas avoir d'echo avant les inclusions des header etc
    // Si jamais dans mon traitement je dois générer des messages d'erreurs par exemple, alors j'insère tout dans une variable et j'echo cette variable plus bas dans mon code

// if() {
//     $msgError .= "Désolé le pseudo est trop court<br>";
// }
// if() {
//     $msgError .= "Désolé l'email n'est pas du bon format<br>";
// }


require_once("partials/_header.php"); // ICI DEBUT DES AFFICHAGES ET INITIALISATION DES HEADERS HTTP AUCUN CODE PHP DE TRAITEMENT PASSE CETTE LIGNE, UNIQUEMENT DU PHP POUR DES AFFICHAGES
require_once("partials/_nav.php");
?>
<!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Bienvenue sur mon site eshop</h1>
            <div><?= $msgError ?></div>
            <p class="lead">Bienvenue sur notre site de vente Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos blanditiis non voluptatibus placeat. Pariatur, culpa natus? Dolorem ratione aliquam obcaecati libero perspiciatis quasi, suscipit quam aut in beatae deleniti molestiae?
            Ad molestiae quisquam nam aliquid, totam dolorum quas recusandae nemo pariatur laborum, minus accusamus, cumque molestias quidem tempora dolores quis consectetur dolor eos ipsam cupiditate hic reiciendis maiores. Minus, doloribus.</p>
        </div>
    </main>
<?php 
require_once("partials/_footer.php");
