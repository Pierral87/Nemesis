------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
-------------- SYNTAXE MySQL -------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------

-- Ceci est un commentaire MySQL 
/*

    Commentaire 
    entre les
    indicateurs

*/

-- Attention on évite les commentaires en MySQL (sauf dans nos fonctions/procédures) car cela crée des erreurs dans les export/import
-- On préfèrera mettre des commentaires dans notre langage back appelant le MySQL

-- Lien utile, la documentation SQL : https://sql.sh/

-- Pour se connecter à la console MySQL :

            -- WAMP : Ouvrir le menu MySQL et Console MySQL
            -- XAMPP : Ouvrir le shell (terminal serveur) et taper mysql -u root -p
            -- MAMP : Ouvrir le terminal MacOS et taper le chemin par défaut /Applications/MAMP/Library/bin/mysql -u root -p


-- Pour créer une BASE 
CREATE DATABASE mabdd;
CREATE DATABASE entreprise;

SHOW DATABASES; -- Pour voir la liste des BDD d'un serveur 
SHOW TABLES;  -- Pour voir la liste des tables d'une BDD
SHOW WARNINGS; -- Les warnings de la dernière requête exécutée

USE mabdd; -- Pour me positionner sur une BDD afin de pouvoir travailler dessus via la console
SELECT DATABASE(); -- Pour vérifier quelle est la base sur laquelle on se trouve
USE entreprise;

DROP DATABASE mabdd; -- Pour supprimer une BDD
DROP TABLE nom_de_la_table; -- Pour supprimer une table 

TRUNCATE nom_de_table; -- Pour vider (attention c'est une requête structure)
DELETE FROM nom_de_table; -- Pour vider aussi (requête classique de type action)

DESC nom_de_table; -- Pour la DESCription d'une table 

CREATE DATABASE entreprise;
USE entreprise;

-- Création d'une table employes dans la base entreprise
CREATE TABLE employes (
  id_employes int NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- Insertions dans la table employes 
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES
(350, 'Jean-pierre', 'Laborde', 'm', 'direction', '2010-12-09', 5000),
(388, 'Clement', 'Gallet', 'm', 'commercial', '2010-12-15', 2300),
(415, 'Thomas', 'Winter', 'm', 'commercial', '2011-05-03', 3550),
(417, 'Chloe', 'Dubar', 'f', 'production', '2011-09-05', 1900),
(491, 'Elodie', 'Fellier', 'f', 'secretariat', '2011-11-22', 1600),
(509, 'Fabrice', 'Grand', 'm', 'comptabilite', '2011-12-30', 2900),
(547, 'Melanie', 'Collier', 'f', 'commercial', '2012-01-08', 3100),
(592, 'Laura', 'Blanchet', 'f', 'direction', '2012-05-09', 4500),
(627, 'Guillaume', 'Miller', 'm', 'commercial', '2012-07-02', 1900),
(655, 'Celine', 'Perrin', 'f', 'commercial', '2012-09-10', 2700),
(699, 'Julien', 'Cottet', 'm', 'secretariat', '2013-01-05', 1390),
(701, 'Mathieu', 'Vignal', 'm', 'informatique', '2013-04-03', 2500),
(739, 'Thierry', 'Desprez', 'm', 'secretariat', '2013-07-17', 1500),
(780, 'Amandine', 'Thoyer', 'f', 'communication', '2014-01-23', 2100),
(802, 'Damien', 'Durand', 'm', 'informatique', '2014-07-05', 2250),
(854, 'Daniel', 'Chevel', 'm', 'informatique', '2015-09-28', 3100),
(876, 'Nathalie', 'Martin', 'f', 'juridique', '2016-01-12', 3550),
(900, 'Benoit', 'Lagarde', 'm', 'production', '2016-06-03', 2550),
(933, 'Emilie', 'Sennard', 'f', 'commercial', '2017-01-11', 1800),
(990, 'Stephanie', 'Lafaye', 'f', 'assistant', '2017-03-01', 1775);