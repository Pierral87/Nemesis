<?php 

// Ici notre fichier config pour mettre les infos de la bdd

define("DB_HOST", "localhost");
define("DB_NAME", "monsite");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_OPTIONS", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));