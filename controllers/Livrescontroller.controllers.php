<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
require "models/LivreManager.class.php";

class Livrecontroller {
    private $livreManager;

    public function __construct() {
        $this->livreManager = new LivreManager;
        $this->livreManager->chargementLivres();
    }

    public function afficherLivres() {
        $livres = $this->livreManager->getLivres();
        require "views/livres.view.php";
    }

    public function afficherLivre($id) {
       $livre = $this->livreManager->getLivreById($id);
       require "views/afficherLivre.view.php";
    }

    public function ajouterLivre() {
        require "views/ajouterLivre.view.php";
    }

    public function ajouterLivreValidation() {
        if(isset($_POST['titre']) && isset($_POST['nbPages']) && isset($_FILES['image'])){

        if($_FILES['image']['error'] === 0){

            $file = $_FILES['image'];
            $repertoire = "public/images/";

            $nomImageAjoutee = $this->ajoutImage($file, $repertoire);

            $this->livreManager->ajouterLivreBD(
                $_POST['titre'],
                $_POST['nbPages'],
                $nomImageAjoutee
            );

            header("Location: ".URL."livres");
            exit();
        }
    }
    }

    public function suppressionLivre($id) {
        $nomImage = $this->livreManager->getLivreById($id)->getImage();
        unlink('public/images/'.$nomImage);
        $this->livreManager->suppressionLivreBD($id);
        header("Location: ". URL . "livres");
        exit();
    }

    public function modifierLivreValidation (){
        $imageAcutuelle = $this->livreManager->getLivreById($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if($file['size'] > 0) {
            unlink('public/images/'.$imageAcutuelle);
            $repertoire = "public/images/";
            $nomImageAjoutee = $this->ajoutImage($file, $repertoire);
        } else {
            $nomImageAjoutee = $imageAcutuelle;
        }

        $this->livreManager->modifierLivreBD(
            $_POST['identifiant'],
            $_POST['titre'],
            $_POST['nbPages'],
            $nomImageAjoutee
        );
        header("Location: ". URL . "livres");
        exit();
    }
    public function modifierLivre($id) {
        $livre = $this->livreManager->getLivreById($id);
        require "views/modifierLivre.view.php";
    }

    private function ajoutImage($file, $dir) {
        if(!isset($file['name']) || empty($file['name'])) {
            throw new Exception("Vous devez sélectionner une image !");
        }

        if(!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $random = rand(0, 99999);
        $target_file = $dir . $random . "_" . $file['name'];
        
        if(!getimagesize($file['tmp_name'])) {
            throw new Exception("Le fichier sélectionné n'est pas une image !");
        }

        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif") {
            throw new Exception("Vous devez sélectionner une image au format JPG, JPEG, PNG ou GIF !");
        }

        if(file_exists($target_file)) {
            throw new Exception("Une image avec le même nom existe déjà !");
        }

        if($file['size'] > 1000000) {
            throw new Exception("Votre fichier est trop gros !");
        }

        if(!move_uploaded_file($file['tmp_name'], $target_file)) {
            throw new Exception("Une erreur est survenue lors de l'upload de votre fichier !");
        }else {
            return $random . "_" . $file['name'];
        }
        // $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        // if(!in_array($extension, $allowed)) {
        //     throw new Exception("Vous devez sélectionner une image au format JPG, JPEG, PNG ou GIF !");
        // }

    }

    // private function ajoutImage($file) {
    //     $fileName = $file['name'];
    //     $fileTmpName = $file['tmp_name'];
    //     $fileSize = $file['size'];
    //     $fileError = $file['error'];
    //     $fileType = $file['type'];

    //     $fileExt = explode('.', $fileName);
    //     $fileActualExt = strtolower(end($fileExt));

    //     $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    //     if(in_array($fileActualExt, $allowed)) {
    //         if($fileError === 0) {
    //             if($fileSize < 1000000) {
    //                 $fileNameNew = uniqid('', true).".".$fileActualExt;
    //                 $fileDestination = "public/images/".$fileNameNew;
    //                 move_uploaded_file($fileTmpName, $fileDestination);
    //                 return $fileNameNew;
    //             }else {
    //                 echo "Votre fichier est trop gros !";
    //             }
    //         }else {
    //             echo "Une erreur est survenue lors de l'upload de votre fichier !";
    //         }
    //     }else {
    //         echo "Vous ne pouvez pas uploader ce type de fichier !";
    //     }
    // }
}
?>