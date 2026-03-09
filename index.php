<?php
session_start();
ini_set('display_errors', 'on');
error_reporting(E_ALL);
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require_once "controllers/Livrescontroller.controllers.php";
require_once "controllers/UserController.php";
require_once "core/Auth.php";
$livreController = new Livrecontroller;
$userController = new UserController;

try {

    if (empty($_GET['page'])) {
        Auth::verifierConnection();
        require 'views/accueil.views.php';
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $pagesPubliques = ["login", "loginValidation", "register", "registerValidation"];

        if (!in_array($url[0], $pagesPubliques)) {
            Auth::verifierConnection();
        }
        switch ($url[0]) {
            case "accueil":
                require 'views/accueil.view.php';
                break;
            case "livres":
                if (empty($url[1])) {
                    $livreController->afficherLivres();
                } else if ($url[1] === "l") {
                    $livreController->afficherLivre($url[2]);
                } else if ($url[1] === "a") {
                    $livreController->ajouterLivre();
                } else if ($url[1] === "m") {
                    $livreController->modifierLivre($url[2]);
                } else if ($url[1] === "mv") {
                    $livreController->modifierLivreValidation();
                } else if ($url[1] === "s") {
                    $livreController->suppressionLivre($url[2]);
                } else if ($url[1] === "av") {
                    $livreController->ajouterLivreValidation();
                } else {
                    throw new Exception("Page introuvable");
                }
                break;
            case "login":
                $userController->login();
                break;
            case "loginValidation":
                $userController->loginValidation();
                break;
            case "register":
                $userController->register();
                break;
            case "registerValidation":
                $userController->registerValidation();
                break;
            case "logout":
                $userController->logout();
                break;
            case "users":
                Auth::verifierConnection();
               $userController->listeUsers();
                break;
            default:
                throw new Exception("Page introuvable");
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
