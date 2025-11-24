<?php

/* 

-- Le constructeur (__construct) 
    Le constructeur est une méthode spéciale dans une classe qui est automatiquement appelée lors de la création d'un objet à partir de cette classe. Il nous permet ici d'initialiser les propriétés de l'objet dès sa création 

-- $this 
    Le mot clé $this, fait référence à l'objet courant dans lequel il est utilisé. Il permet d'accèder aux propriétés et méthodes de cet objet depuis l'intérieur de la classe 

-- Les Getters 
    Un getter est une méthode publique qui permet d'accéder aux props d'un objet tout en gardant les propriétés elles mêmes protected/private 
    Cela permet de mieux contrôle et sécuriser l'accès aux données 

-- Les Setters 
    Un setter est une méthode publique qui permet de modifier la valeur d'une propriété protected/private. Comme pour les getters, cela permet de valider et contrôler les changements sur les propriétés. 


*/

class Utilisateur
{
    protected $nom;
    protected $email;

    // Constructeur pour initialiser les propriétés 
    // Ici, le __construct, étant une méthode magique spécifique, son comportement est de se lancer dès qu'il voit une instanciation d'objet de cette classe Utilisateur ! 
    // On lui a fournit ici des params, qui sont considérés maintenant obligatoires à fournir à l'instanciation de l'objet ! 
    // On va prendre ses params et les insérer directement dans nos setters ! Comme ça, notre obligé a ses props directement initialisées dès sa création ! 
    public function __construct($nom, $email)
    {
        // Ici dans le constructeur je lance directement mes setters, basés sur les params reçus à l'instanciation
        // Je pourrais les manipuler en "global" par exemple $this->nom   mais je reste cohérent et j'utilise mes setters pour appliquer des contrôles si jamais il y en avait ! 
        echo "<h1>Passage dans le construct !</h1>";
        $this->setNom($nom);
        $this->setEmail($email);
    }

    public function saluer()
    {
        // $this fait référence à l'objet courant/en train d'être utilisé plus loin dans notre code
        return "Bonjour, je m'appelle " . $this->nom;
    }

    // Ici le setters pour la prop nom, il me sert à insérer une valeur dans ma prop protected/private et de faire un contrôle sur le type et la longueur, ici un string d'au moins 1 carac
    public function setNom(string $newNom)
    {
        // var_dump($newNom);
        if (iconv_strlen($newNom) >= 1) {
            $this->nom = $newNom;
        } else {
            trigger_error("Le nom ne peut pas être null", E_USER_NOTICE);
        }
    }

    // Ici le getter me return la valeur de la prop nom, elle est protected/private je ne peux pas l'appeller depuis le global, le getter me permet de faire ça ! 
    public function getNom()
    {
        return $this->nom;
    }

    public function setEmail($newEmail)
    {
        $this->email = $newEmail;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

// Instanciation d'un utilisateur
// On a fait d'abord un test avec les props publique
$user = new Utilisateur("Polo", "lolo@gmail.com");
// $user->nom = "Pierro";
// $user->email = "pierro@mail.com";
// Maintenant on met les props en protected 
// Avec les props protection, je ne peux plus acceder directement à mes props depuis le scope global, je suis donc obligé de faire appel à des méthodes qui elles, vont manipuler à l'intérieur de la classe (scope local), ces props là 
// C'est ce qu'on appelle les setters et getters 

// Ici grâce à mes deux setters, je suis capable d'affecter des valeurs dans les props nom et email de mon objet Utilisateur 
// Cela permet de rester cohérent dans les appels dans le scope global, et si jamais je devais appliquer des modifications dans l'affectation (en appliquant des contrôles de type/longueur par exemple), je pourrais les faire simplement dans ma méthode setter et les appels ici dans mon scope global ne changeront pas ! 
$user->setNom("Alex");
$user->setEmail("alex@mail.com");

// // Idem ici, avec les getters, je suis capable de récupérer les données insérées dans les props de mon objet
// echo $user->getNom();
// echo $user->getEmail();

// echo $user->saluer();

var_dump($user);
