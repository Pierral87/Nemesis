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

--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
------------ REQUETES DE SELECTION (On questionne la BDD) ----------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------

-- Affichage complet des données d'une table
SELECT * FROM employes;

-- Affichage que de quelques champs de la table
SELECT nom, prenom FROM employes;

-- Affichez les services : 
SELECT service FROM employes;
-- La requête ci dessus me renvoie 20 services, en fait, le service de chaque ligne d'enregistrement

-- Pour éviter les doublons et avoir "la liste" des services
SELECT DISTINCT service FROM employes;
+---------------+
| service       |
+---------------+
| direction     |
| commercial    |
| production    |
| secretariat   |
| comptabilite  |
| informatique  |
| communication |
| juridique     |
| assistant     |
+---------------+

-- CONDITION WHERE
-- Affichage de l'employé id 350
SELECT * FROM employes WHERE id_employes = 350;
+-------------+-------------+---------+------+-----------+---------------+---------+
| id_employes | prenom      | nom     | sexe | service   | date_embauche | salaire |
+-------------+-------------+---------+------+-----------+---------------+---------+
|         350 | Jean-pierre | Laborde | m    | direction | 2010-12-09    |    5000 |
+-------------+-------------+---------+------+-----------+---------------+---------+

-- Affichage des employés du service informatique
SELECT * FROM employes WHERE service = "informatique";
+-------------+---------+--------+------+--------------+---------------+---------+
| id_employes | prenom  | nom    | sexe | service      | date_embauche | salaire |
+-------------+---------+--------+------+--------------+---------------+---------+
|         701 | Mathieu | Vignal | m    | informatique | 2013-04-03    |    2500 |
|         802 | Damien  | Durand | m    | informatique | 2014-07-05    |    2250 |
|         854 | Daniel  | Chevel | m    | informatique | 2015-09-28    |    3100 |
+-------------+---------+--------+------+--------------+---------------+---------+

-- BETWEEN 
-- Affichage des employés ayant été embauchés entre 2015 et aujourd'hui
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND "2025-10-27";
+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         854 | Daniel    | Chevel  | m    | informatique | 2015-09-28    |    3100 |
|         876 | Nathalie  | Martin  | f    | juridique    | 2016-01-12    |    3550 |
|         900 | Benoit    | Lagarde | m    | production   | 2016-06-03    |    2550 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
|         990 | Stephanie | Lafaye  | f    | assistant    | 2017-03-01    |    1775 |
+-------------+-----------+---------+------+--------------+---------------+---------+
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND NOW();
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND CURDATE();

-- LIKE la valeur approchante
-- LIKE nous permet de rechercher une information qui ne serait pas saisie en entier, une information pas stricte
-- Les prénoms qui commencent par "s"
SELECT prenom FROM employes WHERE prenom LIKE "s%";
+-----------+
| prenom    |
+-----------+
| Stephanie |
+-----------+

-- Affichage des prénoms terminant par les lettres "ie"
SELECT prenom FROM employes WHERE prenom LIKE "%ie";
+-----------+
| prenom    |
+-----------+
| Elodie    |
| Melanie   |
| Nathalie  |
| Emilie    |
| Stephanie |
+-----------+

SELECT prenom FROM employes WHERE prenom LIKE "%ie%";
+-------------+
| prenom      |
+-------------+
| Jean-pierre |
| Elodie      |
| Melanie     |
| Julien      |
| Mathieu     |
| Thierry     |
| Damien      |
| Daniel      |
| Nathalie    |
| Emilie      |
| Stephanie   |
+-------------+

-- EXCLUSION 
-- Tous les employés sauf ceux d'un service particulier, par exemple sauf le service commercial 
SELECT * FROM employes WHERE service != "commercial"; -- != différent de 
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+

-- Les opérateurs de comparaison : 

    -- =  est égal à 
    -- != est différent de 
    -- > strictement supérieur 
    -- >= supérieur ou égal
    -- < strictement inférieur
    -- <= inférieur ou égal 

-- Les employés ayant un salaire supérieur à 3000 
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;
+----------+-------------+--------------+---------+
| nom      | prenom      | service      | salaire |
+----------+-------------+--------------+---------+
| Laborde  | Jean-pierre | direction    |    5000 |
| Winter   | Thomas      | commercial   |    3550 |
| Collier  | Melanie     | commercial   |    3100 |
| Blanchet | Laura       | direction    |    4500 |
| Chevel   | Daniel      | informatique |    3100 |
| Martin   | Nathalie    | juridique    |    3550 |
+----------+-------------+--------------+---------+

-- ORDER BY pour ordonner les résultats
-- Affichage des employés dans l'ordre alphabétique 
SELECT * FROM employes ORDER BY nom;
SELECT * FROM employes ORDER BY nom ASC; -- ASC pour Ascendant, c'est l'ordre par défaut si non précisé, lorsqu'on parle de champs en string/varchar c'est l'ordre alphabétique

-- Ordre inversé : DESC pour descendant
SELECT * FROM employes ORDER BY nom DESC;

-- Il est possible également d'ordonner par plusieurs champs. Il suffit de les citer dans l'ordre de priorité après le ORDER BY 

SELECT service, nom, prenom FROM employes ORDER BY service;
SELECT service, nom, prenom FROM employes ORDER BY service, nom;

-- LIMIT pour limiter le nombre de résultat
-- Affichage des employés 3 par 3 
SELECT * FROM employes LIMIT 0, 3; -- LIMIT position/offset, nombre_lignes
+-------------+-------------+---------+------+------------+---------------+---------+
| id_employes | prenom      | nom     | sexe | service    | date_embauche | salaire |
+-------------+-------------+---------+------+------------+---------------+---------+
|         350 | Jean-pierre | Laborde | m    | direction  | 2010-12-09    |    5000 |
|         388 | Clement     | Gallet  | m    | commercial | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter  | m    | commercial | 2011-05-03    |    3550 |
+-------------+-------------+---------+------+------------+---------------+---------+
-- Pour les 3 suivants ?
SELECT * FROM employes LIMIT 3, 3;
-- Etc, etc
SELECT * FROM employes LIMIT 6, 3;

-- Si je donne un seul param à LIMIT, il le comprend comme étant le nombre de lignes attendues dans le résultat et partira toujours de la position 0 
SELECT * FROM employes LIMIT 3; 
+-------------+-------------+---------+------+------------+---------------+---------+
| id_employes | prenom      | nom     | sexe | service    | date_embauche | salaire |
+-------------+-------------+---------+------+------------+---------------+---------+
|         350 | Jean-pierre | Laborde | m    | direction  | 2010-12-09    |    5000 |
|         388 | Clement     | Gallet  | m    | commercial | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter  | m    | commercial | 2011-05-03    |    3550 |
+-------------+-------------+---------+------+------------+---------------+---------+
-- La syntaxe ci dessous est celle de PostgreSQL, elle fonctionne malgré tout en MySQL ! Ce qui me permet plus tard de si je souhaite migrer de MySQL vers Postgre, que je puisse le faire sans rechanger toutes mes instructions LIMIT 
SELECT * FROM employes LIMIT 3 OFFSET 0;

-- Affichage des employés avec leur salaire annuel 
SELECT nom, prenom, service, salaire * 12 FROM employes;
-- La même requête mais en donnant un alias à la colonne du calcul
SELECT nom, prenom, service, salaire * 12 AS salaire_annuel FROM employes;
-- Attention, on pense toujours que l'on récupèrera le résultat de notre requête dans notre langage back, souvent en format array ou objet, donc, il faudra s'assurer de mettre des alias "compatible" pour éviter les caractères spéciaux dans les noms des props d'objet ou de key des 
+----------+-------------+---------------+----------------+
| nom      | prenom      | service       | salaire_annuel |
+----------+-------------+---------------+----------------+
| Laborde  | Jean-pierre | direction     |          60000 |
| Gallet   | Clement     | commercial    |          27600 |
| Winter   | Thomas      | commercial    |          42600 |
| Dubar    | Chloe       | production    |          22800 |
| Fellier  | Elodie      | secretariat   |          19200 |
| Grand    | Fabrice     | comptabilite  |          34800 |
| Collier  | Melanie     | commercial    |          37200 |
| Blanchet | Laura       | direction     |          54000 |
| Miller   | Guillaume   | commercial    |          22800 |
| Perrin   | Celine      | commercial    |          32400 |
| Cottet   | Julien      | secretariat   |          16680 |
| Vignal   | Mathieu     | informatique  |          30000 |
| Desprez  | Thierry     | secretariat   |          18000 |
| Thoyer   | Amandine    | communication |          25200 |
| Durand   | Damien      | informatique  |          27000 |
| Chevel   | Daniel      | informatique  |          37200 |
| Martin   | Nathalie    | juridique     |          42600 |
| Lagarde  | Benoit      | production    |          30600 |
| Sennard  | Emilie      | commercial    |          21600 |
| Lafaye   | Stephanie   | assistant     |          21300 |
+----------+-------------+---------------+----------------+

--------------------- FONCTIONS D'AGREGATION -------------------------------

-- SUM() pour avoir la somme 
-- La masse salariale annuelle de l'entreprise
SELECT SUM(salaire * 12) AS masse_salariale FROM employes;
+-----------------+
| masse_salariale |
+-----------------+
|          623580 |
+-----------------+

-- AVG() la moyenne
-- Affichage du salaire moyen de l'entreprise
SELECT AVG(salaire) AS salaire_moyen FROM employes;
+---------------+
| salaire_moyen |
+---------------+
|       2598.25 |
+---------------+

-- ROUND() pour arrondir
-- ROUND(valeur) => arrondi à l'entier
-- ROUND(valeur, 1) => arrondi à 1 décimale (je peux choisir le nombre de décimales souhaitées)
SELECT ROUND(AVG(salaire)) AS salaire_moyen FROM employes;

-- COUNT() permet de compter le nombre de ligne d'une requête
-- Le nombre d'employés dans l'entreprise : 
SELECT COUNT(*) AS nombre_employes FROM employes; 
-- Attention ici pour le param fournit dans les parenthèses du COUNT()
-- Si je fourni * ou la primary key de la table, je m'assure de compter toutes les lignes de la selection 
-- Par contre, si je fourni un autre champ, et que ce champ est peut être NULL sur certaines lignes, alors les lignes NULL ne seront pas comptées ! 
-- On préfèrera toujours mettre * et régler avec des conditions WHERE pour isoler le compte que de certaines lignes
+-----------------+
| nombre_employes |
+-----------------+
|              20 |
+-----------------+

-- MIN() & MAX()
-- salaire minimum
SELECT MIN(salaire) FROM employes;
+--------------+
| MIN(salaire) |
+--------------+
|         1390 |
+--------------+
-- salaire maximum
SELECT MAX(salaire) FROM employes;
+--------------+
| MAX(salaire) |
+--------------+
|         5000 |
+--------------+

-- EXERCICE : Affichez le salaire minimum ainsi que le prénom de l'employé ayant ce salaire
    -- Pensez bien à vérifier vos résultats 
SELECT prenom, MIN(salaire) FROM employes;
+-------------+--------------+
| prenom      | MIN(salaire) |
+-------------+--------------+
| Jean-pierre |         1390 |
+-------------+--------------+
-- Erreur ci dessus, cela nous sort Jean-Pierre, le prénom de la BDD, à côté de la fonction d'agregation qui ne peut sortir qu'une seule ligne de résultat ! Incohérence de résultat ! 

-- 1ère possibilité requête imbriquée
                                                                -- 1390
SELECT prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);

-- 2 ème possibilité grâce à un ORDER BY et LIMIT
SELECT prenom, salaire FROM employes ORDER BY salaire ASC LIMIT 1;
+--------+---------+
| prenom | salaire |
+--------+---------+
| Julien |    1390 |
+--------+---------+

-- IN & NOT IN pour tester plusieurs valeurs 
-- Affichage des employés des services commercial et comptabilité
SELECT * FROM employes WHERE service = "commercial" OR service = "comptabilite";
SELECT * FROM employes WHERE service IN ("commercial", "comptabilite");
+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         388 | Clement   | Gallet  | m    | commercial   | 2010-12-15    |    2300 |
|         415 | Thomas    | Winter  | m    | commercial   | 2011-05-03    |    3550 |
|         509 | Fabrice   | Grand   | m    | comptabilite | 2011-12-30    |    2900 |
|         547 | Melanie   | Collier | f    | commercial   | 2012-01-08    |    3100 |
|         627 | Guillaume | Miller  | m    | commercial   | 2012-07-02    |    1900 |
|         655 | Celine    | Perrin  | f    | commercial   | 2012-09-10    |    2700 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
+-------------+-----------+---------+------+--------------+---------------+---------+
SELECT * FROM employes WHERE service NOT IN ("commercial", "comptabilite");

-- Plusieurs conditions : AND 
-- On veut un employé du service commercial ayant un salaire inférieur ou égal à 2000
SELECT * FROM employes WHERE service = "commercial" AND salaire <= 2000;

-- MySQL accepte tout à fait les sauts de lignes dans les requêtes, on souhaitera parfois sauter des lignes sur les requêtes longues pour gagner en visibilité 
SELECT * 
FROM employes 
WHERE service = "commercial" 
AND salaire <= 2000
AND sexe = "m"
ORDER by nom;

-- L'un ou l'autre d'un ensemble de conditions : OR 
-- EXERCICE : requête pour trouver : employés du service production ayant un salaire égal à 1900 ou 2300
    -- Vérifier vos résultats 
SELECT * FROM employes WHERE service = "production" AND salaire = 1900 OR salaire = 2300;
+-------------+---------+--------+------+------------+---------------+---------+
| id_employes | prenom  | nom    | sexe | service    | date_embauche | salaire |
+-------------+---------+--------+------+------------+---------------+---------+
|         388 | Clement | Gallet | m    | commercial | 2010-12-15    |    2300 |
|         417 | Chloe   | Dubar  | f    | production | 2011-09-05    |    1900 |
+-------------+---------+--------+------+------------+---------------+---------+
SELECT * FROM employes WHERE service = "production" AND (salaire = 1900 OR salaire = 2300);
SELECT * FROM employes WHERE service = "production" AND salaire IN (1900,2300);
+-------------+--------+-------+------+------------+---------------+---------+
| id_employes | prenom | nom   | sexe | service    | date_embauche | salaire |
+-------------+--------+-------+------+------------+---------------+---------+
|         417 | Chloe  | Dubar | f    | production | 2011-09-05    |    1900 |
+-------------+--------+-------+------+------------+---------------+---------+

-- GROUP BY pour regrouper selon un ou plusieurs champs (généralement utilisé avec des fonctions d'agrégation)
-- Nombre d'employés par service 
SELECT COUNT(*), service FROM employes; -- Résultat incorrect du fait du COUNT() (fonction d'agrégation), le résultat ne renvoie qu'une seule ligne 
-- Avec GROUP BY il va être possible de demander de nous renvoyer le COUNT() par service 

SELECT COUNT(*) AS nombre_employes, service FROM employes GROUP BY service;
+-----------------+---------------+
| nombre_employes | service       |
+-----------------+---------------+
|               2 | direction     |
|               6 | commercial    |
|               2 | production    |
|               3 | secretariat   |
|               1 | comptabilite  |
|               3 | informatique  |
|               1 | communication |
|               1 | juridique     |
|               1 | assistant     |
+-----------------+---------------+
-- Le GROUP BY m'a permis d'appliquer la fonction d'agrégation COUNT() à divers bloc séparément les uns des autres 


-- Ci dessous une requête classique SELECT * FROM employes ORDER BY service;
-- On imagine le fonctionnement de GROUP BY par un éclatement du résultat qui permet au système d'appliquer la fonction d'agreg pour chaque groupe différent, ici on regroupe par "service", donc il va compter chaque employé par chaque service distinct 
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+

|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |

|         388 | Clement     | Gallet   | m    | commercial    | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter   | m    | commercial    | 2011-05-03    |    3550 |
|         547 | Melanie     | Collier  | f    | commercial    | 2012-01-08    |    3100 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2012-07-02    |    1900 |
|         655 | Celine      | Perrin   | f    | commercial    | 2012-09-10    |    2700 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2017-01-11    |    1800 |

|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |

|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |

|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |

|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |

|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |

|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |

|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
+-------------+-------------+----------+------+---------------+---------------+---------+


-- Il est possible de mettre une condition sur un GROUP BY    :  HAVING 
-- Nombre d'employés par service, pour les services ayant plus de 2 employés 
SELECT COUNT(*), service FROM employes GROUP BY service HAVING COUNT(*) > 2;
+----------+--------------+
| COUNT(*) | service      |
+----------+--------------+
|        6 | commercial   |
|        3 | secretariat  |
|        3 | informatique |
+----------+--------------+

--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
------------ REQUETES D'INSERTION (Action : enregistrement) --------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------

-- Requête d'insertion : INSERT INTO table (champ1, champ2, champ3, etc) VALUES (valeur1, valeur2, valeur3, etc);

-- En citant tous les champs : 
INSERT INTO employes (id_employes, prenom, nom, salaire, sexe, service, date_embauche) VALUES (NULL, "Pierral", "Lacaze", 12000, "m", "Web", CURDATE());
-- Vérification
SELECT * FROM employes;

-- Je peux ne pas citer du tout l'id, de toute façon il est auto incrémenté 
INSERT INTO employes (prenom, nom, salaire, sexe, service, date_embauche) VALUES ("Pierral", "Lacaze", 20000, "m", "Info", CURDATE());

-- Dernière syntaxe, sans citer les champs, par contre attention, il faudra donner les VALUES dans le MEME ORDRE QUE LA STRUCTURE DE LA TABLE
INSERT INTO employes VALUES (NULL, "Pierro", "Lac", "m", "Web", CURDATE(), 1800);


--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
------------ REQUETES DE MODIFICATION (Action : modification) ------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------

-- On modifie le salaire d'un employé
UPDATE employes SET salaire = 2100 WHERE id_employes = 991;
-- Plusieurs champs à modifier
UPDATE employes SET salaire = 2000, service = "informatique" WHERE id_employes = 992;

-- REPLACE
-- REPLACE se comporte à la fois comme un INSERT et comme un UPDATE

-- Premier lancement de REPLACE pour faire un insert 
REPLACE INTO employes VALUES (994, "Polo", "Lolo", "m", "resto", NOW(), 2000);

-- Deuxième lancement de REPLACE pour modifier Polo
REPLACE INTO employes VALUES (994, "Polo", "Lolo", "m", "resto", NOW(), 1000);

-- ATTENTION on utilise JAMAIS REPLACE
    -- Pourquoi ? Car dans le contexte d'une "modification" REPLACE va d'abord supprimer la ligne pour ensuite la réinsérer
        -- Cela nous poserait d'énorme problème si l'enregistrement supprimé est lié à une autre table via une relation avec une contrainte en mode CASCADE (réaction en chaine), ce qui induirait la suppression de tous les éléments enfants qui lui sont rattachés (Par exemple, un utilisateur passe des commandes, les commandes sont les "enfants" de cet utilisateur)


--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
------------ REQUETES DE SUPPRESSION (Action : supprimer) ----------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------

DELETE FROM employes; -- Cette requête supprime toutes les données de la table (un peu comme un TRUNCATE mais DELETE est une opération type CRUD)

-- Suppression d'une ligne en rapport avec une condition 
DELETE FROM employes WHERE id_employes = 991;

-- Suppression des employés avec un id supérieur à 990 
DELETE FROM employes WHERE id_employes > 990;

--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- EXERCICES : -----------------------------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------

-- 1 -- Afficher la profession de l'employé 547.
SELECT service FROM employes WHERE id_employes = 547;
+------------+
| service    |
+------------+
| commercial |
+------------+
-- 2 -- Afficher la date d'embauche d'Amandine.	
SELECT date_embauche FROM employes WHERE prenom = "Amandine";
+---------------+
| date_embauche |
+---------------+
| 2014-01-23    |
+---------------+
-- 3 -- Afficher le nom de famille de Guillaume	
SELECT nom FROM employes WHERE prenom = "Guillaume";
+--------+
| nom    |
+--------+
| Miller |
+--------+
-- 4 -- Afficher le nombre de personne ayant un n° id_employes commençant par le chiffre 5.	
SELECT COUNT(*) AS nbr_id_5 FROM employes WHERE id_employes LIKE "5%";
+----------+
| nbr_id_5 |
+----------+
|        3 |
+----------+
-- 5 -- Afficher le nombre de commerciaux.
SELECT COUNT(*) AS nbr_commerciaux FROM employes WHERE service = "commercial";
+-----------------+
| nbr_commerciaux |
+-----------------+
|               6 |
+-----------------+
-- 6 -- Afficher le salaire moyen des informaticiens 
SELECT ROUND(AVG(salaire)) AS moyenne_informaticiens FROM employes WHERE service = "informatique";
+------------------------+
| moyenne_informaticiens |
+------------------------+
|                   2617 |
+------------------------+
-- 7 -- Afficher les 5 premiers employés après avoir classé leur nom de famille par ordre alphabétique.
 SELECT prenom, nom FROM employes ORDER BY nom LIMIT 5;
 +---------+----------+
| prenom  | nom      |
+---------+----------+
| Laura   | Blanchet |
| Daniel  | Chevel   |
| Melanie | Collier  |
| Julien  | Cottet   |
| Thierry | Desprez  |
+---------+----------+
-- 8 -- Afficher le coût des commerciaux sur 1 année.	
SELECT SUM(salaire * 12) AS cout_commerciaux FROM employes WHERE service = "commercial";
+------------------+
| cout_commerciaux |
+------------------+
|           184200 |
+------------------+
-- 9 -- Afficher le salaire moyen par service. 
SELECT service, ROUND(AVG(salaire)) AS salaire_moyen FROM employes GROUP BY service;
-- 10 -- Afficher le nombre de recrutement sur l'année 2010
SELECT COUNT(*) AS recrutement_2010 FROM employes WHERE date_embauche BETWEEN "2010-01-01" AND "2010-12-31";
SELECT COUNT(*) AS recrutement_2010 FROM employes WHERE YEAR(date_embauche) = 2010;
SELECT COUNT(*) AS recrutement_2010 FROM employes WHERE date_embauche LIKE "2010%";
+------------------+
| recrutement_2010 |
+------------------+
|                2 |
+------------------+
-- 11 -- Afficher le salaire moyen appliqué lors des recrutements sur la période allant de 2015 a 2017
SELECT AVG(salaire) AS salaire_moyen FROM employes WHERE YEAR(date_embauche) BETWEEN 2015 AND 2017;
+---------------+
| salaire_moyen |
+---------------+
|          2555 |
+---------------+
-- 12 -- Afficher le nombre de service différent 
SELECT COUNT(DISTINCT service) AS nbr_services FROM employes; 
+--------------+
| nbr_services |
+--------------+
|            9 |
+--------------+
-- 13 -- Afficher tous les employés sauf ceux du service production et secrétariat
SELECT * FROM employes WHERE service NOT IN ("production", "secretariat");
-- 14 -- Afficher conjointement le nombre d'homme et de femme dans l'entreprise
SELECT sexe, COUNT(*) AS nbr FROM employes GROUP BY sexe;
SELECT SUM(sexe = 'f') AS femmes, SUM(sexe = 'm') AS hombres FROM employes;
+------+-----+
| sexe | nbr |
+------+-----+
| m    |  11 |
| f    |   9 |
+------+-----+
-- 15 -- Afficher les commerciaux ayant été recrutés avant 2012 de sexe masculin et gagnant un salaire supérieur a 2500 €
SELECT * FROM employes 
WHERE service = "commercial" 
AND date_embauche < "2012-01-01" 
AND sexe = "m" 
AND salaire > 2500;
+-------------+--------+--------+------+------------+---------------+---------+
| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
+-------------+--------+--------+------+------------+---------------+---------+
|         415 | Thomas | Winter | m    | commercial | 2011-05-03    |    3550 |
+-------------+--------+--------+------+------------+---------------+---------+
-- 16 -- Qui a été embauché en dernier 
SELECT * FROM employes ORDER BY date_embauche DESC LIMIT 1;
SELECT * FROM employes WHERE date_embauche = (SELECT MAX(date_embauche) FROM employes);
+-------------+-----------+--------+------+-----------+---------------+---------+
| id_employes | prenom    | nom    | sexe | service   | date_embauche | salaire |
+-------------+-----------+--------+------+-----------+---------------+---------+
|         990 | Stephanie | Lafaye | f    | assistant | 2017-03-01    |    1775 |
+-------------+-----------+--------+------+-----------+---------------+---------+
-- 17 -- Afficher les informations sur l'employé du service commercial gagnant le salaire le plus élevé
SELECT * FROM employes WHERE service = "commercial" ORDER BY salaire DESC LIMIT 1;
+-------------+--------+--------+------+------------+---------------+---------+
| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
+-------------+--------+--------+------+------------+---------------+---------+
|         415 | Thomas | Winter | m    | commercial | 2011-05-03    |    3550 |
+-------------+--------+--------+------+------------+---------------+---------+
-- 18 -- Afficher le prénom du comptable gagnant le meilleur salaire 
SELECT prenom FROM employes WHERE service = "comptabilite" ORDER BY salaire DESC LIMIT 1;
+---------+
| prenom  |
+---------+
| Fabrice |
+---------+
-- 19 -- Afficher le prénom de l'informaticien ayant été recruté en premier 
SELECT prenom FROM employes WHERE service = "informatique" ORDER BY date_embauche ASC LIMIT 1;
+---------+
| prenom  |
+---------+
| Mathieu |
+---------+
-- 20 -- Augmenter chaque employé de 100 €
UPDATE employes SET salaire = salaire + 100;
-- 21 -- Supprimer les employés du service secrétariat
DELETE FROM employes WHERE service = "secretariat";