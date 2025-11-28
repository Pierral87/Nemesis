<?php

use ProjetMVC\Controller\UserController;

// Tout d'abord, on va charger l'autoload
require "vendor/autoload.php"; // On appelle l'autoload de composer

// Ici index.php c'est le point d'entrée de mon architecture
// En MVC on considère que l'utilisateur ne bouge pas de page en page, mais c'est le contenu des pages qui vient à lui ici sur index.php 



// Ici on défini par défaut l'instanciation du UserController, cela induit aussi la création du Model
$controller = new UserController;

// La méthode handleRequest() permet directement de lancer le controller en mode "attente d'info" pour savoir ce qu'est en train de faire l'utilisateur, pour comprendre le scénario et les actions à déclencher
$controller->handleRequest();