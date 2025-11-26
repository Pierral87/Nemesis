<?php 

/* 

    Les Méthodes Magiques en PHP 

    Les méthodes magiques sont des fonctions spéciales en PHP qui commencent toujours par deux underscore (__).
    Elles permettent d'intercepter certaines opérations/évènements sur des objets et d'ajouter des comportements personnalisés. 

    1 - __construct() : Le constructeur
        -- Vu au chapitre 2, est une méthode appelée automatiquement lors de la création d'un objet ! Elle est utilisée souvent pour initialiser les propriétés d'un objet 

    2 - __destruct() : Le destructeur 
        -- Le destructeur est appelé automatiquement lorsque l'objet est détruit (via unset() par exemple) ou lorsque le script se termine (tous les objets sont détruits). Il peut être utilisé pour effectuer des actions de nettoyage, comme la fermeture d'une connexion bdd, ou des sauvegardes de données

    3 - __get() et __set() : Accéder et modifier des propriétés non définies 
        -- Ces méthodes permettent de gérer dynamiquement l'accès aux propriétés d'une classe qui ne sont pas définies 
            __get() se lancera lorsqu'on tente d'accéder à une propriété qui n'existe pas 
            __set() se lancera lorsqu'on tente de définir une valeur à une prop qui n'existe pas 
                On sera capable de récupérer le nom des props demandées ainsi que la valeur à affecter

    4. __call() : Appel de méthode non définie 
        -- Cette méthode sera déclenchée lorsque l'on appelle une méthode inexistante, on sera capable de récupérer le nom de la méthode ainsi que les params fournis


*/

// #[\AllowDynamicProperties]

class Societe 
{

    public $nom; 
    public $ville;

    public function __construct($nom, $ville) {
        $this->nom = $nom;
        $this->ville = $ville;
    }

    public function __destruct() {
        echo "<hr>C'est fini pour aujourd'hui...";
    }

    public function __set($name, $value){
        echo "ATTENTION, vous tentez de manipuler une prop qui n'existe pas ! Voici les infos que vous avez envoyés : $name avec pour valeur $value <hr>";
    }

    public function __get($name){
        echo "ATTENTION, vous tentez d'appeler une propriété s'appelant : $name - Mais elle n'existe pas ! <hr>";
    }

    public function __call($name, $param) {
        echo "ATTENTION, vous tentez d'exécuter une méthode s'appelant : $name - Mais elle n'existe pas ! Voilà les params que vous aviez fournis : " . implode(" - ", $param) . "<hr>";
    }

}

$soc = new Societe("Nintendo", "Kyoto");

var_dump($soc);

echo "<h1>Coucou, c'est la société</h1>";

echo "Nom de la société $soc->nom <hr>";

// La ligne ci dessous fonctionne car on accepte par défaut les propriétés dynamiques, c'est à dire qu'on peut rajouter des props dans un objet existant ! 
// Grâce à __set() j'empèche cette possibilité
$soc->nbrEmployes = 120;

// Conditionné par __set(), cette prop n'existe pas donc __get() va se lancer
echo $soc->nbrEmployes;

// La méthode n'existe pas donc __call() va se lancer 
$soc->ajoutEmployes("Pierra", "Pierra@mail.com", "Web", "12000");

var_dump($soc);
