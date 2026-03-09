<?php ob_start()?>

<form method="POST" action="<?= URL ?>livres/av" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label for="titre">Nom du livre :</label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>  
    <div class="form-group mb-3">
        <label for="nbPages">Nombre de page :</label>
        <input type="number" class="form-control" id="nbPages" name="nbPages">
    </div> 
    <div class="form-group mb-3">
        <label for="image">Image :</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php 
$titre = "Ajout d'un livre";
$content = ob_get_clean();
require "views/template.php";
?>