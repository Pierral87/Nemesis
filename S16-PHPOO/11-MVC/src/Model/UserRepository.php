<?php

namespace ProjetMVC\Model;

require_once __DIR__ . "/../partials/_config.php";

use PDO;

class UserRepository
{

    // Je vais définir une prop qui va contenir l'objet pdo
    private $db;

    public function __construct()
    {
        // echo "<h3>Initialisation du Model UserRepository</h3><hr>";
        // $this->getDb();
    }

    // getDb() est une méthode permettant de créer l'objet PDO et de le retourner, au lieu d'utiliser un $pdo, on va à chaque fois appeler getDb()
    // Ici aussi on s'assure de ne pas recréer l'objet PDO s'il est déjà créé
    public function getDb()
    {
        if (!$this->db) {
            try {
                $this->db = new PDO('mysql:host=' . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, DB_OPTIONS);
                // var_dump($this->db);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $this->db;
    }

    // Ici une méthode qui ne se pose pas la question de ce qui a conditionné cette action, et lance simplement la requête SELECT * FROM user
    // On return le résultat du fetchAll à savoir un array à deux niveaux, chaque élément du array correspond à un user
    // Cette information est transmise au controller
    public function modelSelectAll() {
        return $this->getDb()->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
    }
}
