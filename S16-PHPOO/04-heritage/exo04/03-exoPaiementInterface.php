<?php 

/* 

    Créer une interface PaiementInterface avec une méthode executerPaiement().
    Créer une classe abstraite Paiement qui implémente cette interface, avec une méthode abstraite traiterPaiement().
    Créer deux classes PaiementCarte et PaiementVirement qui héritent de Paiement et implémentent la méthode abstraite.
    Utilise un trait ValidationPaiement avec une méthode valider() qui vérifie les détails du paiement avant de l'exécuter.
    Dans une des classes (par exemple PaiementCarte), empêcher la surcharge d'une méthode en la marquant comme final.

*/