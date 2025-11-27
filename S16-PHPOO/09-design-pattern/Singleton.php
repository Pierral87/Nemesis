<?php

/* 

Les design patterns ("patron de conception") sont des solutions récurrents à des problèmes courants de conception logicielle. 

Ce sont des structures ou modèles que l'on peut adapter à nos propres besoins dans le developpement d'application.

Ils améliorent la maintenabilité, la lisibilité et la réutilisabilité du code. 

Il existe plusieurs type de pattern à savoir 

    - Patterns Créationnels 
        - Concernent la manière de créer des objets, en s'assurant que le processus de création est adapté à la situation 
    - Patterns Structurels 
        - Se concentrent sur la composition d'objets et de classes pour former des structures plus grandes et efficaces 
    - Patterns Comportementaux
        - Se concentrent sur les interactions et la communication entre les objets 


Liste des patterns : 

    - Créationnels : 
            Singleton : Garantit qu'une classe n'a qu'une seule instance.
            Factory Method : Définit une interface pour créer des objets, mais laisse les sous-classes choisir la classe concrète à instancier.
            Abstract Factory : Fournit une interface pour créer des familles d'objets liés ou dépendants sans avoir à spécifier leurs classes concrètes.
            Builder : Sépare la construction d'un objet complexe de sa représentation pour que le même processus puisse créer différentes représentations.
            Prototype : Crée de nouveaux objets en clonant des instances existantes.

    - Structurels : 
            Adapter : Permet à des classes avec des interfaces incompatibles de fonctionner ensemble.
            Decorator : Attache dynamiquement des responsabilités supplémentaires à un objet.
            Proxy : Fournit un objet substitut ou représentant pour contrôler l'accès à un autre objet.
            Bridge : Sépare l'interface d'un objet de son implémentation pour qu'ils puissent varier indépendamment.
            Composite : Compose des objets en structures arborescentes pour représenter des hiérarchies.
            Facade : Fournit une interface simplifiée à un ensemble de sous-systèmes.
            Flyweight : Utilise le partage pour supporter efficacement de nombreux petits objets.

    - Comportementaux : 
            Observer : Définit une dépendance entre objets pour qu’un objet notifie automatiquement ses changements à d'autres.
            Strategy : Définit une famille d'algorithmes, encapsule chaque algorithme, et les rend interchangeables.
            Command : Encapsule une requête en tant qu’objet, permettant de paramétrer des clients avec des requêtes différentes.
            Iterator : Fournit un moyen d'accéder aux éléments d'une collection de manière séquentielle sans exposer sa représentation interne.
            Template Method : Définit la structure d'un algorithme, mais laisse certaines étapes aux sous-classes.
            State : Permet à un objet de changer de comportement lorsque son état change.
            Mediator : Définit un objet qui centralise la communication entre différentes classes.
            Memento : Capture et restaure l'état interne d'un objet sans violer son encapsulation.
            Chain of Responsibility : Permet de passer une requête à travers une chaîne de gestionnaires potentiels jusqu'à ce qu'elle soit traitée.
            Visitor : Permet de définir une nouvelle opération sans changer les classes des éléments sur lesquels elle opère.
            Interpreter : Définit une grammaire et un interprète pour les représentations de cette grammaire.



    Présentation pattern Singleton : 

    Le Singleton garantit qu'une classe n'a qu'une seule et unique instance sur l'application 

        // En POO le Singleton repond à la problématique de "je ne veux qu'un seul objet de cette classe dans le programme" 
        // En Web : La connexion au serveur de la BDD par exemple 
        // Afin de préserver l'unicité il est judicieux de suivre le pattern Singleton 

        // Un singleton est composé de 3 caractéristiques : 
            // - Une prop private et static qui conservera l'instance unique de la classe
            // - Un constructeur private afin d'empêcher la création d'objet depuis l'extérieur de la classe (depuis le scope global) 
            // - Une méthode statique qui permet de faire la première instanciation de la classe et de retourner la prop qui la contient
                        // A chaque fois que cette méthode sera lancée, elle retournera simplement le contenu de la prop contenant l'instance, à savoir la seule et unique instance de notre classe 

*/

class Singleton
{
    private static $instance = null;

    private function __construct()
    {
        echo "Une instanciation de Singleton<hr>";
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

// Si je peux instancier depuis l'extérieur, alors je pourrais avoir plusieurs objets
// Pour bloquer l'instanciation depuis le scope global, je mets mon constructeur en private 
// $objet1 = new Singleton;
// $objet2 = new Singleton;
// $objet3 = new Singleton;

// Ici premier appel de getInstance, il va créer l'objet et l'insérer dans la prop private static
// Egalement, il me le return donc je peux le récupérer dans $objet1
$objet1 = Singleton::getInstance();
var_dump($objet1);
// A partir d'ici, l'objet étant déjà créé, l'appel de getInstance() ne fait plus de création d'objet, mais simplement le return, je récupère ici dans $objet2, le même objet qui est aussi représenté par $objet1
$objet2 = Singleton::getInstance();
var_dump($objet2);
// Idem ici $objet3 représente toujours le même objet - l'unicité est préservée ! 
$objet3 = Singleton::getInstance();
var_dump($objet3);

