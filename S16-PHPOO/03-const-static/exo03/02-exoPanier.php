<?php 

/* 

Gestion de Panier 

Créez une classe Panier qui contiendra : 
    Une const MAX_ITEMS qui définira le nombre max d'articles dans le panier 
    Une prop static $totalItems qui contiendra le nombre total d'articles 
    Une méthode static ajouterProduit($quantite) qui permet d'ajouter un produit au panier en respectant la limite définie par MAX_ITEMS 
    Une méthode static afficherTotal() qui affiche le nombre total d'articles dans le panier 


*/

class Panier {

    // Constante pour le nombre max d'articles dans le panier 
    const MAX_ITEMS = 20;

    // Prop static qui contient le nombre d'articles actuels
    protected static $totalItems = 0;

    // Méthode pour ajouter un produit 
    public static function ajouterProduit($quantite) {
        if (self::$totalItems + $quantite <= self::MAX_ITEMS) {
            self::$totalItems += $quantite;
            echo "$quantite articles ajoutés au panier<hr>";
        } else {
            $restePossible = self::MAX_ITEMS - self::$totalItems;
            echo "Impossible d'ajouter au panier, on dépasse la limite qui est de : " . self::MAX_ITEMS . " vous pouvez encore rajouter $restePossible produits<hr>";
        }
    }

    // Méthode pour afficher le total d'items présents dans le panier 
    public static function afficherTotal() {
        echo "Total des articles dans le panier : " . self::$totalItems . "<hr>";
    }
}

// Tests 
Panier::afficherTotal();
Panier::ajouterProduit(2);
Panier::ajouterProduit(3);
Panier::ajouterProduit(10);
Panier::afficherTotal();
Panier::ajouterProduit(10);

session_start();
$_SESSION["user"] = "pierra";