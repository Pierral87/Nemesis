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

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = null;
        }

        try {
            // On va définir ici le lancement de toutes les méthodes en rapport aux actions prévues de l'utilisateur 
            if ($op == "add") {
                // Ici si l'utilisateur demande une action d'ajout d'un user
                $this->add();
            } elseif ($op == "select") {
                // Ici si l'utilisateur demande une action de select un seul user, etc.
                $this->select($id);
            } elseif ($op == "delete") {
                $this->delete($id);
            } elseif ($op == "update") {
                $this->update($id);
            } else {
                // Ici cas par défaut, si pas de demande spécifique du User, alors on lance la méthode d'affichage de tous les Users
                $this->selectAll();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    // La méthode render me permet de gérer l'affichage de mes vues en chargeant le centre de page dans $content et d'appeler par la suite le layout, on va modeler la page et une fois qu'elle sera modelée on pourra l'envoyer à l'utilisateur 
    public function render($layout, $vue, $parameters = array())
    {
        extract($parameters);
        // extract() : fonction prédéfinie qui permet d'extraire chaque key d'un array, les transformer en variable et reçoit en valeur le contenu de cette key 
        // "title" => "liste des users"  devient  $title = "liste des users"

        ob_start(); // On démarre une mise en tampon 
        // A partir de là les instructions ne sont pas directement renvoyées à l'utilisateur, cela va me permettre de faire plusieurs opérations afin de modéliser ma page pour ensuite la renvoyer, une fois terminée, à l'utilisateur ! 

        require_once "src/View/$vue"; // Ce require n'est pas affiché à l'utilisateur, il est "de côté" dans la zone de stagging / dans l'output buffer 

        $content = ob_get_clean(); // ici, ob_get_clean fait une récupération des éléments chargés dans l'output buffer, je récupère ici dans $content, un morceau de page entière (à savoir la $vue qui a été demandé (pour selectAll, c'est mon fichier php ListUser.php))

        ob_start();
        require_once "src/View/$layout"; // Envoi du layout, c'est la structure de notre page, maintenant que $content est défini, il va être capable de l'insérer dans le centre de la page 

        return ob_end_flush(); // Va libérer tout l'affichage et fait apparaitre à l'utilisateur la page entièrement modélisé en back, elle va contenir notre layout à l'intérieur duquel on a inséré le $content à l'intérieur duquel on a inséré la $data
    }

    // Ici, la méthode me permettant de gérer la demande d'affichage de tous les utilisateurs
    public function selectAll()
    {
        // Là, le cas par défaut, j'affiche tous les users
        // echo "<h3>Je suis la méthode selectAll</h3>";
        // Ici j'ai besoin d'appeler mon model pour lui demander de me retourner tous les utilisateurs de ma base 
        // A partir de cette ligne, $data est définie et contient tous les user, je transmet ensuite la data à ma vue pour les afficher
        $data = $this->model->modelSelectAll();
        // $title = "Liste des user";

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
        // require("src/View/layout.php");

        $this->render("layout.php", "ListUser.php", [
            "title" => "Liste des users",
            "data" => $data
        ]);
    }

    public function select($id)
    {
        $data = $this->model->modelSelectOne($id);

        // var_dump($data);
        $this->render("layout.php", "OneUser.php", [
            "title" => "Information de l'utilisateur $id",
            "data" => $data
        ]);
    }
}
