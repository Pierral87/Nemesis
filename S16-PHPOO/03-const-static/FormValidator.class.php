<?php 

class FormValidator {
    public static function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isRequired($value) {
        return !empty($value);
    }
}


// Valeurs récupérées d'un formulaire et à vérifier 
$email = "test@mail.com";
$pseudo = "pseudo";

if (FormValidator::isEmail($email)) {
    echo "Email ok";
}

if (FormValidator::isRequired($pseudo)) {
    echo "Pseudo bien saisi";
}