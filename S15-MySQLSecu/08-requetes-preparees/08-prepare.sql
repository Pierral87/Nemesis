--------------------------------------------------------------------------
--------------------------------------------------------------------------
------------- REQUETES PREPAREES -----------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------


-- Une requête préparée est une requête qui ne s'exécute immédiatement
-- On utilise les requêtes préparées au travers du langage back qui exploite la BDD
    -- Pour nous ce sera le PHP 
-- Le but étant de fournir une requête à trou qui attends des informations afin de pouvoir s'exécuter convenablement 

-- Première étape : On fournit la requête au système
-- Deuxième étape : Interprétation de la requête en fonction des éléments fournis
-- Troisième étape : Exécution de la requête 

-- Supposons une saisie dans un form, je cherche les employés par leur prénom, je vais taper "Jean-Pierre" dans le form 
SELECT * FROM employes WHERE prenom = "Jean-Pierre";

-- Libre à l'utilisateur de tenter une injection SQL au travers d'un form
-- Plutôt que de saisir Jean-Pierre, s'il saisit la ligne suivante : "; DROP DATABASE entreprise;
-- Alors la première requête prévue va s'exécuter et se cloturer grâce à son guillemet suivi du point virgule, libre à lui ensuite d'exécuter la requête de son choix, ici un DROP DATABASE entreprise;
-- Ce qui malheureusement supprime totalement la BDD  T_T 
-- Injection réussie pour le pirate !  
SELECT * FROM employes WHERE prenom = ""; DROP DATABASE entreprise;  --";

-- Les requêtes préparées au travers de notre langage back nous permettent d'appliquer des filtres aux saisies des utilisateurs et empêcher les injections 

PREPARE req1 FROM "SELECT * FROM employes WHERE prenom=?"; -- Préparation de la requête, en attente d'exécution
    SET @prenom = "Jean-Pierre"; -- Variable supposée récupérée d'un form
    EXECUTE req1 USING @prenom; -- Ici seulement la requête s'execute

