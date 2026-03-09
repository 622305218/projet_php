<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
require "Model.class.php";
require "Livre.class.php";
class LivreManager extends Model {
    private $livres = [];

    public function ajouterLivre($livre) {
        $this->livres[] = $livre;
    }

    public function getLivres() {
        return $this->livres;
    }

    public function chargementLivres() {
        try {
            $req = $this->getBdd()->prepare("SELECT * FROM livre ORDER BY id ASC");
            $req->execute();
            $livres = $req->fetchAll();
            $req->closeCursor();
            foreach($livres as $livre) {
                $l = new Livre($livre['id'], $livre['titre'], $livre['nbPages'], $livre['image']);
                $this->ajouterLivre($l);
            }
            return $this->getLivres();
        }catch(PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function getLivreById($id) {
        foreach($this->livres as $livre) {
            if($livre->getId() == $id) {
                return $livre;
            }else {
                echo "Livre introuvable";
            }
        }
    }

    public function ajouterLivreBD($titre, $nbPages, $image) {
        $req = "
        INSERT INTO livre (titre, nbPages, image)
        values(:titre, :nbPages, :image)";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);

        $resultat = $stmt->execute();
        $stmt->closeCursor();
 
        if($resultat > 0) {
            $livre = new Livre($this->getBdd()->lastInsertId(), $titre, $nbPages, $image);
            $this->ajouterLivre($livre);
        }
    }
     
    public function suppressionLivreBD($id) {
        $req = "
        DELETE FROM livre WHERE id = :idLivre";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idLivre", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0) {
            $livre = $this->getLivreById($id); 
            unset($livre);
        }
    }

    public function modifierLivreBD($id, $titre, $nbPages, $image) {
       $req = "
        UPDATE livre SET titre = :titre, nbPages = :nbPages, image = :image
        WHERE id = :id";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);

        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0) {
            $livre = $this->getLivreById($id);
            $livre->setTitre($titre);
            $livre->setNbPages($nbPages);
            $livre->setImage($image);
        }
    }
}
?> 