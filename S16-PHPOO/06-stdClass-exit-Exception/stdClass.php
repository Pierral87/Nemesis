<?php 

/* 

1 - stdClass : L'objet générique en PHP 

En PHP, la classe stdClass est une classe générique utilisée pour créer des objets simples contenant uniquement des propriétés ! 
Souvent utilisée lorsqu'on a besoin d'un objet pour stocker des valeurs, un peu comme un array, mais en souhaitant conserver le contexte 100% objet.

C'est aussi la classe par défaut en PHP lorsqu'on converti un array en objet ou lorsqu'on fait par exemple un FETCH_OBJ via PDO 

*/

// On peut aussi créer directement un objet vide stdClass 
$objet = new stdClass;
$objet->nom = "Pierra";
$objet->age = 38;

// On a bien pu insérer des valeurs dans cet objet comme on l'aurait fait dans un array ! 
var_dump($objet);

$array = ["nom" => "boby", "age" => 20];
var_dump($array);

// Ici je transforme un array en objet, il prends automatiquement la classe stdClass
$obj = (object) $array;

var_dump($obj);


// Avantages : 
    // Simple et léger pour des objets temporaires pour contenir des informations 

// Limites : 
    // Pas de méthode ni d'héritage ou autre dans un stdClass
