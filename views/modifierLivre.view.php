<?php ob_start()?>

<form method="POST" action="<?= URL ?>livres/mv" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label for="titre">Nom du livre :</label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $livre->getTitre() ?>">
    </div>  
    <div class="form-group mb-3">
        <label for="nbPages">Nombre de page :</label>
        <input type="number" class="form-control" id="nbPages" name="nbPages" value="<?= $livre->getNbPages() ?>">
    </div> 
    <h3>Image</h3>
    <img src="<?= URL ?>/public/images/<?= $livre->getImage() ?>" alt="">
    <div class="form-group mb-3">
        <label for="image">Changer l'image :</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <input type="hidden" name="identifiant" value="<?= $livre->getId() ?>">
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php 
$titre = "Modification du livre : " . $livre->getId();
$content = ob_get_clean();
require "views/template.php";
?>