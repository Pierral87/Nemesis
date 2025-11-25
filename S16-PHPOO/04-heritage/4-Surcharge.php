<?php 

/* 

Surcharge (Override)

*/

class Animal {
    public $nom; 

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function seDeplacer() {
        echo "$this->nom se déplace<hr>";
    }
}

class Oiseau extends Animal {
    // On redéfinit la méthode seDeplacer, je suis en train de surcharger/override la méthode 
        // En gros, j'écrase la méthode reçu par l'héritage car je veux la redéfinir et amener un comportement spécifique à cette sous classe tout en gardant le même nom de méthode (pour garder commun mes appels dans le reste du code entre mes sous classes)

        // Je peux soit "écraser" totalement le contenu de la méthode héritée, soit, grâce à la syntaxe parent::seDeplacer() je peux refaire appel au contenu de la méthode du parent et y apporter un complément ! 
    public function seDeplacer()
    {
        // parent::seDeplacer();  // A cette ligne, on exécute la totalité de la méthode du parent

        // Puis on rajoute le code de notre choix 
        echo "Mais en fait vole haut dans les airs";

        // Ou sinon en gardant la ligne en dessous uniquement, on écrase totalement le contenu d'origine
        // echo "$this->nom vole dans les airs";
    }
}

$oiseau = new Oiseau("Yuzo");
$oiseau->seDeplacer();

// La surcharge nous permet de garder une uniformisation des appels dans le reste de notre code, que ce soit un Chien un Chat un Oiseau ou autre, tous les objets seront capable de lancer la méthode seDeplacer(), par contre, la méthode en question sera peut être spécifique dans certains objets, car on l'aura modifiée au travers de la surcharge ! 