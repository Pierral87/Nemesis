<?php

/* 

    Créer une interface PaiementInterface avec une méthode executerPaiement().
    Créer une classe abstraite Paiement qui implémente cette interface, avec une méthode abstraite traiterPaiement().
    Créer deux classes PaiementCarte et PaiementVirement qui héritent de Paiement et implémentent la méthode abstraite.
    Utilise un trait ValidationPaiement avec une méthode valider() qui vérifie les détails du paiement avant de l'exécuter.
    Dans une des classes (par exemple PaiementCarte), empêcher la surcharge d'une méthode en la marquant comme final.

*/

interface PaiementInterface
{
    public function executerPaiement(float $montant);
}

trait ValidationPaiement
{
    public function valider(float $montant)
    {
        return ($montant > $this->limit) ? false : true;
    }
}

abstract class Paiement implements PaiementInterface
{
    protected int $limit = 1000;
    public function executerPaiement(float $montant)
    {
        return $this->traiterPaiement($montant);
    }
    abstract public function traiterPaiement(float $montant);
}

class PaimentCarte extends Paiement
{
    use ValidationPaiement;
    public function traiterPaiement(float $montant)
    {
        if ($this->valider($montant)) {
            return 'Paiement de CB traiter pour le montant : ' . $montant . '€';
        } else {
            return 'Paiement refusé';
        }
    }
}

class PaiementVirement extends Paiement
{
    use ValidationPaiement;
    final public function traiterPaiement(float $montant)
    {
        if ($this->valider($montant)) {
            return 'Virement traiter pour le montant : ' . $montant . '€';
        } else {
            return 'Virement refusé';
        }
    }
}

$paiementCB = new PaimentCarte;
$paiementVirement = new PaiementVirement;
echo "Paiement CB de 30 Euro : <hr>";
echo $paiementCB->executerPaiement(30.00);
echo "<br><br><br>";

echo "Virement de 499.99 Euro : <hr>";
echo $paiementVirement->executerPaiement(499.99);
echo "<br><br><br>";

echo "Virement de 1000.1 Euro (Echec) : <hr>";
echo $paiementVirement->executerPaiement(1000.1);
echo "<br><br><br>";
