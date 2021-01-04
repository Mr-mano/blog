<?php
namespace App\Helpers;

class Text {

    public static function excerpt(string $content, int $limit = 60)
    {
        //récupére la taille chaine de carectère, vérifie si = ou < $limit
        if(mb_strlen($content) <= $limit){
            return $content;
        }
        //mb_strpos() recherche l'espace après le dernier mot pour ne pas le couper
        $lastSpace = mb_strpos($content, ' ', $limit);
        return mb_substr($content, 0, $lastSpace) . '...';
    }
}