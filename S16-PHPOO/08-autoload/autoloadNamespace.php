<?php 

// Amélioration de notre autoload pour gérer les namespaces et les sous-dossiers 

// Attention, il faudra toujours utiliser des conventions de nommage bien précises pour éviter toute incohérence de fonctionnement de notre autoload
// Ici on va faire en sorte de respecter la norme PSR-4 en allant piocher nos éléments d'abord dans le dossier src, puis ensuite dans les dossiers correspondant à nos namespace 

function inclusionAuto($class) {

    // En fonction des systèmes, les antislash de nos namespaces pourraient poser soucis sur des chemins d'accès web (qui sont généralement gérés avec slash normaux), pour ça je vais remplacer grâce à str_replace les antislash par des slash 
    $class = str_replace("\\", "/", $class);

    $file = __DIR__ . "/src/" . $class . ".php";

    // var_dump($file);

    require_once($file);
}

spl_autoload_register("inclusionAuto");

// $controller = new UtilisateurController;