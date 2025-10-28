CREATE DATABASE bibliotheque;
USE bibliotheque;

CREATE TABLE abonne (
  id_abonne INT(3) NOT NULL AUTO_INCREMENT,
  prenom VARCHAR(15) NOT NULL,
  PRIMARY KEY (id_abonne)
) ENGINE=InnoDB ;

INSERT INTO abonne (id_abonne, prenom) VALUES
(1, 'Guillaume'),
(2, 'Benoit'),
(3, 'Chloe'),
(4, 'Laura');


CREATE TABLE livre (
  id_livre INT(3) NOT NULL AUTO_INCREMENT,
  auteur VARCHAR(25) NOT NULL,
  titre VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_livre)
) ENGINE=InnoDB ;

INSERT INTO livre (id_livre, auteur, titre) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami '),
(102, 'HONORE DE BALZAC', 'Le pere Goriot'),
(103, 'ALPHONSE DAUDET', 'Le Petit chose'),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot'),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires');

CREATE TABLE emprunt (
  id_emprunt INT(3) NOT NULL AUTO_INCREMENT,
  id_livre INT(3) DEFAULT NULL,
  id_abonne INT(3) DEFAULT NULL,
  date_sortie DATE NOT NULL,
  date_rendu DATE DEFAULT NULL,
  PRIMARY KEY  (id_emprunt)
) ENGINE=InnoDB ;

INSERT INTO emprunt (id_emprunt, id_livre, id_abonne, date_sortie, date_rendu) VALUES
(1, 100, 1, '2016-12-07', '2016-12-11'),
(2, 101, 2, '2016-12-07', '2016-12-18'),
(3, 100, 3, '2016-12-11', '2016-12-19'),
(4, 103, 4, '2016-12-12', '2016-12-22'),
(5, 104, 1, '2016-12-15', '2016-12-30'),
(6, 105, 2, '2017-01-02', '2017-01-15'),
(7, 105, 3, '2017-02-15', NULL),
(8, 100, 2, '2017-02-20', NULL);

-- Quels sont les id_livre des livres qui n'ont pas été rendu à la bibliothèque ? 
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
-- Attention, la valeur NULL se teste avec IS NULL ou IS NOT NULL 
+----------+
| id_livre |
+----------+
|      105 |
|      100 |
+----------+

-- Pour avoir les titres des livres ? Ces informations sont sur une autre table...
-- 2 possibilités :
    -- Requêtes imbriquées
    -- Requêtes en jointure 

---------------------------------------------------------------------
---------------------------------------------------------------------
------- REQUETES IMBRIQUEES (sur plusieurs tables) ------------------
---------------------------------------------------------------------
---------------------------------------------------------------------
---------------------------------------------------------------------

-- Quels sont les titres des livres qui n'ont pas été rendu à la bibliothèque ?
    -- Concept : C'est une requête à l'intérieur d'une autre requête 
        -- J'ai besoin du résultat de la requête de "sous niveau" pour mener à bien la requête de "premier niveau"

-- Ce que je veux afficher ? Les titres, ils sont présents sur la table "livre"
    -- Quel est le champ commun entre mes tables ? Forcément la primary key/foreign key, ici c'est id_livre
        -- Le résultat de la deuxième requête me permet de sortir les titres des livres de la première requête
    SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+
    -- Pour une requête imbriquée entre plusieurs tables il faut forcément une association/relation afin d'avoir un champ commun (PK/FK)

-- EXERCICE 1: Quels sont les prénoms des abonnés n'ayant pas rendu un livre à la bibliotheque.
SELECT prenom 
FROM abonne 
WHERE id_abonne IN (
  SELECT id_abonne 
  FROM emprunt 
  WHERE date_rendu IS NULL
);
-- EXERCICE 2: Nous aimerions connaitre le(s) n° des livres empruntés par Chloé
SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "Chloe");
+----------+
| id_livre |
+----------+
|      100 |
|      105 |
+----------+
-- EXERCICE 3: Affichez les prénoms des abonnés ayant emprunté un livre le 07/12/2016.
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_sortie = "2016-12-07");
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+
-- EXERCICE 4: combien de livre Guillaume a emprunté à la bibliotheque ?
SELECT COUNT(*) AS emprunts_guillaume FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "Guillaume");
+--------------------+
| emprunts_guillaume |
+--------------------+
|                  2 |
+--------------------+
-- EXERCICE 5: Affichez la liste des abonnés ayant déjà emprunté un livre d'Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE id_livre IN 
        (SELECT id_livre FROM livre WHERE auteur = "Alphonse Daudet"));
+--------+
| prenom |
+--------+
| Laura  |
+--------+
-- EXERCICE 6: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
-- EXERCICE 7: Nous aimerions connaitre les titres des livres que Chloe n'a pas emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre NOT IN
    (SELECT id_livre FROM emprunt WHERE id_abonne IN
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
-- EXERCICE 8: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque ET qui n'ont pas été rendu.
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe" ) AND date_rendu IS NULL);
-- EXERCICE 9 :  Qui a emprunté le plus de livre à la bibliotheque ?
SELECT DISTINCT prenom FROM abonne WHERE id_abonne = 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 1);

SELECT DISTINCT prenom FROM abonne WHERE id_abonne IN  
    (SELECT id_abonne FROM (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 1) AS abonne_max_emprunts);


-- Si jamais ils sont deux à avoir le même nombre d'emprunts max, alors on est obligé de passer par une table temporaire
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne HAVING COUNT(*) = 
        (SELECT MAX(nombre_emprunt) FROM (SELECT COUNT(*) AS nombre_emprunt FROM emprunt GROUP BY id_abonne) AS count));
+--------+
| prenom |
+--------+
| Benoit |
| Chloe  |
+--------+


---------------------------------------------------------------------
---------------------------------------------------------------------
------- REQUETES EN JOINTURE ----------------------------------------
---------------------------------------------------------------------
---------------------------------------------------------------------
---------------------------------------------------------------------

-- Une jointure est toujours possible 
-- Une imbriquée est possible uniquement si les champs que l'on souhaite afficher proviennent de la même table 

-- Avec une requête imbriquée, je parcours les tables les unes après les autres en transitant par les clés
-- Avec une requête en jointure, dépendant des syntaxes, je peux mélanger les champs de sorties, les tables, les conditions sans que cela pose problème 

-- Nous aimerions connaitre les dates de sortie et les dates de rendu pour l'abonné Guillaume (en affichant aussi Guillaume)
    -- En imbriquée ce n'est pas possible car Guillaume est une info qui se trouve sur la table abonne et les dates sont sur la table emprunt 

SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu    -- Ce que je veux afficher, de plusieurs tables différentes 
FROM abonne, emprunt                      -- Les tables dont j'ai besoin
WHERE prenom = "Guillaume"                -- Ma condition du prénom Guillaume
AND abonne.id_abonne = emprunt.id_abonne; -- La création de la jointure (on indique ici la liaison entre la PK et la FK)
-- Il est toujours bon de spécifier les prefixes des tables devant le nom des champs, cela évite les erreurs de type "ambigous name"

+-----------+-------------+------------+
| prenom    | date_sortie | date_rendu |
+-----------+-------------+------------+
| Guillaume | 2016-12-07  | 2016-12-11 |
| Guillaume | 2016-12-15  | 2016-12-30 |
+-----------+-------------+------------+

-- On peut indiquer des alias de table pour raccourcir l'écriture des préfixes 
SELECT a.prenom, e.date_sortie, e.date_rendu   
FROM abonne a, emprunt e                     
WHERE prenom = "Guillaume"                
AND a.id_abonne = e.id_abonne; 

-- Autre syntaxe pour les jointures
-- On préfèrera ces syntaxes car elle sont de même forme que les futures jointures externes
-- On va utiliser ici JOIN ou INNER JOIN (même chose pour les deux, un JOIN tout court est par défaut un INNER JOIN)
-- Avec ces méthodes on joint les tables une par une
SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
INNER JOIN abonne a USING (id_abonne) -- Je peux utiliser USING uniquement si le champ lié (PK et FK) possède le même nom dans les deux tables 
WHERE prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
JOIN abonne a USING (id_abonne)
WHERE prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
JOIN abonne a ON a.id_abonne = e.id_abonne -- Sinon, je peux utiliser la syntaxe ON pour lier un champ PK à un autre champ FK nommé différemment 
WHERE prenom = "Guillaume";

-- EXERCICE 1 : Nous aimerions connaitre les dates de sortie et les dates de rendu pour les livres écrit par Alphonse Daudet
-- EXERCICE 2 : Qui a emprunté le livre "une vie" sur l'année 2016
-- EXERCICE 3 : Nous aimerions connaitre le nombre de livre emprunté par chaque abonné 
-- EXERCICE 4 : Nous aimerions connaitre le nombre de livre emprunté à rendre par chaque abonné 
-- EXERCICE 5 : Qui (prenom) a emprunté Quoi (titre) et Quand (date_sortie) ?

