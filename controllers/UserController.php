<?php
require_once "models/UserManager.class.php";
require_once "models/User.class.php";

class UserController {
    private $userManager;

    public function __construct() {
        $this->userManager = new UserManager;
    }

    public function ajouterUser(){

        require "views/users/ajouter.view.php";
    }

    // public function ajouterUserValidation(){

    //     $user = new User();

    //     $user->setNom($_POST['nom']);
    //     $user->setEmail($_POST['email']);
    //     $user->setPassword($_POST['password']);
    //     $user->setRole($_POST['role']);
    //     $user->setActif($_POST['actif']);

    //     $this->userManager->addUser($user);

    //     header("Location: ".URL."users");
    // }

    public function modifierUser($id){

        $user = $this->userManager->getUserById($id);

        require "views/users/modifier.view.php";
    }

    public function modifierUserValidation(){

        $this->userManager->updateUser(

            $_POST['id'],
            $_POST['nom'],
            $_POST['email'],
            $_POST['role'],
            $_POST['actif']

        );

        header("Location: ".URL."users");
    }

    public function supprimerUser($id){

        $this->userManager->deleteUser($id);

        header("Location: ".URL."users");
        exit();
    }

    public function login(){
        require "views/login.view.php";
    }

    public function loginValidation(){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $user = $this->userManager->findByEmail($email);

        if($user && password_verify($password,$user->password)){

            $_SESSION['user'] = $user;

            header("Location: ".URL."accueil");
            exit();

        }else{

            echo "Email ou mot de passe incorrect";
        }
    }

    public function register(){

        require "views/register.view.php";
    }

    public function registerValidation(){

        $user = new User();
        if(isset($_POST['nom'], $_POST['email'], $_POST['password'], $_POST['role'], $_POST['actif'])) {
            $user->setNom($_POST['nom']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setRole($_POST['role']);
            $user->setActif($_POST['actif']);
        }

        $this->userManager->addUser($user);
        header("Location: ".URL."login");
        exit();
    }

    public function logout(){

        session_destroy();

        header("Location: ".URL."login");
    }

    public function listeUsers(){

        $users = $this->userManager->getAllUser();

        require "views/users.view.php";
    }

    public function estVide($datas) {
        foreach($datas as $data) {
            if(empty($data)) {
                return false;
            }
        }
    }

}
?>