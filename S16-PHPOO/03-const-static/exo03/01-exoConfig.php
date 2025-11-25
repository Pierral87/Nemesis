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

class Config
{
      const APP_NAME = "myapp";

      public static $settings = [
            "debug" => true,
            "urlRacine" => "https://google.com",
            "login" => "martin.rlt@gmail.com",
            "password" => "unmotdepassesupersécurisé",
            "BDD" => "MariaDB"
      ];

      public static function setSettings($key, $value)
      {
            self::$settings[$key] = $value;
      }

      public static function getSettings($key)
      {
            if (array_key_exists($key, self::$settings)) {
                  return self::$settings[$key];
            } else {
                  trigger_error("La clé doit exister", E_USER_NOTICE);
            }
      }

      public static function getAppName()
      {
            return self::APP_NAME;
      }
}

echo Config::getAppName();
echo Config::setSettings("debug", false);
echo var_dump(Config::getSettings("debug"));
var_dump(Config::getSettings("z"));