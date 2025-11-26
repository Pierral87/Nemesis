<?php

/* 

    - Les exceptions en PHP 

    Les exceptions en PHP permettent de gérer les erreurs et les conditions anormales de notre programme. 
        On peut ainsi les gérer de manière contrôlée.
    Contrairement au fait de lancer s'exécuter une fatal error qui arreterait le script, les exceptions offrent un moyen de traiter proprement nos erreurs 

    Pour gérer les exceptions on utilisera toujours des blocs try/catch  

    Structure de base des exceptions : 

    try : bloc où l'on place le code qui peut potentiellement générer une exception 
    catch : Intercepte une exception lancée et permet de la traiter 
    finally : Est un bloc que l'on peut rajouter après le try/catch et qui s'exécutera quoi qu'il en soit, que l'on soit passé dans le catch ou dans le try 
    throw : Lance une exception (qui a pour but d'être catch)

*/

// Ici une fonction globale que je developpe
// Lorsqu'on dev des fonctions ou des méthodes de classe, on fait en sorte de "lancer" des exception sur les cas d'erreur
    // Le but ici étant de si je mets à disposition ma fonction/mes méthodes (distribution de librairie ou base de framework), que les erreurs soient gérées non pas de façon native mais au travers des exceptions
    // Libre à la personne qui utilise mes fonctions de les gérer au travers de try catch
function diviser($a, $b)
{
    if ($b == 0) {
        // Ici j'identifie une erreur probable dans ma fonction, à savoir, la division par zero ! 
        // On instancie pas l'exception de manière "normale" mais en faisant un "throw" c'est ce qui permet de sortir du try pour aller dans le catch 
        // Je peux lancer le type d'exception throwable que je souhaite (d'ailleurs on peut aussi dev notre propre Exception via héritage)
        throw new MonExceptionSpeciale("Division par zero interdite !");
    }

    return $a / $b;
}

echo "<h2>Résultat d'une division en dehors d'un bloc try catch : </h2><hr>";
echo diviser(10, 2);
// echo diviser(10,0); // Ici, nous ne sommes pas dans un bloc try/catch donc l'exception lancée et non attrapée me génère une fatal error
// Pour éviter la fatal error ? Je dois mettre en place mes blocs try catch 

echo "<h2>Résultat d'une division à l'intérieur d'un bloc try catch : </h2><hr>";
// Ici je débute un try catch, ce qui va me permettre de gérer mon exception 
try {
    // echo diviser(10,0);   // Ici, erreur sur la division par 0 ! Une exception est lancée ! Je me retrouve déplacé dans le catch 
    echo "Tout va bien on est à la fin du try !";
    // Si pas d'erreur, la totalité du bloc try s'execute 
} catch (Exception $e) {
    // Ici dans le catch, j'ai "attrapé" une exception de type Exception que je symbolise dans la var $e
        // Dans ce $e j'ai accès à tout un tas d'information, notamment le message de l'erreur que je peux récupérer avec le getter associé getMessage
        // On a également la "trace" qui défini où survient l'erreur 
    var_dump($e);
    var_dump(get_class_methods($e));

    echo "Erreur on est dans le catch !!!!<br>";
    echo "Erreur : " . $e->getMessage() . "<br>";
    echo "Trace : " . $e->getTraceAsString() . "<br>";
    // die;
    // exit;
} finally {
    // Le bloc finally s'execute quoi qu'il en soit
    echo "<hr>ICI C'EST FINALLY !<hr>";
}

echo "<h2>Ici on est après le try catch</h2><hr>";

echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr>";
try {
    echo diviser(10, 0);
    echo "Tout va bien on est à la fin du try !";
} catch (InvalidArgumentException $e) { // Je peux attraper d'autres types d'exception 
    var_dump($e);
    var_dump(get_class_methods($e));

    echo "Erreur on est dans le catch !!!!<br>";
    echo "Erreur : " . $e->getMessage() . "<br>";
    echo "Trace : " . $e->getTraceAsString() . "<br>";
    // die;  
    // exit;
} catch (Exception $e) { // Je peux catch plusieurs types d'exception au travers de plusieurs blocs catch
    echo "Exception normale";
} catch (MonExceptionSpeciale $e) {
    echo "<h2>Exception Trop Speciale</h2>";
} finally {
    echo "<hr>ICI C'EST FINALLY !<hr>";
}

class MonExceptionSpeciale extends Exception {} // Je peux extends Exception pour dév moi même ma propre exception


// die et exit permettent de stopper l'exécution du code, souvent associé avec une gestion d'erreur try catch (par exemple un try catch pour la creation de l'objet PDO)
