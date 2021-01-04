<?php
namespace App;
use \PDO;

class Connection{

    public static function getPDO() : PDO
    {
        define("DB_NAME", 'tutoblog');
        define("DB_HOST", 'localhost:8889');
        define("DB_USER", 'root');
        define("DB_PASS", 'root');      

        try {
        return new PDO(
        'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8', lc_time_names = 'fr_FR'"
        ]
    );
} catch (PDOException $exception) {
    echo 'Erreur de connexion à la base de données';
}
    }

}