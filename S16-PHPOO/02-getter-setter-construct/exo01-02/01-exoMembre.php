<?php

/************************************
   
    EXERCICE :
        Création d'une classe Membre avec cette modélisation 

    ----------------------
    |   Membre           |
    ----------------------
    |  - pseudo :string  |
    |  - email :string   |
    ----------------------
    | + __construct()    |
    | + getPseudo()      |
    | + setPseudo()      |
    | + getEmail()       |
    | + setEmail()       |
    ----------------------

            // S'assurer du bon fonctionnement de la classe à l'instanciation, à l'appel de ses props/méthodes
            // Appliquer des contrôles sur les setters et gérer les cas d'erreurs d'une façon ou d'une autre 

   
 ************************** */

class Membre
{
    private $pseudo;
    private $email;

    public function __construct($pseudo, $email) 
    {
        echo "<h2>Instanciation de l'objet... nous avons reçu les informations suivantes : $pseudo et $email </h2><hr>";
        $this->setPseudo($pseudo);
        $this->setEmail($email);
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $newPseudo): void
    {
        if (iconv_strlen($newPseudo) <= 30 && iconv_strlen($newPseudo) >= 4) {
            $this->pseudo = $newPseudo;
        } else {
            trigger_error("Attention, le pseudo doit être un string de moins de 30 carac", E_USER_ERROR);
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($newEmail): void 
    {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $this->email = $newEmail;
        } else {
            trigger_error("Attention, le format d'email n'est pas correct", E_USER_ERROR);
        }
    }
}

$membre1 = new Membre("Pierra", "pierra@mail.com");
// $membre1->setPseudo("Pierra");
// $membre1->setEmail("Pierra@mail.com");
var_dump($membre1);
