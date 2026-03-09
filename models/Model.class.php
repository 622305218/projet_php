<?php
abstract class Model {
    private static $pdo;

    private static function setBdd() {
        try {
            self::$pdo = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8', 'biblio_user', 'biblio',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }catch(PDOException $e) {
            die("Erreur de connexion à la base de donnée : " . $e->getMessage());
        }

    }
    protected function getBdd() {
        if(self::$pdo === null) {
            self::setBdd();
        }

        return self::$pdo;
    }
}
?>