<?php 

// Ici ma classe parent, qui me sert de modèle pour mes deux sous classes

// Heritage est un concept nouveau de l'orienté objet, permettant de créer des classes dérivées qui héritent des props et méthodes d'une classe parente
// Cela permet de donner des modèles pour des sous classe
// ATTENTION, à l'héritage on garde un contexte cohérent, c'est à dire, il faut pouvoir dire que A est un B 
    // un Chien est un Animal
    // une Voiture est un Vehicule etc 

class Animal 
{
    // Tous les éléments public et protected sont transmis à la sous classe ! 
    public $nom;
    protected $age;
    // Petite nuance sur les éléments private : 
        // Ils ne sont pas transmit à l'héritage, mais cela ne veut pas dire qu'ils n'existent plus dans la classe parent
            // C'est à dire, que malgré tout, ils pourront être manipulés au travers de la classe parent, par exemple 
                // Si ici dans la classe Animal j'ai une prop private $poids, et qu'elle est appelée dans la méthode seDeplacer() qui elle aussi fait parti de la classe Animal, alors, la prop private sera accessible ! Car on reste dans le scope local de Animal ! 
            // Par contre, je n'aurai pas la capacité de manipuler la prop private $poids de animal, dans une de mes méthodes de la sous classe Chien ou Chat ! 
    private $poids = 10;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function seDeplacer() {
        // $this->test();
        echo "$this->nom se déplace";
    }

    private function test() 
    {
        echo "Je suis dans la fonction test<hr>";
    }
}

// Ici un héritage avec une première sous classe Chien, qui hérite de Animal, elle récupère tout le contenu de la classe Animal qui lui sert de modèle
// On peut ceci dit lui rajouter autant de contenu qu'on le souhaite, props et méthodes spécifiques à cette sous classe
class Chien extends Animal 
{
    public function aboyer() 
    {
        // echo $this->poids;
        echo "$this->nom aboie !<hr>";
    } 
}

// Ici une autre sous classe qui profite elle aussi de l'héritage de Animal
class Chat extends Animal 
{
    public function miauler() 
    {
        // echo $this->poids;
        echo "$this->nom miaule !<hr>";
    } 
}

// Instanciation de deux objets de sous type différent mais ayant pour parent Animal
$chien = new Chien("Pilou");
var_dump($chien);
var_dump(get_class_methods($chien));
$chien->seDeplacer();
$chien->aboyer();

$chat = new Chat("Neko");
$chat->seDeplacer();
$chat->miauler();