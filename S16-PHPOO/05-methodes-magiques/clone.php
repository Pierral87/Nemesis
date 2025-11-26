<?php 

class Ecole 
{
    public $nom = "Cloud Campus";
    public $cp = 75;

    public function __clone() // cette methode s'execute dès qu'un clone est créé et impacte le nouvel objet (pas celui qui sert de modèle)
    {
        // Là je modifie le nom de l'école nouvellement créée par le clone
        $this->nom = "Nouveau nom à insérer ici";
    }
}

// ----------------------------------
$ecole1 = new Ecole; // création de l'objet #1 
$ecole1->cp = 92;
echo "<h2>Ecole 1</h2>";
var_dump($ecole1); 
$ecole2 = new Ecole; // création de l'objet #2 
$ecole2->nom = "Pierra Digital Formation";
$ecole2->cp = 64;
echo "<h2>Ecole 2</h2>";
var_dump($ecole2);
// $ecole3 = $ecole1; // Ici je pense faire une copie d'objet mais non ! Je fais simplement un ajout d'un marqueur qui représentera le même objet que $ecole1 à savoir l'objet #1 
    // Toute modification qui interviendra au travers de $ecole1 ou $ecole3 modifiera l'objet #1
$ecole3 = clone $ecole1; // Si par contre je fais un clone, via cette instruction, je vais réellement créer un nouvel objet #3, représenté par $ecole3, cet objet aura les mêmes valeurs/props que l'objet qui lui sert de modèle
    // Si la méthode magique __clone() est définie, alors, son code s'exécutera dès qu'un clone est demandé, par exemple ici
echo "<h2>Ecole 3</h2>";
var_dump($ecole3);

$ecole3->cp = 01;  // Ici si j'ai fais un clone, je modifie bien un objet #3, sinon, je modifie l'objet #1
var_dump($ecole3);

echo "<hr><hr><hr>";
echo "<h2>Récap des écoles</h2>";
// $ecole1->cp = 92;
echo "<h2>Ecole 1</h2>";
var_dump($ecole1);
echo "<h2>Ecole 2</h2>";
var_dump($ecole2);
echo "<h2>Ecole 3</h2>";
var_dump($ecole3);