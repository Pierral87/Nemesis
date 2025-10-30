<?php 


// -------------------------------------------------------------------
// -------------------------------------------------------------------
// ---------- PDO : PHP DATA OBJECT ----------------------------------
// -------------------------------------------------------------------
// -------------------------------------------------------------------


// PDO est une classe prédéfinie de PHP, elle représente une connexion à un serveur de BDD
// On va le manipuler avec MySQL mais on peut le manipuler avec d'autres SGBD
// On peut considérer que PDO est une "porte" vers la BDD

echo "<h2>01 - Connexion à la BDD</h2>";
// Pour créer une connexion à la BDD nous avons besoin des informations suivantes (voir doc) : 
    // - Le host et nom de bdd 
    // - Le login de connexion à la bdd
    // - Le password de connexion de ce login
    // - Eventuellement un array contenant des options

$host = "mysql:host=localhost;dbname=entreprise"; // hôte + nom bdd
// $host = "pgsql:host=localhost;dbname=entreprise"; // hôte + nom bdd si postgresql
// $host = "sqlite:host=localhost;dbname=entreprise"; // hôte + nom bdd si sqlite
$login = "root";
$password = "";
$options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING); // Gestion des erreurs

// Création de l'objet PDO 
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de BDD";
    exit;
}

// Si le var_dump me présente un objet PDO, alors ça a fonctionné ! Je suis maintenant connecté à la BDD
var_dump($pdo);

echo "<h2>02 - Requêtes de type action (INSERT / UPDATE / DELETE)</h2>";

// Enregistrement d'un nouvel employé dans la BDD 

// On va utiliser ici la méthode "query" qui lance une requête directement (un peu comme on les a lancé dans la console)
// /!\ ATTENTION /!\ à l'utilisation de la méthode query, elle ne nous protège pas des injections SQL !!
// On utilisera query uniquement lorsque nous n'avons pas de $variables dans notre requête 

// $stmt = $pdo->query("INSERT INTO employes (prenom, nom, salaire, sexe, service, date_embauche) VALUES ('Pierral', 'Lacaze', 12000, 'm', 'Web', CURDATE())");
// $stmt est un objet de type PDOStatement, c'est un sous objet de PDO qui "représente" la réponse à une requête
// Nous n'avons pas vraiment de réponse sur une requête de type action, mais on a accès quand même à des méthodes telles que rowCount

// Il sera intéressant d'utiliser rowCount pour plusieurs opérations, par exemple savoir si un pseudo n'est pas déjà pris en bdd (si rowCount != 0 alors pseudo déjà pris)
// Egalement pour afficher le nombre d'éléments récupérés par une requête SELECT sans avoir la nécessité de lancer une réelle requête COUNT(*)

// var_dump($stmt);
// echo "Nombre de lignes insérées : " . $stmt->rowCount() . "<hr>";

echo "<h2>03 - Requêtes de sélection pour une seule ligne de résultat</h2>";