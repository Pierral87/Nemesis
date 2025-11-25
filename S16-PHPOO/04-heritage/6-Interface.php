<?php 

/* 

Une interface est une structure qui définit un ensemble de méthodes vides ! (elles peuvent quand même contenir des params)

Lorsqu'on "implements" une interface, on oblige la classe qui l'implémente à définir les méthodes en question, c'est un peu comme un abstract 

L'avantage des interfaces est qu'on peut en implémenter plusieurs à la fois (comme les traits !), contrairement à l'héritage d'une classe abstract limité à un seul héritage, ici plusieurs sont possibles

*/


// Une interface
interface AnimalInterface {
    public function communiquer();
}

// Une interface
interface Mammifere {
    public function metBas();
}

// Une interface
interface Herbivore {
    public function ruminer();
}

// Une classe qui implémente les 3 interfaces ci dessus et se retrouve obligée de définir les 3 méthodes récupérées
class Vache implements AnimalInterface, Mammifere, Herbivore {

    public function communiquer() {
        echo "Meuh";
    }

    public function metBas() {
        echo "Un petit veau!";
    }

    public function ruminer() {
        echo "miam miam";
    }
}

