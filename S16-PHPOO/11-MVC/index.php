<?php

use ProjetMVC\Controller\ProductController;
use ProjetMVC\Controller\UserController;

// Tout d'abord, on va charger l'autoload
require "vendor/autoload.php"; // On appelle l'autoload de composer

// Ici index.php c'est le point d'entrée de mon architecture
// En MVC on considère que l'utilisateur ne bouge pas de page en page, mais c'est le contenu des pages qui vient à lui ici sur index.php 

// On défini un array contenant tous les controllers existant sur notre app  pour gérer le routage 
$controllers = ["user", "product"];

// Ici ma condition me permet de lancer le bon controlleur 
if (isset($_GET["ctrl"]) && in_array($_GET["ctrl"], $controllers)) {
    if ($_GET["ctrl"] == "product") {
        $controller = new ProductController;
    } elseif ($_GET["ctrl"] == "user") {
        $controller = new UserController;
    }
} else {
    // Ici controller par défaut
    $controller = new UserController;
}

// Ici on défini par défaut l'instanciation du UserController, cela induit aussi la création du Model


// La méthode handleRequest() permet directement de lancer le controller en mode "attente d'info" pour savoir ce qu'est en train de faire l'utilisateur, pour comprendre le scénario et les actions à déclencher
$controller->handleRequest();
