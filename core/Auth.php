<?php
class Auth {
    public static function estConnecte() {
        return isset($_SESSION['user']);
    }

    public static function verifierConnection() {
        if(!self::estConnecte()) {
            header("Location: " . URL . "login");
            exit();
        }
    }
}
?>