-- UNION permet de fusionner des résultats en un seul 
-- ATTENTION, le nombre de champs (colonnes) attendus doit être le même dans les requêtes concernées
-- UNION applique un DISTINCT par défaut pour éviter les doublons

SELECT a.prenom, l.id_livre, l.auteur, l.titre 
FROM abonne a 
LEFT JOIN emprunt e ON a.id_abonne = e.id_abonne
LEFT JOIN livre l ON l.id_livre = e.id_livre
UNION
SELECT a.prenom, l.id_livre, l.auteur, l.titre 
FROM abonne a 
RIGHT JOIN emprunt e ON a.id_abonne = e.id_abonne
RIGHT JOIN livre l ON l.id_livre = e.id_livre;

-- Pour avoir les doublons (sans le DISTINCT) : 
-- UNION ALL 
SELECT a.prenom, l.id_livre, l.auteur, l.titre 
FROM abonne a 
LEFT JOIN emprunt e ON a.id_abonne = e.id_abonne
LEFT JOIN livre l ON l.id_livre = e.id_livre
UNION ALL
SELECT a.prenom, l.id_livre, l.auteur, l.titre 
FROM abonne a 
RIGHT JOIN emprunt e ON a.id_abonne = e.id_abonne
RIGHT JOIN livre l ON l.id_livre = e.id_livre;

-- On utilisera UNION assez rarement, sauf dans les cas où on souhaite faire un équivalent d'un FULL JOIN 