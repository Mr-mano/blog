<?php
namespace App;

use Valitron\Validator as ValitronValidator;

class Validator extends ValitronValidator {

    protected static $_lang = "fr";

    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field}', '', $message);//supprime le nom du champs ds les message d'erreurs
    }
}