<?php

/* 

--------- 1 - Les constantes 
    Les constantes dans une classe permettent de définir des valeurs immuables, c'est à dire qui ne peuvent pas être modifiées après 
    On considère que les constantes sont des éléments static et donc appartiennent aux classes et non pas aux objet
    Par défaut une constante est publique, mais il est possible de lui rajouter un niveau de visibilité 

--------- 2 - Les props et méthodes static
    Contrairement aux props et méthodes classiques, ici on considère que les éléments static appartiennent aux classes et donc ne sont pas conditionnés par l'existence d'un objet pour être utilisés 
    Nouvelle syntaxe : NomDeClasse::$prop  

--------- 3 - self 
    Le mot clé self est utilisé pour accéder aux éléments static à l'intérieur de la classe (dans son scope local), c'est l'équivalent de $this, mais dans le contexte static

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
// $panier = new Panier();
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

