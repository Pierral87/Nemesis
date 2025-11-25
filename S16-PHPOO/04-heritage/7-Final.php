<?php 

/* 

Le mot clé final est une nouvelle option que l'on peut mettre place au travers des héritages 

On peut définir comme final : 
    - Une méthode : auquel cas, il ne sera pas possible de la surcharger dans la classe enfant 
    - Une classe : Dans ce cas, la classe ne pourra pas avoir d'héritier, ce sera le dernier niveau, elle est prévue pour être utilisée telle que conçue à l'origine 

*/

class Animal {
    public $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    // Si une méthode est finale, elle sera bien héritée, pas de soucis, MAIS il sera impossible de la surcharger !
    // Lorsqu'on met en place une méthode final, on considère que le comportement d'origine doit être préservé à l'héritage
    final public function seDeplacer() {
        echo "$this->nom se déplace";
    }
}

// Si c'est la classe entière qui est finale, alors elle ne peut plus avoir de sous-classe ! 
final class Chien extends Animal {
    // Impossible de surcharger/override la méthode seDeplacer() car elle est finale ! 
    // public function seDeplacer() {
    //     echo "";
    // }
}

// Impossible car la classe Chien est une classe final, pas possible d'en hériter
// class Caniche extends Chien {
// }
