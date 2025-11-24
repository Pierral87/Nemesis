<?php

/* 

--------- 1 - Les constantes 

--------- 2 - Les props et méthodes static

--------- 3 - self 

*/

class Panier
{
    // les const par défaut sont public, mais depuis la version PHP 7 on peut lui donner un niveau de visibilité spécifique
    const TVA = 20;
    public static $totalPrix = 0;
    public $nomPanier = "Panier";

    public static function setTotalPrix($newTotal)
    {
        self::$totalPrix = $newTotal;
    }

    public static function getTotalPrix()
    {
       return self::$totalPrix;
    }
}

// J'instancie mon Panier mais je ne vois pas ma const TVA, ni ma prop static $totalProduits :(   
$panier = new Panier();
// var_dump($panier);

// echo $panier->TVA; // Undefined property 
// echo $panier->totalProduits; // Erreur, cette prop n'appartient pas à l'objet, elle est static 

// Nouvelle notion ! 
// Les props et méthodes static appartiennent non pas aux objets mais à la classe elle même !
// Idem pour les constantes de classe 

// Voici comment appeler des éléments static
echo Panier::TVA . "<hr>";
// echo Panier::$totalPrix . "<hr>";

// Panier::$totalPrix = 1;
// echo Panier::$totalPrix . "<hr>";

// Si les props sont private ou protected, pas de soucis, je peux mettre des getter/setter eux aussi static ! 

// Ici je fais appel à mes setter et getter qui sont static pour intéragir avec la prop que j'ai passé en protected/private 
// Toujours, sans avoir instancié d'objet !  
Panier::setTotalPrix(100);
echo Panier::getTotalPrix();


// Tests de syntaxes exotiques en PHP  

echo $panier->nomPanier; // Ok normal j'appelle une nouvelle prop contexte objet au travers d'un objet 
echo "<hr>";
// echo Panier::$nomPanier; // Ok erreur, je ne peux pas appeler une prop de l'objet, de manière statique 
// $panier->TVA;    // Erreur TVA n'est pas une prop de l'objet 


echo $panier::TVA;  // ??? Ca marche 
echo "<hr>";
echo $panier::$totalPrix;  // ??? Ca marche
echo $panier::getTotalPrix(); // ??? Ca marche

// Attention au niveau des syntaxes ci dessus on fait face à une trop forte flexibilité du langage PHP, il accepte des syntaxes alternatives qui sortent du contexte et ne devraient pas fonctionner !...
// Attention à rester propre dans votre code et à rester cohérent sur les appels d'éléments static, toujours au travers de la Classe et jamais de l'objet 

