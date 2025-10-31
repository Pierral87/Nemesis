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
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING); // Gestion des erreurs

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

$stmt = $pdo->query("SELECT * FROM employes WHERE id_employes = 1000");
// La requête ci dessus envoyée dans la console 
// +-------------+--------+---------+------+-----------+---------------+---------+
// | id_employes | prenom | nom     | sexe | service   | date_embauche | salaire |
// +-------------+--------+---------+------+-----------+---------------+---------+
// |        1000 | Frodon | Sacquet | m    | redaction | 2025-10-29    |      10 |
// +-------------+--------+---------+------+-----------+---------------+---------+

var_dump($stmt);
// Actuellement le $stmt ne contient pas directement le résultat ou en tout cas, pas de manière exploitable ! 
// Je n'ai accès à aucune information dans le var_dump à part la requête qui a été lancée 

// Pour le rendre exploitable je dois extraire le résultat grâce à la méthode fetch()

// FETCH_ASSOC : Pour récupérer un array associatif ! (nom des colonnes du résultat comme key du array)
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// array (size=7)
//   'id_employes' => int 1000
//   'prenom' => string 'Frodon' (length=6)
//   'nom' => string 'Sacquet' (length=7)
//   'sexe' => string 'm' (length=1)
//   'service' => string 'redaction' (length=9)
//   'date_embauche' => string '2025-10-29' (length=10)
//   'salaire' => float 10

// FETCH_NUM : Pour récupérer un array indexé numériquement
// $data = $stmt->fetch(PDO::FETCH_NUM);
// var_dump($data);
// array (size=7)
//   0 => int 1000
//   1 => string 'Frodon' (length=6)
//   2 => string 'Sacquet' (length=7)
//   3 => string 'm' (length=1)
//   4 => string 'redaction' (length=9)
//   5 => string '2025-10-29' (length=10)
//   6 => float 10

// FETCH_BOTH : Pour récupérer un array indexé à la fois numériquement et associativement (Pas très pratique... Mais c'est le cas par défaut dans les réglages de PHP)
// $data = $stmt->fetch(PDO::FETCH_BOTH);
// var_dump($data);
// array (size=14)
//   'id_employes' => int 1000
//   0 => int 1000
//   'prenom' => string 'Frodon' (length=6)
//   1 => string 'Frodon' (length=6)
//   'nom' => string 'Sacquet' (length=7)
//   2 => string 'Sacquet' (length=7)
//   'sexe' => string 'm' (length=1)
//   3 => string 'm' (length=1)
//   'service' => string 'redaction' (length=9)
//   4 => string 'redaction' (length=9)
//   'date_embauche' => string '2025-10-29' (length=10)
//   5 => string '2025-10-29' (length=10)
//   'salaire' => float 10
//   6 => float 10

// FETCH_OBJ : Pour récupérer non pas un array mais un objet ! Avec les props de cet objet qui correspondent aux colonnes de mon résultat ! 
$data = $stmt->fetch(PDO::FETCH_OBJ);
var_dump($data);
// object(stdClass)[3]
//   public 'id_employes' => int 1000
//   public 'prenom' => string 'Frodon' (length=6)
//   public 'nom' => string 'Sacquet' (length=7)
//   public 'sexe' => string 'm' (length=1)
//   public 'service' => string 'redaction' (length=9)
//   public 'date_embauche' => string '2025-10-29' (length=10)
//   public 'salaire' => float 10

// Affichage du prénoms en fonction des méthodes 
// Avec FETCH_ASSOC 
// echo $data["prenom"];
// Avec FETCH_NUM
// echo $data[1];
// Avec FETCH_OBJ
echo $data->prenom;

// Une ligne traitée avec fetch, n'existe plus dans la réponse ! C'est pour ça que je ne peux pas enchainer les fetch sur le même stmt ! 

echo "<h2>04 - Requêtes de sélection pour plusieurs lignes de résultat</h2>";

$stmt = $pdo->query("SELECT * FROM employes");
echo "Nombres d'employés : " . $stmt->rowCount() . "<hr>";


// fetch() ne traite qu'nue seule ligne à la fois ! 
// A chaque fois que je l'appelle il traite une ligne, puis une autre, puis une autre etc, une par une
// Grâce à la boucle while je peux lancer fetch jusqu'à la fin du résultat
// Lorsqu'il n'y aura plus de résultat dans le stmt, fetch retourne false, donc la boucle s'arrête :
// while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     var_dump($data);
//     echo "<hr>";
// }

// Libre d'interprétation ensuite pour l'affichage
// Tableau, cards, list ou autre (cf nos exercices PHP GET/POST)

// Petites vignettes en CSS

?>
<div style="display: flex; flex-wrap:wrap; justify-content: space-between">
    <?php while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div style="margin-top: 20px; padding: 1%; width: 20%; background-color: steelblue; color: white">
            ID : <?= $data["id_employes"] ?><br>
            Prénom : <?= $data["prenom"] ?><br>
            Nom : <?= $data["nom"] ?><br>
            Service : <?= $data["service"] ?><br>
            Salaire : <?= $data["salaire"] ?><br>
            Sexe : <?= $data["sexe"] ?><br>
            Date embauche : <?= $data["date_embauche"] ?><br>
        </div>
    <?php endwhile; ?>
</div>
<hr>
<hr>
<hr>

<?php

$stmt = $pdo->query("SELECT * FROM employes");

// Maintenant en tableau html (structure fixe), type gestion user/employes
?>

<style>
    th,
    td {
        padding: 10px;
    }
</style>
<table border="1" style="border-collapse : collapse; width: 100%;">
    <tr>
        <th>Id Employes</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Sexe</th>
        <th>Service</th>
        <th>Date embauche</th>
        <th>Salaire</th>
        <th>Actions</th>
    </tr>
    <?php while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <?php foreach ($data as $valeur) {
                echo "<td>$valeur</td>";
            }
            echo "<td>Voir - Modifier - Supprimer</td>";
            ?>
        </tr>
    <?php endwhile; ?>
</table>
<hr>
<hr>
<hr>
<?php

// Maintenant un tableau à structure dynamique !
// C'est à dire qui va s'adapter à nos requêtes par rapport au nombre de colonnes ! 
$stmt = $pdo->query("SELECT id_employes, nom, prenom, service, salaire FROM employes");
// Il existe dans PDOStatement une méthode columnCount()
// Elle va nous permettre de comprendre le nombre de colonnes dans la réponse 
// Il existe aussi une méthode getColumnMeta() elle attend un param en int pour savoir de quelle colonne on parle dans le result (la 1ere, la 2eme etc) 
// Cette méthode nous renvoie un array avec de nombreuses infos sur la colonne, notamment son name ! 

echo "Nombre de colonnes dans la requête : " . $stmt->columnCount();

// var_dump($stmt->getColumnMeta(2));

?>
<table border="1" style="border-collapse : collapse; width: 100%;">
    <tr>
        <?php 
            for($i = 0; $i < $stmt->columnCount(); $i++) {
                $infoColonne = $stmt->getColumnMeta($i);
                echo "<th>" . $infoColonne["name"] .  "</th>";
            }
        ?>
    </tr>
    <?php while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <?php foreach ($data as $valeur) {
                echo "<td>$valeur</td>";
            }
            echo "<td>Voir - Modifier - Supprimer</td>";
            ?>
        </tr>
    <?php endwhile; ?>
</table>
<hr>
<hr>
<hr>
<?php
echo "<h2>05 - Requêtes de sélection pour plusieurs lignes de résultat avec fetchAll()</h2>";

// fetch() permet de traiter une seule ligne à la fois ! 
// fetchAll() traite toutes les lignes en une seule fois mais on obtient un résultat d'une forme un peu différente : array à deux niveaux

$stmt = $pdo->query("SELECT * FROM employes");
// fetchAll possède les mêmes modes que fetch(), ASSOC, OBJ etc
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($employes);

echo "Premier employé de la BDD : " . $employes[0]["prenom"] . "<hr>";

// EXERCICE : Affichez les noms et prénoms des employés dans une liste ul li
    // A faire avec fetchAll()

    echo "<ul>";
        foreach($employes AS $employe) {
            echo "<li>" . $employe["nom"] . " " . $employe["prenom"] . "</li>";
        }
    echo "</ul>";

echo "<h2>06 - Requêtes préparées pour se protéger des injections SQL !</h2>";

// prepare() permet de sécuriser les requêtes pour éviter les injections SQL
// Si dans la requête on attend une information de l'utilisateur (saisie ou clic) alors OBLIGATION de faire prepare (dans le doute, on peut lancer TOUTES nos requêtes en prepare)

$nom = "laborde"; // Information récupérée d'un form, un utilisateur cherche un employé par son nom 

// Première étape : Préparation de la requête 

// Première syntaxe possible avec des "?" remplaçant les valeurs attendues à réinsérer au niveau du execute
// Cette syntaxe est rapide mais peu lisible
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = ?");
$stmt->execute([$nom]); // On fourni ici dans les params du execute, un array qui contient les valeurs à coller à la place de nos "?"  ATTENTION ! DANS LE MEME ORDRE ! 
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);


// Sur des requêtes à nombreux param, cela amène des problèmes de lisibilité 

// $stmt = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES (?, ?, ?, ?, ?, ?)");
// $stmt->execute([$prenom, $nom, $sexe, $service, $salaire, $date_embauche]);

$nom = "winter";
// On préfèrera utiliser la façon des tokens/marqueurs 
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // On nomme les valeurs attendues par un mot précédé de ":"
$stmt->bindparam(":nom", $nom, PDO::PARAM_STR); // On bind une valeur à chacun de ces marqueurs nominatifs un par un : un appel de bindparam, pour lier chaque marqueur ! 
// Cela nous permet aussi d'appliquer le filtre de notre choix, en MySQL on peut toujours mettre PARAM_STR, cela filtre la totalité des infos en pur string et ne serons pas interprétés ! Le moteur MySQL est capable de refaire le tri dérrière à l'arrivée des données !  
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);




