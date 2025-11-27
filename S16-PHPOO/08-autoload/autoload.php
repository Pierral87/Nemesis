<?php 

// Autoloading en PHP 

// Un autoload est un élément qui nous permet d'amener sur une page, toutes les classes dont elle a besoin pour fonctionner
// Si je n'avais pas d'autoload, je devrais lancer moi même à la main, tous les require/include des fichiers dont j'ai besoin pour mener à bien l'exécution de cette page
// Cela serait lourd en syntaxe, laisserait aussi des possibilités de fautes de frappe, de mauvais copier/coller ou autre 

// Grâce à l'autoload je n'ai plus besoin de me soucier de ça, il va tout gérer automatiquement


// Ici je dev une fonction inclusionAuto qui a pour but de prendre en param un nom de classe pour ensuite faire une concaténation d'un chemin d'accès à un fichier contenant la classe en question
// Par la suite, le but est de lancer une instruction include ou require de ce fichier là
function inclusionAuto($class) {
            // 08-autoload/Classes/Utilisateur.php
    // Chemin d'accès où récupérer mes classes 
    $file = __DIR__ . "/Classes/" . $class . ".class.php";

    // Verif du $file
    // var_dump($file);

    // Si le fichier existe, je le require
    if (file_exists($file)){
        require_once $file;
    }

}


// inclusionAuto("Utilisateur");

// spl_autoload_register c'est une fonction qui se déclenche dès lors qu'elle voit une mention d'une classe
    // Que ce soit une instanciation ou un appel d'un élément static 
// Dans notre cas, on lui dit, qu'elle doit lancer la fonction "inclusionAuto", elle sera ensuite capable de nous transmettre le nom de la classe mentionnée sur le fichier, et ça une par une
spl_autoload_register("inclusionAuto");

// $user = new Utilisateur;