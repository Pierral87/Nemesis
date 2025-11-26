<?php 

/* 
    Créer une classe CompteUtilisateur avec les propriétés protégées $nom et $email, ainsi qu'une méthode afficherInfos() qui affiche les informations de l'utilisateur.
    Crée une classe ComptePremium qui hérite de CompteUtilisateur et surcharge la méthode afficherInfos() pour ajouter "Compte Premium" dans les informations affichées.
    Instancie les deux types d’utilisateurs et appelle leurs méthodes afficherInfos().

    */

class CompteUtilisateur
{
    protected $nom;
    protected $email;

    public function __construct($nom, $email)
    {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function afficherInfos()
    {
        echo "Nom : " . $this->nom . "<br>";
        echo "Email : " . $this->email . "<br>";
    }
}

class ComptePremium extends CompteUtilisateur
{
    public function afficherInfos()
    {
        echo "=== Compte Premium ===<br>";
        parent::afficherInfos();
    }
}

// instanciation + tests
echo "=== Utilisateur Standard ===<br>";
$utilisateur1 = new CompteUtilisateur("Jean Dupont", "jean.dupont@email.com");
$utilisateur1->afficherInfos();

echo "<br>";

$utilisateur2 = new ComptePremium("Marie Martin", "marie.martin@email.com");
$utilisateur2->afficherInfos();

?>