<?php 

/* 

Exercice : Validation d'âge avec gestion des exceptions

Créer un script qui demande à l'utilisateur de saisir son âge pour accéder à une section réservée d'un site. Si l'âge est inférieur à 18 ans, lancer une exception et afficher un message d'erreur.

*/


function verifierAge($age)
{
    if ($age < 18) {
        throw new Exception("accès refusé: vous devez etre majeur");
    }
    return true;
}

try {
    // Ici le readline fonctionne via le terminal, on pourra saisir ensuite notre age dans la console
    $age = (int) readline("veuillez saisir votre age : ");
    verifierAge($age);
    echo "accès autorisé, bienvenue ";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
