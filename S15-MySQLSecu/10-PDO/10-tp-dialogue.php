<?php 




/* 

EXERCICE :
----------------------

- Creation d'un espace de dialogue / tchat 

- 01 - Création de la BDD : dialogue 
    - Table : commentaire 
    - Champs de la table commentaire : 
        - id_commentaire        INT PK AI 
        - pseudo                VARCHAR 255
        - message               TEXT
        - date_enregistrement   DATETIME

- 02 - Créer une connexion à cette base avec PDO 
- 03 - Création d'un formulaire html permettant de poster un message 
    - Champs du form : 
            - pseudo 
            - message
            - bouton d'envoi
- 04 - Récupération des saisies du form et application de contrôles
- 05 - Déclenchement d'une requête d'enregistrement pour enregistrer la saisie dans la BDD
- 06 - Requête de récupération des messages afin de les afficher dans cette page 
- 07 - Affichage des messages avec un peu de mise en forme 
- 08 - Affichage en haut des messages du nombre de messages présents dans la bdd
- 09 - Affichage de la date au format jour/mois/année 
- 10 - Amélioration du CSS 

*/