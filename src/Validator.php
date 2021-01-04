<?php
namespace App;

use finfo;
use Valitron\Validator as ValitronValidator;

class Validator extends ValitronValidator {

    protected static $_lang = "fr";

    public function __construct($data = array(), $fields = array(), $lang = null, $langDir = null)
    {
        parent::__construct($data, $fields, $lang, $langDir);// on écrase l'heritage du parent
        self::addRule('image', function($field, $value, array $params, array $fields){//on rajoute une validation image
            if ($value['size'] === 0){//si il n'y a pas d'image on valide
                return true;
            }
            $mimes = ['image/jpeg', 'image/png'];//valide ce type d'image
            $info = new finfo();
            $info = $info->file($value['tmp_name'], FILEINFO_MIME_TYPE);//renseigne les infos images
            //return false; //return false pour le test
            return in_array($info, $mimes);
        }, 'Ce fichier n\'est pas une image valide');
    }

    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field}', '', $message);//supprime le nom du champs ds l'affichage des message d'erreurs
    }
}