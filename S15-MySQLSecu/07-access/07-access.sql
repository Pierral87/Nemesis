------------------------------ Gestion des accès utilisateurs en MySQL ------------------------------------

/*
Nos BDD nous permettent de stocker des données 
    Ces BDDs vont fonctionner en liaison avec notre site web (pages html avec du PHP ou autre)
Donc finalement, n'importe quel utilisateur de notre app peut se "connecter" à notre BDD 

Il est donc absolument nécessaire de veiller à ce que les utilisateurs ne possèdent pas plus de droits que nécessaire */
-- En dehors des accès que l'on peut ouvrir/fermer dans notre front/back, on peut aussi appliquer des notions de sécurité dans notre BDD 
-- Notamment en gérant des comptes utilisateurs avec des accès bien spécifiques pour leurs roles 
-- Depuis le début on utilise root, c'est le superadmin de notre bdd avec tous les droits
    -- SURTOUT NE JAMAIS UTILISER ROOT SUR UN VRAI PROJET !!!!
        -- On fera toujours en sorte de créer des comptes utilisateurs avec uniquement les droits dont ils ont besoin 

-- Pour créer des comptes user, on peut le faire très simplement dans PHP My Admin, on créer un compte avec un password et ensuite on donne des droits sur le host, et/ou sur une ou plusieurs bdd au global et/ou sur une ou plusieurs et/ou sur tous les champs ou seulement quelques champs des tables, on peut tout customiser ! 

-- Creation d'un user en ligne de commande 
CREATE USER 'boby'@'localhost' IDENTIFIED BY 'azerty';

-- Suppression d'un utilisateur 
DROP USER 'boby'@'localhost';

-- On donne les droits avec root à nos utilisateurs, pour ça on utilise l'instruction GRANT 
-- Par exemple ci dessous on donne les droits select, insert, delete, et update uniquement sur service à boby ! Sur la base entreprise la table employes
GRANT SELECT, INSERT, DELETE, UPDATE(service) 
    ON entreprise.employes 
    TO 'boby'@'localhost';

-- Pour valider un GRANT il faut lancer la commande : 
    FLUSH PRIVILEGES;

-- Limitation de ressources : 
    -- MAX_QUERIES_PER_HOUR : Le nombre de erquête qu'il peut exécuter par heure 
    -- MAX_UPDATES_PER_HOUR : Le nombre de modif qu'il peut exécuter par heure
    -- MAX_CONNECTIONS_PER_HOUR : Le nombre de fois qu'il peut se connecter à notre serveur 
-- Il est important de mettre ça en place pour éviter des attaques de type ddos/force brute afin d'éviter que le serveur n'encaisse des millions de requêtes en quelques secondes 
-- On veillera à mettre une limite suffisamment élevé pour qu'un utilisateur classique ne soit pas impacté lors de sa navigation 

-- EXERCICE : 

USE entreprise; 

-- Créer les comptes utilisateur suivants : 
        -- secretaire : avec le password de votre choix, on lui attribue le privilège de lecture sur les champs suivants id_employes, nom, prenom, sexe, service sur la table employes 
        -- directeur : avec le password de votre choix, on lui attribue les privilèges suivants : selection, modification, insertion, suppression sur la bdd entreprise en plus des droits d'attribution de droits à d'autres utilisateurs 
        -- informaticien : mot de passe au choix, donnez lui tous les droits mais une limitation de ressources à 10 requêtes maximum par heure et un nombre de connexion de 6 maximum par heure 

    -- Déconnectez vous du compte root, et connectez vous en tant que secrétaire et répondre aux requêtes suivantes : 
            -- 1 -- Afficher la profession de l'employé 417
            -- 2 -- Afficher le nombre de commerciaux 
            -- 3 -- Afficher le nombre de services différents 
            -- 4 -- Augmenter le salaire de chaque employés de 100 euros 

    -- Déconnectez vous du compte secrétaire et connectez vous en tant que directeur et répondre aux requêtes suivantes : 
            -- 1 -- Afficher la date d'embauche de Amandine 
            -- 2 -- Afficher le salaire moyen par service 
            -- 3 -- Afficher les informations de l'employé du service commercial gagnant le salaire le plus élevé 
        
    -- Déconnectez vous de directeur, connectez vous comme informaticien
            -- 1 -- Lancez plusieurs requêtes pour tester le maximum de requêtes autorisées
            -- 2 -- Reconnectez vous plusieurs fois pour tester le nombre de connexion autorisées 