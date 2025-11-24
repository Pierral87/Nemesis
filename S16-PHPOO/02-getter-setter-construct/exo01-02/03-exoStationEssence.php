<?php

/*********************
 
    EXERCICE :

        Création de la classe Vehicule et de la classe Pompe en suivant ces modélisations

    ----------------------
    |   Vehicule         |
    ----------------------
    |-litresReservoir:int|
    ----------------------
    |+setlitresReservoir()|
    |+getlitresReservoir()|
    ----------------------

    ----------------------
    |   Pompe            |
    ----------------------
    | -litresStock:int   |
    ----------------------
    | +setlitresStock()  |
    | +getlitresStock()  |
    | +donnerEssence()   |
    ----------------------

        Spécifications : 
                -- Le but étant ici de réussir à développer la méthode donnerEssence, en gros, lorsqu'un véhicule passe à la station, il fait le plein si c'est possible, cela induit forcément des opérations pour le Vehicule et pour la Pompe 
                -- On considère que dans notre système, une voiture possède un stock max de 50 litres
                    -- On considère aussi que lorsqu'elle passe à la pompe à essence, elle met automatiquement le plein d'essence (si c'est possible)
                        -- Il va falloir gérer les exceptions de notre système

 */

class Vehicule
{

    protected int $litresReservoir;

    public function setlitresReservoir(int $newLitresReservoir)
    {
        $this->litresReservoir = $newLitresReservoir;
    }

    public function getlitresReservoir()
    {
        return $this->litresReservoir;
    }
}

class Pompe
{

    protected int $litresStock;

    public function setlitresStock(int $newLitresStock)
    {
        $this->litresStock = $newLitresStock;
    }

    public function getlitresStock()
    {
        return $this->litresStock;
    }

    // Ici la méthode donnerEssence prends en param un objet de type Vehicule 
        // Qu'est ce que cela induit ? Que nous avons accès à tout ce qui définit un véhicule, à l 'intérieur de notre méthode donnerEssence ! 
            // C'est à dire, je peux appeler le getLitresReservoir de mon vehicule pour comprendre par la suite combien il lui manque de litres ! 
    
    public function donnerEssence(Vehicule $vehicule)
    {
        // Les litres de la voiture
        $litresActuelsVoiture = $vehicule->getlitresReservoir();

        // Les litres manquants pour le plein
        $litresNecessairesVoiture = 50 - $litresActuelsVoiture;

        // Les litres dispo dans la pompe
        $litresDisponiblesPompe = $this->getlitresStock();

        // Ici, grâce à min() on s'évite un gros bloc if couvrant tous nos scénarios à savoir : 
                // 1 - Pompe vide, peut rien donner ! 
                // 2 - Pompe avec beaucoup de litres, peut faire le plein ! 
                // 3 - Pompe avec peu de litres, peut pas faire le plein, mais peut donner tous ses litres ! 

            // litresADonner permet d'identifier quelle est la valeur minale entre "les litres manquants à la voiture" et "les litres restants à la pompe"
            // Ce qui nous permet de couvrir automatiquement tous nos cas  
        $litresADonner = min($litresNecessairesVoiture, $litresDisponiblesPompe);

        // Je défini ici les nouveaux litres de la voiture
        $nouveauNiveauVoiture = $litresActuelsVoiture + $litresADonner;
        $vehicule->setlitresReservoir($nouveauNiveauVoiture);

        // Je défini ici les nouveaux litres de la pompe
        $nouveauStockPompe = $litresDisponiblesPompe - $litresADonner;
        $this->setlitresStock($nouveauStockPompe);
    }
}

$vehicule1 = new Vehicule;
$vehicule1->setlitresReservoir(20);

$vehicule2 = new Vehicule;
$vehicule2->setlitresReservoir(30);

$vehicule3 = new Vehicule;
$vehicule3->setlitresReservoir(10);

$pompe1 = new Pompe;
$pompe1->setlitresStock(45);

echo "Vehicule 1 et Pompe 1 avant passage : <hr>";
var_dump($vehicule1);
var_dump($pompe1);
$pompe1->donnerEssence($vehicule1);

echo "Vehicule 1 et Pompe 1 après passage : <hr>";
var_dump($vehicule1);
var_dump($pompe1);

echo "<hr><hr><hr>";

echo "Vehicule 2 et Pompe 1 avant passage : <hr>";
var_dump($vehicule2);
var_dump($pompe1);
$pompe1->donnerEssence($vehicule2);

echo "Vehicule 2 et Pompe 1 après passage : <hr>";
var_dump($vehicule2);
var_dump($pompe1);


echo "<hr><hr><hr>";

echo "Vehicule 3 et Pompe 1 avant passage : <hr>";
var_dump($vehicule3);
var_dump($pompe1);
$pompe1->donnerEssence($vehicule3);

echo "Vehicule 3 et Pompe 1 après passage : <hr>";
var_dump($vehicule3);
var_dump($pompe1);
