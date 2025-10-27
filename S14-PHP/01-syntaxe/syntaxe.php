<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syntaxe PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Syntaxe PHP</h2>
        <!-- Il est possible d'écrire de l'html dans un fichier.php
         En revanche l'inverse n'est pas possible ! -->

        <?php
        // Ouverture de la balise PHP

        // Ceci est un commentaire sur une ligne
        # Ceci est un commentaire sur une seule ligne
        /* 
            Commentaire
            Entre deux
            indicateurs
        */


        // Fermeture de la balise PHP

        // La doc officiel de PHP 
        // www.php.net 

        // Les bonnes pratiques et convention d'écriture PHP 

        // https://phptherightway.com 

        echo "<h2>01 - Instruction d'affichage</h2>";

        // echo est une instruction du langage permettant de générer un affichage 

        // ATTENTION chaque instruction doit se terminer par un ";" 

        echo "Bonjour";
        echo " à tous";
        echo "<br>";

        print "Nous sommes lundi<br>"; // Autre instruction permettant de générer un affichage similaire à echo
        // Nous utiliserons toujours echo pour une raison simple, echo est capable de gérer les deux types de concaténation 

        echo "<h2>02 - Variables : déclaration / affectation / type </h2>";
        // Une variable est un espace nommé permettant de conserver une valeur.
        // Une variable en PHP on la déclare avec le signe $ 
        // Caractères autorisés : a-z A-Z 0-9 _
        // PHP est sensible à la casse (une minuscule n'est pas équivalent à une majuscule)
        // Une variable ne peut pas commencer par un chiffre ! 

        $a = 123; // déclaration de la variable nommée "a" et affectation de la valeur 123 
        echo $a;
        // gettype() est une fonction prédéfinie permettant de nous renvoyer une chaine de caractère représentant le type d'une variable 
        echo gettype($a); // integer c'est un entier 
        echo "<br>";

        $a = 1.5; // On change la valeur de a ici, elle est écrasée par la nouvelle 
        echo $a;
        echo gettype($a); // double ou float = chiffre décimal 
        echo "<br>";

        $a = "une chaine";
        echo $a;
        echo gettype($a); // string = chaine de caractères
        echo "<br>";

        $b = true;
        echo $b;
        echo gettype($b); // boolean // vrai ou faux // 1 ou 0  
        echo "<br>";

        // Il reste deux autres types que nous verrons dans d'autres chapitres (array/object)

        echo "<h2>03 - Concaténation</h2>";
        // La concaténation consiste à assembler des chaines de caractères 
        // Caractère de concaténation c'est le "point" : .   ou bien la "virgule" : , 
        // Le caractère de concaténation peut toujours se traduire "suivi de"

        $x = "Bonjour";
        $y = "tout le monde";

        // Sans concaténation 
        echo $x;
        echo " ";
        echo $y;
        echo "<br>";

        // Avec concaténation 
        echo $x . " " . $y . "<br>";

        // Concaténation avec la virgule 
        echo $x, " ", $y, "<br>";

        // Concaténation lors de l'affectation 
        $prenom = "Pierre";
        $prenom = "Alexandre"; // Cela écrase la valeur précédente 
        echo $prenom . "<br>";

        // Pour rajouter sans écraser : 

        $prenom2 = "Pierre";
        $prenom2 = $prenom2 . "-Alexandre";
        echo $prenom2 . "<br>";

        // Raccourci 
        $prenom3 = "Pierre";
        $prenom3 .= "-Alexandre";

        echo $prenom3 . "<br>";

        echo "<h2>04 - Guillemets et apostrophes</h2>";

        $x = "Bonjour";
        $y = "tout le monde";

        // Dans les guillemets, une variable est reconnue et donc est interprétée 
        // Dans les apostrophes, une variable ne sera pas reconnue et interprétée comme un simple string 

        echo "$x $y <br>";
        echo '$x $y <br>';

        echo "<h2>05 - Constantes</h2>";
        // Une constante comme une variable permet de conserver une valeur
        // Cependant, comme son nom l'indique, cette valeur restera... constante
        // Elle ne pourra plus être modifiée, passé sa définition
        // Par convention d'écriture, une constante s'écrit en majuscule

        // On parle ici de constante globale 

        // déclaration et affectation : 
        // define(SON_NOM, sa_valeur);
        define("URL", "http://www.monsite.fr/");
        echo URL . "<br>";
        // Par exemple ici une constante qui défini la racine de mon site, pour travailler avec des URL absolues plus facilement 

        // define("URL", "coucou"); // Une fois une constante déclarée, je ne peux plus changer sa valeur 

        // Constantes magiques 
        // Déjà inscrites au langage 

        echo __FILE__ . "<br>";  // Le chemin absolu depuis le serveur vers ce fichier 
        echo __LINE__ . "<br>"; // le numéro de ligne
        echo __DIR__ . "<br>"; // le chemin vers le dossier contenant ce fichier 

        echo "<h2>Exercice variables</h2>";
        // Créer 3 variables et leur assigner très exactement les valeurs suivantes "bleu", "blanc", "rouge"
        // Ensuite, générer un affichage avec UN SEUL ECHO pour obtenir : 
        // bleu - blanc - rouge 
        // Plusieurs façons possibles, l'objectif étant de trouver la façon la plus courte 

        $a = "bleu";
        $b = "blanc";
        $c = "rouge";

        echo $a . " - " . $b . " - " . $c . "<br>";
        // On profite au max de notre syntaxe avec les guillemets interprétant les variables 
        echo "$a - $b - $c <br>";

        echo "<h2>Opérateurs arithmétiques</h2>";

        $a = 10;
        $b = 5;

        // Addition :
        echo $a + $b . "<br>";
        // Soustraction :
        echo $a - $b . "<br>";
        // Multiplication :
        echo $a * $b . "<br>";
        // Division :
        echo $a / $b . "<br>";
        // Puissance :
        echo $a ** $b . "<br>";
        // Modulo :
        echo $a % $b . "<br>";

        $a += $b; // équivaut à écrire $a = $a + $b
        $a -= $b;
        $a *= $b;
        $a /= $b;
        $a **= $b;
        $a %= $b;

        echo "<h2>06 - Conditions & opérateurs de comparaison</h2>";

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) { // Si la valeur de x est strictement supérieure à la valeur de y 
            echo "Vrai, la valeur de x est bien strictement supérieure à la valeur de y<br>";
        } else {
            echo "Faux, la valeur de x n'est pas strictement supérieure à la valeur de y<br>";
        }

        // Plusieurs conditions obligatoires : AND => && 
        if ($x > $y && $y > $z) {
            echo "Ok pour les deux conditions<br>";
        } else {
            echo "L'une ou l'autre ou les deux conditions sont fausses<br>";
        }

        // L'une ou l'autre d'un ensemble de conditions : OR => ||
        if ($x > $y || $y < $z) {
            echo "Ok pour au moins une condition<br>";
        } else {
            echo "Toutes les conditions sont fausses<br>";
        }

        // Seulement l'une ou l'autre des conditions, si les deux sont vérifiées, c'est refusé ! 
        if ($x > $y xor $y < $z) {
            echo "Ok une seule et unique condition est bonne ! <br>";
        } else {
            echo "Toutes les conditions sont fausses ou toutes les conditions sont vraies<br>";
        }

        // if elseif else 
        $x = 8;
        $y = 5;
        $z = 2;

        if ($x == 8) { // Si x est égal à 8
            echo "Réponse A<br>";
        } elseif ($x != 10) { // Si x est différent de 10 
            echo "Réponse B<br>";
        } elseif ($y == $z) { // Si y est égal à z
            echo "Réponse C<br>";
        } else { // Sinon
            echo "Réponse D<br>";
        }

        // Attention, lors de tests de conditions dans un bloc à plusieurs if, elseif, on sortira du bloc dès la première condition rencontrée
        // C'est à dire que si les valeurs correspondent aux conditions de la réponse A et aussi de la réponse B, alors je sortirai de toute façon à la réponse A, sans aller tester la réponse B 

        // Comparaison stricte 
        $a = 1;
        $b = "1";

        // Comparaison des valeurs uniquement 
        if ($a == $b) {
            echo "Oui ces deux variables sont identiques EN VALEUR<br>";
        } else {
            echo "Non ces deux variables sont différentes EN VALEUR<br>";
        }

        if ($a === $b) {
            echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        } else {
            echo "Non ces deux variables sont différentes en valeur ET/OU en type<br>";
        }

        /* 
            Opérateurs de comparaison
            --------------------------------------
            =                               affectation (ce n'est pas un opérateur de comparaison, c'est une affectation)
            ==                              est égal à 
            !=                              est différent de 
            ===                             est strictement égal à (valeur et type)
            !==                             est strictement différent de (valeur et/ou type différent)
            >                               strictement supérieur à 
            >=                              supérieur ou égal 
            <                               strictement inférieur à 
            <=                              inférieur ou égal 
        */

        // Autres possibilités de syntaxe pour les if 

        if ($a === $b) {
            echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        } // Si on ne veut pas gérer le else, il est possible de l'omettre 

        if ($a === $b) echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        else echo "Non ces deux variables sont différentes en valeur ET/OU en type<br>";
        // On peut ne pas mettre les accolades, par contre l'instruction sera limitée à une seule ligne de code après la condition

        if ($a === $b) :
            echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        else :
            echo "Non ces deux variables sont différentes en valeur ET/OU en type<br>";
        endif;
        // Ici syntaxe où les accolades sont remplacées par des ":" et un "endif" en fin de bloc
        // On utilisera surtout cette syntaxe lorsque l'on ouvre PHP dans de gros blocs HTML pour améliorer la lisibilité et compréhension du code 
        // Il est plus clair de voir un endif; au milieu du html plutôt que de voir une simple accolade fermante 

        // Ecriture ternaire, pour nos if les plus courts ! 

        // action (condition) ? .......... if......... : .............else............
        echo ($a === $b) ? "Oui les deux var sont identiques<br>" : "Non, les deux var sont différentes<br>";
        // On utilisera le if ternaire lorsque l'action du if et du else est la même ! Souvent un echo ou une affectation dans une variable, dont la valeur sera différente en fonction de la condition du if ! 
        // Pas de elseif possible pour l'écriture ternaire 

        // Plusieurs outils de contrôle que l'on manipule régulièrement avec les if en PHP 
        // isset() & empty()
        // isset() permet de savoir si une information existe (savoir si une variable est bien présente)
        // empty() permet de savoir si une information est vide (on testera toujours empty sur une variable déjà existante et donc préalablement testée avec isset())

        // isset() 
        // - la variable existe on reçoit : true
        // - la variable n'est pas on reçoit : false 

        // empty() 
        // - la variable est vide on reçoit : true 
        // - la variable n'est pas vide on reçoit : false 

        $pseudo = "Bob";
        // Ici je m'assure de démarrer mon traitement UNIQUEMENT si la variable $pseudo existe bel et bien ! 
        if (isset($pseudo)) {
            echo "J'ai bien reçu le pseudo : $pseudo <br>";
        } else {
            echo "Attention la variable pseudo n'existe pas ! <br>";
        }

        $password = "coucou";
        if (empty($password)) {
            // Ici on utilisera empty dans un second niveau de vérification pour vérifier par exemple des saisies obligatoires d'un formulaire 
            echo "Attention, il est obligatoire de saisir le password ! <br>";
        } else {
            echo "Tout va bien<br>";
        }

        // La syntaxe ci dessous c'est un test isset() sur $pseudoForm, si elle n'existe pas, alors on affecte la valeur "Pas de pseudo", c'est une sorte de ternaire mélangé à un test isset()
        $pseudo = $pseudoForm ?? "Pas de pseudo";

        // Valeurs considérées comme vide : null, 0, 0.0, "", '', array vide, false 


        echo "<h2>Conditions switch</h2>";
        // Autre outil permettant de mettre en place des conditions 

        // Avec une condition switch on donne un ensemble de cas possible 
        // Le scénario d'utilisation du switch est que l'on teste différente valeur d'une seule et même variable
        // La syntaxe ne se prête pas du tout à tester des conditions complexes 

        $couleur = "jaune";
        switch ($couleur) {
            case "bleu":
                echo "Vous aimez le bleu<br>";
                break;
            case "rouge":
                echo "Vous aimez le rouge<br>";
                break;
            case "vert":
                echo "Vous aimez le vert<br>";
                break;
            default: // équivalent au else 
                echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";
                break;
        }

        // EXERCICE : refaire cette condition switch, mais, en if / elseif / else  

        $couleur = "jaune";


        if ($couleur == "bleu") echo "Vous aimez le bleu<br>";
        elseif ($couleur == "rouge") echo "Vous aimez le rouge<br>";
        elseif ($couleur == "vert") echo "Vous aimez le vert<br>";
        else echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert <br>";

        // Ici notre consigne se prête parfaitement à l'utilisation de la syntaxe sans accolades 

        echo "<h2>08 - Fonctions prédéfinies</h2>";

        // Ce sont des fonctions déjà présentes dans le langage, on se contente de les utiliser, pas besoin de redévelopper tous nos outils
        // Par exemple, gettype(), isset(), empty()
        // Liste des fonctions PHP : https://www.php.net/manual/fr/indexes.functions.php

        // Pour utiliser une fonction, nous devons connaitre le nombre d'argument ainsi que leurs types et leur ordre 
        // Et surtout quelle sera la valeur de retour de cette fonction 

        // Quelques exemples : 

        // Fonction date() 
        // Permet d'afficher une date au format de mon choix 

        echo "Nous sommes le : " . date("d/m/Y") . "<br>";
        echo "Copyright Pierra &copy; - " . date("Y") . "<br>";


        echo date("d/m/Y", strtotime("2020-01-15")) . "<br>";
        // Argument à fournir : une chaine de caractère représentant le format de date attendu
        // Deuxième argument facultatif : un timestamp pour préciser une date spécifique, attention, il est attendu en format timestamp (nombre de secondes écoulées depuis le 1er Janvier 1980) donc il faudra le transformer en timestamp si jamais il est en format date string 

        // Fonctions de traitement de chaine de caractères 

        // strlen() 
        // Fonction prédéfinie permettant de compter le nombre de caractères dans une chaine - ATTENTION, en fait c'est le nombre d'octets qui est compté !

        echo strlen("bônjoùr");
        // ATTENTION strlen() me retourne le nombre d'octets ! et non pas le nombre de caractères réel ! Cela peut me poser des soucis sur mes vérifications de taille de string, par exemple à l'inscription, pseudo pas trop court pas trop long, password assez long

        echo "<br>";
        // iconv_strlen() 
        // Fonction prédéfinie permettant de compter réeelement le nombre de caractères d'une chaine
        // Pour toutes vérifications de saisies d'un formulaire, on s'intéressera réellement au nombre de caractères d'une chaine plutôt qu'au "poids" en octets, on utilisera donc toujours iconv_strlen 
        echo iconv_strlen("bônjoùr");

        // deux fonctions de vérification var_dump et print_r 
        // Grâce à ces outils on peut en savoir plus sur la valeur d'un élément ou d'une action
        // Pour une variable, on a les infos de la valeur, du type, de la longueur
        // Pour des types avancés comme les array et les objets on aura des infos sur le contenu exact du array et des propriétés des objets 
        // Sur une action, on sera capable aussi de voir le résultat booléen (uniquement avec var_dump) true ou false sur un lancement de fonction par exemple
        var_dump(isset($coeur));
        print_r($couleur);

        // Il existe ensuite des fonctions de vérification de type, is_integer, is_array, is_string 

        // Des fonctions de formatage de texte comme ucfirst() met la première lettre d'un string en majuscule 


        echo "<h2>08 - Fonctions utilisateur</h2>";

        // Définies par le développeur, on développe nos propres fonctions 

        // Ici une fonction me permettant d'afficher 3 <hr> pour faire des séparations dans mon code 

        // déclaration 
        function separateur()
        {
            echo "<hr><hr><hr>";
        }

        // exécution 
        separateur(); // Ici à l'exécution de notre fonction, <hr><hr><hr>  s'exécute sur notre page 

        // Fonction avec des arguments/params 
        function dire_bonjour($qui)
        {
            return "Bonjour $qui, bienvenue sur notre site <hr>";
            // On utilisera toujours un return dans nos fonctions, ensuite à nous de décider si j'echo ce return ou si je m'en sers pour un traitement quelconque 
        }

        echo dire_bonjour("Pierre-Alexandre");
        $prenom = "Jimmy";
        echo dire_bonjour($prenom);


        // Fonction permettant de calculer le prix TTC 
        function applique_tva($prix)
        {
            return "Le montant TTC pour le prix $prix" . "€ est de : " . ($prix * 1.2) . "€<hr>";
        }

        echo applique_tva(100);

        // Exercice : Refaire la fonction applique TVA mais en permettant de choisir aussi le taux à appliquer, c'est à dire je veux pouvoir saisir le prix puis le taux, par exemple applique_tva(100,10) si je souhaite appliquer une taxe de 10% au prix 100€

        // Et dans un second temps, rendre cette saisie du taux facultative, si le taux n'est pas saisi alors on appliquera le taux par défaut de 20%


        // Ici le fait de donner une valeur à un param, le rends facultatif !
        // Si le taux n'est pas fourni à l'exécution de la fonction, alors c'est la valeur spécifiée ici qui sera prise en compte
        function applique_tva_taux($prix, $taux = 20)
        {
            return "Le montant TTC pour le prix $prix" . "€ est de : " . ($prix * (1 + $taux / 100)) . "€<hr>";
        }

        echo applique_tva_taux(100, 10);
        echo applique_tva_taux(1000);


        // Fonction meteo 
        function meteo($saison, $temperature)
        {
            $debut = "Nous sommes en $saison";
            $suite = " et il fait $temperature degré(s)<hr>";

            return $debut . $suite;
        }

        separateur();

        echo meteo("automne", 15);
        echo meteo("hiver", 0);
        echo meteo("printemps", 20);
        echo meteo("été", 30);

        // Exercice : Refaire cette fonction en gérant "en" ou "au" selon la saison et le "s" ou pas sur les degrés


        // Ici une des solutions les plus courtes avec un ternaire 
        function meteo2($saison, $temperature)
        {
            $s = ($temperature > -2  && $temperature < 2) ? "" : "s";
            $auen = ($saison == "printemps") ? "au" : "en";

            return "Nous sommes $auen $saison et il fait $temperature degré$s <hr>";
        }


        function meteo3($saison, $temperature)
        {

            if ($saison == "printemps") {
                $debut = "Nous sommes au $saison";
            } else {
                $debut = "Nous sommes en $saison";
            }

            if ($temperature == 1 || $temperature == -1 || $temperature == 0) {
                $suite = " et il fait $temperature degré<hr>";
            } else {
                $suite = " et il fait $temperature degrés<hr>";
            }


            return $debut . $suite;
        }

        function meteo4($saison, $temperature)
        {
            $s = (abs($temperature) <= 1) ? "" : "s";
            $auen = ($saison == "printemps") ? "au" : "en";

            return "Nous sommes $auen $saison et il fait $temperature degré$s <hr>";
        }


        separateur();

        echo meteo2("automne", 15);
        echo meteo2("hiver", 1);
        echo meteo2("printemps", 20);
        echo meteo2("été", 30);

        separateur();

        echo meteo4("automne", 15);
        echo meteo4("hiver", 1);
        echo meteo4("printemps", 20);
        echo meteo4("été", 30);

        // Environnement (scope)
        // Global : le script complet 
        // Local : à l'intérieur d'une fonction/méthode/classe

        separateur();

        // L'existence d'une variable dépend de l'environnement où on la déclare 

        $animal = "chat"; // Variable déclarée dans le scope global

        echo $animal . "<br>"; // chat

        function foret()
        {
            $animal = "chien"; // Variable déclarée dans le scope local
            return $animal; // On retourne ici non pas la variable mais la valeur contenue dans cette variable à savoir "chien"
        }

        echo $animal . "<br>"; // chat on appelle la variable globale
        foret(); // Ici rien ne se passe, le return n'est pas traitée 
        echo $animal . "<br>"; // chat car la variable globale n'a pas été modifiée 
        echo foret() . "<br>"; // chien  car on echo la valeur retournée par la fonction foret() (c'est à dire la valeur de $animal dans le scope local)
        echo $animal . "<br>"; // chat  toujours chat, car c'est la valeur de la var $animal locale qui sort de la fonction et non pas la variable elle même
        $animal = foret(); // Uniquement ici, j'aurai un changement de valeur de la var globale par le string retourné par la fonction foret()
        echo $animal . "<br>"; // chien

        $pays = "France"; // Variable déclarée dans l'espace global 

        function affiche_pays()
        {
            global $pays; // Grâce à ce mot clé global, il est possible de récupérer une variable de l'espace global pour la ramener dans la fonction
            $pays = "Japon";
        }

        echo $pays; // France 

        affiche_pays(); // Exécution de la fonction, elle récupère la variable global $pays et change sa valeur par Japon

        echo $pays; // Japon

        separateur();

        // Il est possible de typer les arguments d'une fonction ainsi que le return 
        function identite(string $nom, int $age = 30, int $cp = 75): string
        {
            return "$nom a $age ans et habite dans le $cp<br>";
        }

        echo identite("Pierra", 37, 64);
        echo identite("Pierra", cp: 64);

        echo "<h2>09 - Structure itérative : Boucles </h2>";

        // Boucle for = boucle avec compteur numérique 
        // Besoin de 3 informations 
        // - Une valeur de départ (compteur)
        // - Condition d'entrée 
        // - Incrémentation ou décrémentation 

        // for (valeurDeDepart; condition; incrementation) {}
        for ($i = 0; $i < 10; $i++) {
            echo "$i ";
        }

        separateur();

        // Boucle while = boucle en fonction d'une condition (pas forcément numérique) 
        // while() {}
        $i = 0; // Initialisation d'un compteur à la main ici
        while ($i < 10) {
            echo "$i ";
            $i++; // Incrémentation à la main 
        }


        // Il est possible de sortir d'une boucle avec le mot clé break
        $i = 0; // Initialisation d'un compteur à la main ici
        while ($i < 100) {
            echo "$i ";
            if ($i == 20) {
                break; // On sort de la boucle
            }
            $i++; // Incrémentation à la main 
        }

        separateur();

        $i = 0;
        do {
            echo $i;
        } while ($i > 0);
        separateur();

        // Exercice ...
        for ($i = 0; $i < 10; $i++) {
            echo "$i - ";
        }

        separateur();
        // Résultat actuel : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 -
        // Résultat attendu : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9
        for ($i = 0; $i < 10; $i++) {
            if ($i == 9) {
                echo "$i";
            } else {
                echo "$i - ";
            }
        }

        separateur();

        // Exercice 1
        // Afficher des nombres allant de 1 à 100.
        for ($i = 1; $i < 101; $i++) {
            if ($i == 100) {
                echo "$i";
            } else {
                echo "$i - ";
            }
        }

        separateur();
        // Exercice 2
        // Afficher des nombres allant de 1 à 100 avec le chiffre 50 en rouge.
        for ($i = 0; $i < 101; $i++) {
            if ($i == 50) {
                echo "<span style='color: red; font-size: 20px; font-style: bold;'>" . "$i </span>";
            } else {
                echo "$i ";
            }
        }

        separateur();
        // Exercice 3
        // Afficher des nombres allant de 2000 à 1930.
        for ($i = 2000; $i >= 1930; $i--) {
            echo "$i ";
        }

        // Exercice 4
        // Afficher le titre suivant 10 fois : <h1>Titre à afficher 10 fois</h1>
        for ($i = 0; $i < 10; $i++) {
            echo "<h1>Titre à afficher 10 fois</h1>";
        }

        separateur();
        // Exercice 5
        // Afficher le titre suivant "<h1>Je m'affiche pour la Nème fois</h1>".
        // Remplacer le N avec la valeur de $i (tour de boucle).
        for ($i = 1; $i < 11; $i++) {
            echo "<h1>Je m'affiche pour la $i" . ($i == 1 ? "ère" : "ème") . " fois</h1>";
        }

        echo "<h2>10 - Tableaux de données ARRAY</h2>";
        // Array est un nouveau type de données 
        // Une variable de type de array, nous permet de conserver un ensemble de valeur 
        // Un array c'est toujours composé de deux colonnes 
        // Une colonne représente l'index/clé/id 
        // Une colonne qui représente la valeur associée à cet index 

        // Pour piocher dans un tableau, on appelera l'index 

        // Déclaration d'un tableau array 
        $tabJours = array("lundi", "mardi", "mercredi", "jeudi", "vendredi");
        // $tabJours = ["lundi", "mardi", "mercredi", "jeudi", "vendredi"];

        // echo $tabJours; // Je ne peux pas faire un echo d'un array entier 

        // Si je veux avoir des informations sur un array, (en phase de developpement)
        // Je peux utiliser var_dump ou print_r 

        // Le var_dump et le print_r me permettent de visualiser le contenu de mon array à l'instant T
        // On remarquera aussi les id présents pour chacune de nos valeurs, si je ne spécifie rien, alors automatiquement il les indexera numériquement 
        var_dump($tabJours);
        echo "<pre>";
        print_r($tabJours);
        echo "</pre>";
        //         Array
        // (
        //     [0] => lundi
        //     [1] => mardi
        //     [2] => mercredi
        //     [3] => jeudi
        //     [4] => vendredi
        // )

        // Je ne peux pas réellement afficher un array entier avec un echo, par contre, je peux appeler un indice de ce tableau, pour cela, j'appelle l'indice en question entre crochets
        // Les crochets représenteront toujours la syntaxe associée aux tableaux array 
        echo $tabJours[2];

        // Quelques fonctions sur les array 
        // is_array : permet de savoir si la variable est un array ou pas 
        // array_push() pour ajouter des éléments dans un tableau 
        array_push($tabJours, "samedi", "dimanche");
        var_dump($tabJours);

        // Autres façons de déclarer un array 
        $tabMois = ["janvier", "fevrier", "mars", "avril"];

        var_dump($tabMois);

        $tabMois[] = "mai";
        $tabMois[] = "juin";
        var_dump($tabMois);

        $tabFruits[] = "pommes"; // La première ligne crée le tableau
        var_dump($tabFruits);
        $tabFruits[] = "poires";
        $tabFruits[] = "bananes";
        $tabFruits[] = "mangues";
        $tabFruits[] = "cocos";

        // Pour connaitre la taille d'un tableau : 
        // count() ou sizeof() 
        echo "Taille du tableau des fruits : " . count($tabFruits) . "<br>";
        echo "Taille du tableau des fruits : " . sizeof($tabFruits) . "<br>";

        // Affichage du tableau des fruits dans une liste ul li 

        separateur();

        // Ici je profite d'avoir des indices numériques pour faire une boucle à compteur numérique pour piocher un à un les valeurs de mon array
        echo "<ul>";
        for ($i = 0; $i < count($tabFruits); $i++) {
            echo "<li>" . $tabFruits[$i] . "</li>";
        }
        echo "</ul>";

        separateur();

        // Il est possible en PHP d'avoir des indices d'array en string 
        $membre = array("pseudo" => "Admin", "email" => "admin@gmail.com", "age" => 30);

        var_dump($membre);

        // Pour rajouter des infos dans un array, en nommant l'index 
        $membre["ville"] = "Paris";
        $membre["cp"] = 75000;
        $membre["adresse"] = "1 rue chose";

        // Pour piocher dans un array avec les id nommé, pas de soucis, juste il faudra mettre l'indice entre "" ou '' 
        echo $membre["pseudo"];
        separateur();
        // Sur ce dernier tableau, les index en toutes lettres ne me permettent pas de faire une boucle for numérique pour parcourir le tableau...

        // Pas grave ! On a un nouvel outil de boucle foreach() qui passe tout simplement sur chacun des éléments d'un tableau array sans que j'ai besoin d'en connaître la taille 

        // Deux syntaxes pour le foreach 

        // Première syntaxe, récupère uniquement les valeurs de chaque indice 
        foreach ($membre as $valeur) { // Une seule variable après le mot clé obligatoire AS, cette variable reçoit la valeur en corus à chaque tour de boucle 
            echo "- $valeur <br>";
        }

        // Deuxième syntaxe, récupère les valeurs MAIS AUSSI le nom des indices 
        // L'intérêt de récupérer les indices n'est pas forcément de les afficher, mais plutôt pour appliquer un traitement différent en fonction de l'indice
        // Par exemple ci dessous je décide d'ignorer l'adresse et de ne pas l'afficher 
        // Ou encore une image, je n'en fais pas un simple echo, j'ai besoin de l'ajouter dans une balise <img>
        foreach ($membre as $key => $value) {
            // if ($key == "adresse") {
            //     echo "- $key : données privées";
            // } else {
            //      echo "- $key : $value <br>";
            // }

            if ($key != "adresse") {
                echo "- $key : $value <br>";
            }
        }

        // Il est possible d'avoir un array dans un autre array, pas de limite à ça 
        // C'est ce qu'on appelle un array multidimensionnel 

        $data[] = array("pseudo" => "Pierra", "poste" => "formateur", "age" => 37);
        $data[] = array("pseudo" => "Polo", "poste" => "dev", "age" => 27);
        $data[] = array("pseudo" => "Boby", "poste" => "resto", "age" => 18);

        var_dump($data);

        //         array (size=3)
        //   0 => 
        //     array (size=3)
        //       'pseudo' => string 'Pierra' (length=6)
        //       'poste' => string 'formateur' (length=9)
        //       'age' => int 37
        //   1 => 
        //     array (size=3)
        //       'pseudo' => string 'Polo' (length=4)
        //       'poste' => string 'dev' (length=3)
        //       'age' => int 27
        //   2 => 
        //     array (size=3)
        //       'pseudo' => string 'Boby' (length=4)
        //       'poste' => string 'resto' (length=5)
        //       'age' => int 18

        // Pour piocher dans un array à plusieurs niveau, on procède par succession de crochets, on rentre dans les niveaux un par un  
        // Si je veux afficher Boby, j'appelle d'abord l'indice 2, puis ensuite l'indice pseudo 
        echo $data[2]["pseudo"];

        echo "<h2>11 - Inclusion de fichiers</h2>";
        // Création d'un fichier _exemple.php 
        // On ajoute du contenu dans ce fichier 

        // include & require : ce sont deux outils qui nous permettent de ramener le contenu d'un autre fichier à l'intérieur de celui ci
        // L'ajout du fichier va se faire à l'endroit de l'appel d'une de ces deux fonctions  

        // Pour leurs version _once, le système vérifie si le fichier n'est pas déjà présent sur la page, auquel cas il ne sera pas ajouté une seconde fois 

        // Différences entre include et require : La gestion des erreurs 
            // une erreur sur include me génère un warning, le code continue de s'exécuter
            // une erreur sur require me génère une fatal error, le code s'arrête 

        // Généralement sauf cas spécifiques on utilisera toujours les versions _once et la plupart du temps require, sauf pour les _partials peu important (zone pub par exemple)

        echo "<b>Premier appel avec include : </b><hr>";
        include "_exemple.php"; // l'intégralité du contenu du fichier exemple est répercuté ici 
        separateur();

        echo "<b>Deuxième appel avec include_once : </b><hr>";
        include_once "_exemple.php"; // Le fichier n'est pas réinclus car déjà présent sur la page 
        separateur();

        echo "<b>Troisième appel avec require : </b><hr>";
        require "_exemple.php"; // Le fichier est réinclus car ce n'est pas une version _once
        separateur();

        echo "<b>Quatrième appel avec require_once : </b><hr>";
        require_once "_exemple.php"; // Le fichier n'est pas réinclus car déjà présent sur la page 
        separateur();




        ?>


    </div>

</body>

</html>