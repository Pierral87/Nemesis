---------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------
---------------------- FONCTIONS PREDEFINIES ------------------------------------------------------------
---------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------


-- Fonctions : https://sql.sh

USE bibliotheque;

SELECT DATABASE(); -- Fonction indiquant quelle est la bdd actuellement sélectionnée

SELECT LAST_INSERT_ID(); -- Le dernier id inséré dans la BDD (auto incrémenté)
    -- On s'en sert lorsque l'on fait une insertion d'un enregistrement et que l'on souhaite immédiatement récupérer son id

SELECT CONCAT("a","b","c");

SELECT CONCAT(id_abonne , "-", prenom) FROM abonne;
SELECT CONCAT_WS(" ", id_abonne, prenom) FROM abonne;

SELECT UPPER("hey");

SELECT LENGTH("Bonjour");
SELECT TRIM("             PIerro      ") as Prenom;



-- Pour ajouter une valeur de temps
SELECT DATE_ADD(CURDATE(), INTERVAL 7 DAY);
SELECT DATE_ADD(CURDATE(), INTERVAL 1 MONTH);
SELECT DATE_ADD(CURDATE(), INTERVAL 1 YEAR);

SELECT CURDATE(); -- La date du jour
SELECT NOW(); -- Date et heure de l'instant
SELECT CURTIME(); -- Uniquement l'heure 
SELECT CURRENT_TIMESTAMP;


-- Pour afficher le timestamp d'une date
SELECT UNIX_TIMESTAMP(CURDATE());


-- DATE_FORMAT pour formater une date 
SELECT prenom, DATE_FORMAT(date_sortie, "%d/%m/%Y") AS date_fr
FROM abonne a 
JOIN emprunt e USING (id_abonne);

-- On peut en MySQL aussi si on le souhaite développer nos propres fonctions utilisateurs
-- Ainsi que des procédures stockées, les procédures stockées ce sont des fonctions un peu différentes car elles lancent des requêtes "prédéfinies"