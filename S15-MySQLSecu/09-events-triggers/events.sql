--------------------------------------------------------------------------
--------------------------------------------------------------------------
------------- LES EVENEMENTS ---------------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------

--# Les évènements permettent de programmer des actions dépendantes d'autres, par exemple :
--# 	- Programmer des requêtes de suppression pour délester de vieilles discussions pour votre forum.
--# 	- Calcul annuel dintérêt.
--# 	- Programmer des requêtes de sauvegarde automatiques chaque nuit.
--# 	- Différer lexécution dun traitement gourmand en ressources aux heures creuses de la prochaine nuit.
--# 	- Analyser et optimiser lensemble des tables mises à jour dans la journée

-- On base souvent les évènements sur des durées de temps,  par exemple, une insertion chaque minute, une copie chaque jour 

-- Première chose, vérifier si la variable globale event_scheduler est sur ON ou 1 
SHOW GLOBAL VARIABLES LIKE 'event_scheduler'; --#  permet de voir si les évènements sont activés ou désactivés.

SET GLOBAL event_scheduler = 1 ; --#  on affecte 1 dans une variable et cela permet d'activer les évènements sous Mysql.

SHOW EVENTS \G ;

-- Creation d'un évènement
-- On va insérer une ligne chaque minute dans les employés 
CREATE EVENT enregistrement_employes 
ON SCHEDULE EVERY 1 MINUTE 
DO INSERT INTO employes (prenom) VALUES ("Bob");
-- EVERY spécifie que l'évènement est réurrent, c'est à dire il va survenir CHAQUE MINUTE !
---------------------------------
-- Il existe aussi des évènements de type "one time" qui s'exécute qu'une seule fois 
CREATE EVENT insert_one_jaky
ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 2 MINUTE 
DO INSERT INTO employes (prenom) VALUES ("Jaky");

-- Création d'un évent qui ajoute un employé unique à une date et heure précise
CREATE EVENT insert_one_minute 
ON SCHEDULE AT "2025-10-29 17:05:00" -- Ici on spécifie un évènement à exactement une date
DO INSERT INTO employes (prenom) VALUES ("Brice");

-- Avec une date de fin 
CREATE EVENT insert_end
ON SCHEDULE EVERY 5 SECOND 
ENDS CURRENT_TIMESTAMP + INTERVAL 1 MINUTE  -- Ici on définie une date de fin de notre évènement 
DO INSERT INTO employes (prenom) VALUES ("Willy");

-- Pour faire un back up de table à l'intérieur de ma base 
CREATE TABLE journal (
  id_journal int(10) NOT NULL AUTO_INCREMENT,
  titre varchar(20) NOT NULL,
  texte text NOT NULL,
  PRIMARY KEY (id_journal)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO journal(titre, texte) VALUES ("Sortie de la nouvelle voiture modèle XXXX", "Superbe voiture electrique, accessible avec le leasing social du gouvernement");

INSERT INTO journal(titre, texte) VALUES ("Catastrophe naturelle", "Innondation dans telle region, plein de sinistres, encore des coupures d'electricité");


CREATE TABLE journal_copie (
  id_journal int(10) NOT NULL AUTO_INCREMENT,
  titre varchar(20) NOT NULL,
  texte text NOT NULL,
  PRIMARY KEY (id_journal)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DELIMITER $
CREATE EVENT journal_backup 
    ON SCHEDULE EVERY 1 MINUTE 
    DO 
        BEGIN 
            DELETE FROM journal_copie;
            INSERT INTO journal_copie SELECT * FROM journal;
        END 
    $
    

INSERT INTO journal(titre, texte) VALUES ("Nouvelle Miss France", "La miss France 2026 sera Miss Aquitaine");


-- Exercice 1 
        -- Créer un event qui inscrit dans une nouvelle table "emprunts_en_retard" les abonnés qui ont des emprunts dont la date_rendu est NULL et dont la date_sortie dépasse 30 jours

-- Exercice 2 
        -- Archivage des emprunts terminés : Créer une table historique_emprunts pour stocker les emprunts dont la date_rendu est renseignée 
            -- Après avoir fait cet event, refaite le en supprimant l'emprunt terminé de la table emprunt classique, on considèrera que notre table emprunt actuelle est une table d'emprunt "en cours" 

-- Exercice 3 : Comptage des emprunts mensuels
--     Créez une table stats_emprunts pour stocker les statistiques mensuelles (mois, année, nombre d’emprunts).
--     Créez un événement qui s’exécute chaque début de mois pour calculer le nombre d’emprunts effectués le mois précédent. 

-- Exercice 4 : Notification d’emprunts par auteur
--     Créez un événement qui exécute tous les jours pour insérer dans une table statistiques_auteurs les statistiques des emprunts par auteur pour les livres empruntés la veille.