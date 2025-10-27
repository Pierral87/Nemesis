<?php 



/* 

    Le système de session en PHP est un mécanisme qui permet de maintenir les informations entre le serveur et le client tout au long de sa navigation, peu importe qu'il change de page ou pas.
    En PHP, à nouveau, un superglobale est associée à ce système de session, $_SESSION, ENCORE UNE FOIS, c'est un array ! 
    Attention $_SESSION est la seule globale qui n'est pas disponible sur la page si on ne lance pas au préalable l'instruction session_start()
    Par défaut c'est un array vide dans lequel je peux stocker toutes les informations que je souhaite 
    Ces informations pourront m'aider à réinterpréter certains éléments sur mon site web, par exemple conserver "l'identification" utilisateur, donc son pseudo, email, prenom, nom, à but d'auto complétion pour un form de commande produit par exemple
    Egalement, tous les contrôles d'accès seront basés sur la session ! On stockera dans la session le rôle de l'utilisateur (admin ou autre), et on conditionnera sur la valeur de ce champs là, l'affichage de certains menus, de certaines pages etc  

    Une session est utilisée pour : 
        - Stocker des informations utilisateurs sur plusieurs pages 
        - Gérer les états utilisateurs (connecté ou pas)
        - Gérer les rôles utilisateurs (admin ou autre etc)

    Fonctionnement des sessions : 
        - Démarrage d'une session : avec session_start(), cela crée un cookie côté navigateur ainsi qu'un fichier de session dans le dossier tmp (par défaut) de notre serveur, les deux sont rattachés par un id 

        - Stockage de donénes dans $_SESSION : une fois la session démarré, alors j'ai accès à ce array $_SESSION, j'y mets ce qu'on veut, c'est un array associatif (avec les indices en toutes lettres, comme je le défini moi même), On peut ajouter, modifier, supprimer des info (ATTENTION, pas de stockage d'information trop sensible, car les informations restent visible si on ouvre le fichier de session côté serveur (bloc note ou autre))

        - Persistance entre les pages : Tant que la session est active (session_start sur toutes les pages et jusqu'à sa destruction par une "deconnexion"), ces informations restent accessible partout sur notre site 

    // Les principales fonctions de gestion de session 

    // session_start() : Démarre une nouvelle session ou reprend une session existante, cela doit être fait avant l'initialisation de page, en début de chaque script 
    */
    session_start();
        var_dump($_SESSION);

    // $_SESSION : c'est la superglobale que l'on manipule

    $_SESSION["message"] = "Salut";
    unset($_SESSION["username"]);

    // session_destroy() : Détruit toutes les données de la session, les fichiers de session eux même aussi. 
    session_destroy();

    // session_unset() : Supprime toutes les variables de session sans détruire la session elle même
    session_unset();

    // session_regeneratid_id() : Change l'ID de session, pour éviter les attaques de fixation de session, il est bon de "reset" l'id de temps en temps, on évite de le faire trop souvent, donc uniquement sur des opérations qui interviennent de temps à autre sur notre site (inscription, connexion, commande)
    session_regenerate_id(true);


    // Etendre la durée de vie des sessions : 
        // On le fait généralement dans le php.ini de notre serveur
        // Ceci dit, pour des cas spécifiques on peut le mettre dans notre page 
        ini_set("session.cookie_lifetime", 30 * 24 * 60 *60); // Augmente la durée de vie du cookie session
        ini_set("session.gc_maxlifetime", 30 * 24 * 60 *60); // Augmente la durée de vie du fichier session serveur 

    // PHP possède un système de nettoyage automatique "GC"  Garbage Collection 
        // A chaque opération sur les sessions, le GC a un % de chance de se lancer et supprimera tous les fichiers de session considérés comme périmés