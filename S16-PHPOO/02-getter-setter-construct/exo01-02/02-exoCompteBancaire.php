<?php

/* 

EXERCICE : 
            Création d'une classe CompteBancaire selon la modélisation suivante 

    ----------------------
    |   CompteBancaire   |
    ----------------------
    | -titulaire:string  |
    | -solde:float       |
    ----------------------
    | +__construct()     |
    | +getTitulaire()    |
    | +setTitulaire()    |
    | +getSolde()        |
    | +setSolde()        |
    | +afficherSolde()   |
    | +retirer()         |
    | +deposer()         |
    ----------------------

*/

class CompteBancaire
{
    protected string $titulaire;
    protected float $solde;

    public function __construct(string $initTitulaire, float $initSolde)
    {
        $this->setTitulaire($initTitulaire);
        $this->setSolde($initSolde);
    }

    public function getTitulaire()
    {
        return $this->titulaire;
    }
    public function setTitulaire(string $newTitulaire)
    {
        $this->titulaire = $newTitulaire;
    }
    public function getSolde()
    {
        return $this->solde;
    }
    public function setSolde(float $newSolde)
    {
        if ($newSolde < 0) {
            return trigger_error("Le solde ne peut pas etre negatif");
        }
        $this->solde = $newSolde;
    }

    public function afficherSolde()
    {
        echo "<h1> Le solde de " . $this->getTitulaire() . " est : " . $this->getSolde() . "</h1>";
    }

    public function retirer(float $montant)
    {
        if ($montant > 0) {
            $newSolde = $this->getSolde() - $montant;
            if ($newSolde < 0) {
                return trigger_error($this->getTitulaire() . " n'a pas assez de 💵💵💵");
            }
            $this->setSolde($newSolde);
        } else {
            trigger_error("Il n'est pas possible de retirer un montant négatif", E_USER_NOTICE);
        }
    }

    public function deposer(float $montant)
    {
        if ($montant > 0) {
            $this->setSolde($this->getSolde() + $montant);
        } else {
            trigger_error("Il n'est pas possible de déposer un montant négatif", E_USER_NOTICE);
        }
    }
}

$compteA = new CompteBancaire("Joe", 50.15);
$compteA->afficherSolde();
$compteA->deposer(50.0);
$compteA->afficherSolde();
$compteA->retirer(24.99);
$compteA->afficherSolde();
// $compteA->retirer(5000.0);
// $compteA->deposer(-150);
$compteA->afficherSolde();

$compteA->retirer(10);
$compteA->afficherSolde();
