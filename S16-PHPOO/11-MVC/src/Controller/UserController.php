<?php

namespace ProjetMVC\Controller;

use ProjetMVC\Model\UserRepository;

class UserController
{

    // Cette prop va contenir un objet de type Model, c'est l'élément sur lequel on pourra appeler des méthodes qui lanceront des requêtes BDD pour récupérer notre data
    protected $model;

    public function __construct()
    {
        // echo "<h2>Initialisation du Controller UserController</h2><hr>";
        $this->model = new UserRepository;
    }

    // Ici la méthode handleRequest, me permet de comprendre les requêtes de l'utilisateur
    // Est il présent ici dans le contexte par défaut ? Que dois je faire ?
    // A-t-il cliqué sur un lien/bouton ? Validé un form ? Que dois je ? 
    public function handleRequest()
    {
        // Ici on défini que dans l'url doit etre présent un param GET s'appelant "op", tout notre système est conditionné sur ce param op
        if (isset($_GET["op"])) {
            $op = $_GET["op"];
        } else {
            $op = null;
        }

        try {
            // On va définir ici le lancement de toutes les méthodes en rapport aux actions prévues de l'utilisateur 
            if ($op == "add") {
                // Ici si l'utilisateur demande une action d'ajout d'un user
                $this->add();
            } elseif ($op == "select") {
                // Ici si l'utilisateur demande une action de select un seul user, etc.
                $this->select();
            } elseif ($op == "delete") {
                $this->delete();
            } elseif ($op == "update") {
                $this->update();
            } else {
                // Ici cas par défaut, si pas de demande spécifique du User, alors on lance la méthode d'affichage de tous les Users
                $this->selectAll();
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    // Ici, la méthode me permettant de gérer la demande d'affichage de tous les utilisateurs
    public function selectAll() {
        // Là, le cas par défaut, j'affiche tous les users
        // echo "<h3>Je suis la méthode selectAll</h3>";
        // Ici j'ai besoin d'appeler mon model pour lui demander de me retourner tous les utilisateurs de ma base 
        // A partir de cette ligne, $data est définie et contient tous les user, je transmet ensuite la data à ma vue pour les afficher
        $data = $this->model->modelSelectAll();
        $title = "Liste des user";

        
        // var_dump($data);

        // Le require ci dessous, amène ici une page html, dans cette page html j'ai l'utilisation de $data pour lancer ma boucle d'affichage des user
        // Par contre, on va plutôt préférer passer par la future méthode render()
        // require("src/View/ListUser.php");

        // Ce que je vais souhaiter faire, c'est de pouvoir découper des templates de page
        // On va considérer que sur notre site j'ai un "layout" en gros, une structure de mon site web avec un header nav footer 
        // ET qu'à l'intérieur de ce layout, je souhaite pouvoir ajouter du contenu changeant, qu'on va symboliser comme une var $content

        // Est ce que je suis capable d'insérer dans une var, un résultat d'un require ?
        // Non... Sauf, si je passe par le système d'output buffer :) 
        // La ligne ci dessous execute directement le require de ListUser.php et l'insère au mauvais endroit, on va donc devoir dev notre méthode render 
        // $content = require("src/View/ListUser.php");
        require("src/View/layout.php");

        
    }
}
