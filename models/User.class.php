<?php
class User {
    private $id;
    private $nom;
    private $email;
    private $password;
    private $role;
    private $actif; 

    // public function __construct($id, $nom, $email, $password, $role, $actif) {
    //     $this->id = $id;
    //     $this->nom = $nom;
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->role = $role;
    //     $this->actif = $actif;
    // }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function isActif() {
        return $this->actif;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }   

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setActif($actif) {
        $this->actif = $actif;
    }


}
?>