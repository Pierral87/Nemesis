----------------------------------------------------------------------------
----------------------------------------------------------------------------
--------------- TRIGGERS / DECLENCHEURS ------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------

-- Un Trigger, c'est un peu comme une fonction ou une procédure mais je ne peux pas l'exécuter directement...
-- Par contre je peux préciser l'action qui va déclencher ces instructions 

-- On déclenche généralement les triggers après des requêtes spécifiques, ce qui nous permet de déclencher une action 

--# Les TRIGGERS sont déclenchés afin d'automatiser certaines taches à la suite de certaines actions.

DELIMITER $ --# Changement du DELIMITER pour éviter un conflit avec la console.
SHOW TRIGGERS \G$ --# montre les TRIGGERS
DROP TRIGGER exemple1$ --# supprime un TRIGGER
SHOW TRIGGERS LIKE 'emp%'\G $ --# Permet de voir un TRIGGER en particulier.

USE entreprise; 

-- Ici cette table me sert à conserver le nombre d'employés actuellement dans l'entreprise ainsi que la dernière date d'embauche 
CREATE TABLE IF NOT EXISTS employes_informations (
  id_employes_informations int(3) NOT NULL AUTO_INCREMENT,
  nombre int(3) NOT NULL,
  derniere_date_embauche date NOT NULL,
  PRIMARY KEY (id_employes_informations)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

DELIMITER $
-- Creation d'un trigger permettant de maj la table employes_information
CREATE TRIGGER maj_info_employes AFTER INSERT ON employes  -- Je spécifie ici que le trigger doit s'exécuter après une insertion sur employes 
FOR EACH ROW 
BEGIN 
    UPDATE employes_informations SET nombre = nombre + 1, derniere_date_embauche = NEW.date_embauche;
END $

--# Exercice 1/ création de la table de "employes_sauvegarde" : Exactement la méme table que la table employes avec les mémes champs mais vide !

CREATE TABLE IF NOT EXISTS employes_sauvegarde (
  id_employes int(4) NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--# exercice : Faite en sorte dinscrire des données dans "employes_sauvegarde" pour toute nouvelle insertion dans la table employes (en plus de la maj sur la table employes_informations)

--# Exercice 2/ Création d'une table "employes_supprime" : Exactement la méme table que la table employes avec les mémes champs mais vide !
--# exercice : Faite en sorte d'enregistrer tous les employes supprimés. Cela nous servira de corbeille 