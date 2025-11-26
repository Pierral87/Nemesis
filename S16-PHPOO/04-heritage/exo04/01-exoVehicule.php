<?php

/*

       Exercice 1 : 
        Modifier le code des classes pour répondre aux questions ci-dessous

    1. Faire en sorte de ne pas avoir d'objet Vehicule : mettre la classe Vehicule en abstract 
    2. Obligation pour la Renault et la Peugeot de posséder exactement la même méthode démarrer() : définir la méthode demarrer() en final, pour ne pas pouvoir la surcharger dans les sous classes
    3. Obligation pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence : abstract sur la méthode carburant 
    4. La Renault doit effectuer 30 test de + qu'un véhicule de base : surcharge de la méthode nombreDeTestsObligatoires dans les enfants en appelant parent::nombreDeTestsObligatoires de vehicule pour y rajouter le nombre de test prévu
    5. La Peugeot doit effectuer 70 test de + qu'un vehicule de base : idem qu'au dessus
    6. Effectuer les affichages nécessaires


    */


abstract class Vehicule
{
    final public function demarrer()
    {
        return "Je demarre";
    }

    abstract public function carburant();

    public function nombreDeTestsObligatoires()
    {
        return 300;
    }
}

class Peugeot extends Vehicule
{
    public function carburant()
    {
        return "Essence";
    }

    public function nombreDeTestsObligatoires()
    {
        return parent::nombreDeTestsObligatoires() + 70;
    }
}

class Renault extends Vehicule
{
    public function carburant()
    {
        return "Diesel";
    }

    public function nombreDeTestsObligatoires()
    {
        return parent::nombreDeTestsObligatoires() + 30;
    }
}


// TESTS 

// $vehicule = new Vehicule; // Pas possible, la classe est abstract, OK ! 

$peugeot = new Peugeot;
$renault = new Renault;

// Test des méthodes démarrer, OK, c'est les mêmes et je n'ai pas pu les override
echo "La peugeot va lancer la méthode démarrer " . $peugeot->demarrer() . "<hr>";
echo "La renault va lancer la méthode démarrer " . $renault->demarrer() . "<hr>";

// Test de nombreDeTestsObligatoires, c'est OK ! Le nombre de test s'adapte aussi bien à la valeur d'origine reçue du parent 
echo "Nombre de test pour la Peugeot : " . $peugeot->nombreDeTestsObligatoires() . "<hr>";
echo "Nombre de test pour la Renault : " . $renault->nombreDeTestsObligatoires() . "<hr>";
