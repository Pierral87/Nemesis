<?php 

/*

Exercice 1 : Contrôle d'accès à une page admin avec exit / die


    Créez un fichier gestion.php.
    Simulez un utilisateur connecté avec dans la session, un indice user auquel sont stockés des informations, notamment le rôle (valeurs possibles : 'admin', 'user').
    Si l'utilisateur n'a pas le rôle d'admin, utilisez die() ou exit() pour afficher un message d'erreur et interrompre l'exécution de la page. Sinon, affiche le contenu de la page d'administration.

*/

session_start();

$_SESSION['user'] = [
    'nom' => 'Alice',
    'role' => 'user' 
];

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Accès refusé : vous devez être administrateur pour accéder à cette page.");
}

echo "<h1>Bienvenue</h1>";