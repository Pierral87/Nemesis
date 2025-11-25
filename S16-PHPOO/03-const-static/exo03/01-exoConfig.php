<?php 

/* 

Exercice 1 : Classe Config pour une application web 

Création d'une classe config pour la gérer la config d'une appli, cette classe contiendra des const et des méthodes permettant d'accèder à des informations 

    Créaation de classe Config : 
        Une const APP_NAME    
        Une propriété static $settings qui contiendra des param de l'appli sous forme de key=>value  (debug, URL racine, login/password BDD, et autres infos de votre choix) 
        Une méthode static setSetting($key, $value) pour ajouter une valeur dans $settings 
        une méthode static getSetting($key) pour récupérer une valeur de $settings 
        une méthode static getAppName() pour récupérer la const 

*/