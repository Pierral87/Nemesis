<?php 

/* 

    Les Namespaces en PHP 

    Les namespaces en PHP sont un moyen d'organiser et structurer les classes de manière logique, en évitant les conflits de nom, particulièrement dans les projets où on possède un multitude de classes, des bibliothèques rajoutées etc

    Les namespaces permettent d'éviter les collisions de noms en séparant les classes dans ces espaces différents (comme des dossiers)

    Sans les namespaces toutes les classes sont déclarés dans un espace global, cela peut rapidement nous poser soucis dans de grands projets 


*/

// Librairie 1
// class Utilisateur {
// }
// // Librairie 2 
// class Utilisateur {
// }


// Declaration d'un namespace LibrairieA ce qui permet de définir une classe Utilisateur défini dans LibrairieA
namespace LibrairieA; 
class Utilisateur {
    public function getNom() {
        return "Pierro";
    }
}

// Idem ici, je définie un namespace LibrairieB ce qui permet de définir une classe utilisateur dans Librairie B
namespace LibrairieB; 
class Utilisateur {
    public function getNom() {
        return "Bob";
    }
}

// Plus de conflit ici, le système considère qu'elles viennent de namespace différents, donc sont toutes deux différentes 

// Ici constante magique nous permet de comprendre dans quel namespace on se trouve
echo __NAMESPACE__;

$user = new Utilisateur;
echo $user->getNom();
var_dump($user);

// Lorsque je souhaite appeller/instancier un objet d'une classe ayant un namespace je dois le faire via son nom complet
    // C'est ce qu'on appelle le FQN : Fully Qualified Name 
$userA = new \LibrairieA\Utilisateur;
var_dump($userA);


// On peut également avoir des namespace composés, en séparant les différents namespace par des  \  
namespace MonProjet\Modele;

class Utilisateur {
    public function getNom() {
        return "Alex";
    }
}

// --- Bien déclarer un namespace 
    // La déclaration d'un namespace se fait en ajoutant le mot-clé namespace au début du fichier PHP AVANT TOUTE AUTRE INSTRUCTION 

    // On appelle une classe avec un namespace grace à son FQN 
    $utilisateur = new \MonProjet\Modele\Utilisateur();

    echo $utilisateur->getNom();
    var_dump($utilisateur);


    // Si je souhaite éviter de citer les FQN, lorsque les noms sont trop long ou avec beaucoup de namespace
    // Je peux utiliser l'instruction "use"
namespace MonProjet\Controller;

// Les use ci dessous me permettent de ramener sur cette page (ce namespace ici depuis la ligne 75) les classe Utilisateur des namespaces LibrairieB et MonProjet/Modele, et ça sans avoir besoin de citer les FQN, on considère qu'elles sont "importés" sur notre page

// Si jamais deux classes ont le même nom, pas de soucis on pourra leur donner des alias comme ici notre UserB
use LibrairieB\Utilisateur as UserB;
use MonProjet\Modele\Utilisateur;

$utilisateurA = new Utilisateur;
echo $utilisateurA->getNom();

$utilisateurB = new UserB;

// Namespace GLobal : 
    // Lorsque je suis dans un namespace JE NE SUIS PLUS DANS LE SCOPE GLOBAL DE PHP 
    // Ce qui veut dire que je n'ai plus accès aux classes natives de PHP "basiquement", par exemple ci dessous un new Exception me retourne une erreur car il cherche une classe Exception dans le namespace MonProjet\Controller plutôt que Exception du scope global
    // Le fait de rajouter un \ devant le nom \Exception me permet de retourner vers l'espace le temps de la ligne 
class MonController {
    public function maMethode() {
        throw new \Exception;
    }
}

/* 

    --- Fonctionnement des Namespaces avec les dossiers 

    Il est recommandé de faire correspondre la structure des namespace avec la structure des dossiers pour mieux organiser le projet 

    Exemple : 

    - MonProjet/ 
        - Modele/ 
            - Utilisateur.php 
        - Controller/ 
            - UtilisateurController.php 

Ainsi le fichier Utilisateur.php pourrait avoir le namespace Monprojet\Modele et UtilisateurController.php le namespace MonProjet\Controller 

Pourquoi est ce qu'on fait ça ? Pour préparer et faire bien fonctionner notre futur autoload ! 

    Les namespaces sont généralement utilisés conjointement avec l'autoload des classes pour éviter de devoir inclure manuelle chaque fichier.

    -- Pour l'organisation des dossiers/fichiers on utilise la convention PSR-4  

    La convention PSR-4 c'est une convention de nommage et d'organisation des fichiers dans un projet qui vise à standardiser l'autoloading des classes en permettant de mapper les namespaces aux dossiers et les classes aux fichiers.

    -- Chaque classe doit avoir un namespace qui correspond à sa structure de repertoire sur le serveur 
    -- Nom de la classe doit correspondre au nom deu fichier dans lequel la classe est définie (class Utilisateur = fichier Utilisateur.php)

*/


