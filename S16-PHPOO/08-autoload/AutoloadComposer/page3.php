<?php 

/* 

    Utilisation de l'autoload de composer pour nos propres classes 

    Composer, outre le fait d'être un outil de gestion de dépendances d'un projet, il permet aussi d'intégrer directement un autoload sur notre projet  

    L'autoload de composer est basé sur la norme PSR-4 qui va mapper les namespaces aux dossiers du projet et on définira le namespace racine, rattaché au dossier src 

    {
        "autoload": {
            "psr-4": {
                "ProjetPierra\\": "src/"
            }
        }
    }

    // Ci dessus le json que l'on va devoir créer pour rattacher l'autoload à notre dossier, ici on fait la liaison de notre namespace principal ProjetPierra au dossier src 

    Pour installer l'autoload, via le terminal (attention à se mettre dans le bon dossier) : 
    composer dump-autoload 

*/

use ProjetPierra\Controller\UtilisateurController;
use ProjetPierra\Model\UtilisateurModel;

// Après le dump-autoload, le dossier vendor est créé et l'autoload est convenablement installé, il me reste simplement à le require sur mes pages
// Il respecte ensuite convenablement la norme PSR-4 comme je le lui ai indiqué dans le json et ainsi est capable de rattacher mon namespace ProjetPierra au dossier /src et ensuite les autres namespace à des dossiers du même nom 
require_once "vendor/autoload.php";

$controller = new UtilisateurController;
$model = new UtilisateurModel;