<?php 

// Je ne peux pas instancier une classe abstract...
// Une classe abstract a uniquement pour but d'être utilisée pour l'héritage ! 
// L'intérêt d'une classe abstract, est de définir aussi des méthodes comme étant abstract elles aussi 

    // Qu'est ce que ça induit quand une méthode est abstract ? 
        // - Elle ne peut pas contenir de body (pas de code, pas d'accolades) dans la classe mère 
        // - On sera obligé de la définir et de la développer dans toutes les classes filles ! 

    // Cela permet de faire en sorte que lorsqu'on travaille en équipe et que chacun travaille peut être sur une sous classe, que chacun travaille dans le même sens ! 
    // Cela nous permet de créer un cadre cohérent et commun de développement à toute l'équipe, on saura qu'on pourra conserver les appels de la même forme sur notre méthode communiquer()
        // Le but étant que chaque sous classe ai une méthode communiquer() avec chacune son propre comportement 

abstract class Animals {
    public $nom; 

    public function __construct($nom) {
        $this->nom = $nom;
    }

    // ici méthode abstract, pas de body ! et obliger de rédéfinir dans les classes filles !
    abstract public function communiquer();
}

// Je ne peux pas instancier une classe abstract
// $animal = new Animals("Poki");

class Chien extends Animals {
    // Si je ne redéfinie pas communiquer() alors erreur ! je suis obligé de le faire ! 
    public function communiquer() {
        echo "$this->nom aboie : WanWan!<hr>";
    }
}


class Chat extends Animals {
    public function communiquer() {
         echo "$this->nom miaule : NyanNyan!<hr>";
    }
}

class Coq extends Animals {
     public function communiquer() {
         echo "$this->nom cri : Kakekoko!<hr>";
    }
}


$chien = new Chien("Loulou");
$chien->communiquer();

$chat = new Chat("Lardon");
$chat->communiquer();

$coq = new Coq("Koko");
$coq->communiquer();
