<?php 

// Traits : 
    // Les traits permettent de regrouper des méthodes et des props réutilisables dans des classes sans passer par un héritage 
    // Les traits sont là pour en quelque sorte contourner la limitation de ne pas avoir la possibilité de faire des héritages multiples
        // Avec les traits, pas de soucis, je peux en use(importer dans ma classe) autant que je le souhaite 

    // Ci dessous nos deux traits permettent d'apporter chacun une nouvelle méthode à notre classe Utilisateur1 

trait Identifiable {
    public function afficherId() {
        echo "Mon ID est : 32";
    }
}

trait Authentifiable {
    public function seConnecter() {
        echo "Je me connecte";
    }
}

class Utilisateur1 {
    use Identifiable, Authentifiable;
}

// Attention, on ne peut pas instancier un trait ! Il a simplement pour but d'être importé par une classe
// $trait = new Identifiable;

$utilisateur = new Utilisateur1;
$utilisateur->afficherId();
$utilisateur->seConnecter();