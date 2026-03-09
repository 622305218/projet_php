<?php ob_start()?>

<form method="POST" action="<?= URL ?>registerValidation" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <input type="text" class="form-control" name="nom" placeholder="Nom">
    </div>  
    <div class="form-group mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email">
    </div>  
    <div class="form-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="Mot de passe">
    </div> 
    <div class="form-group mb-3">
        <select class="form-control-select" name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div> 
    <div class="form-group mb-3">
        <select class="form-control-select" name="actif" id="actif">
            <option value="1">Actif</option>
            <option value="0">Inactif</option>
        </select>
    </div>
    
    
    <button type="submit" class="btn btn-primary">Inscription</button>
    <!-- <p>Pas encore de compte <a href="<?= URL ?>register">S'inscrire</a></p> -->
</form>

<?php 
$titre = "Inscription";
$content = ob_get_clean();
require "template.php";
?>

