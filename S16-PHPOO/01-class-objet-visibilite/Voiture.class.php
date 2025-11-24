<?php

/*
    La programmation orientée objet (POO) en PHP repose sur quelques concepts clés comme les classes, les objets et les instances. 
    Elle inclut également des notions de visibilité qui contrôlent l'accès aux propriétés et aux méthodes.

    1. Déclaration d'une classe 
    Une classe en PHP est un modèle qui définit des propriétés (variables) et des méthodes (fronctions) qui seront partagées par les objets créés à partir de cette classe


 */

class Voiture {

    // Propriétés 
    public $marque;
    public $couleur;
    protected $km;
    private $moteur;


    // Méthodes 
    public function demarrer() {
        return "La voiture démarre";
    }

    protected function ajouterKm($km) {
        return "J'ajoute des km";
        // $this->km = $km;
    }

    private function ouvertureCapot(){
        return "Capot ouvert !";
    }

}

// 2. Instanciation d'une classe 
// Pour utiliser cette classe, on doit créer un objet à partir de celle-ci. C'est ce qu'on appelle l'instanciation 


// Instanciation de la classe voiture 
$voiture1 = new Voiture();

// Pour voir les props de l'objet
// var_dump($voiture1);

// Pour voir les méthodes de l'objet 
var_dump(get_class_methods($voiture1));

// Assignation de valeurs aux propriétés 
$voiture1->marque = "Toyota";
$voiture1->couleur = "Rouge";
// var_dump($voiture1);

echo $voiture1->demarrer();

$voiture2 = new Voiture();
$voiture2->marque = "Peugeot";
$voiture2->couleur = "Bleue";
var_dump($voiture1);
var_dump($voiture2);

echo $voiture2->demarrer();

// echo $voiture1->km; // Fatal Error, cannot access protected property
// echo $voiture1->moteur; // Fatal Error, cannot access private property

// echo $voiture1->ajouterKm(); // Cannot call protected method
// echo $voiture1->ouvertureCapot(); // Cannot call private method 

// $voiture1->ajouterKm(10);
var_dump($voiture1);


// On ne peut pas acceder à des props et ou methodes de visibilité protected et private depuis le scope global 
// Ce sont des limitations que l'on créé pour les équipes de développement
// On va voir dans le chapitre qu'il est possible d'accèder à des props et methodes protected et private dans le scope local de la classe 

// Les niveaux de visibilité : 
    // Public : Les propriétés/méthodes publiques sont accessibles depuis n'importe où, y compris depuis l'extérieur de la classe, scope global et local 
    // Protected : Les propriétés/méthodes protected sont accessibles uniquement depuis l'intérieur de la classe, scope local (également on hérite bien des éléments protected)
    // Private : Les propriétés/méthodes private sont accessibles uniquement depuis l'intérieur de la classe, scope local (par contre les éléments private ne sont pas transmis à l'héritage)


