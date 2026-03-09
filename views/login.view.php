<?php ob_start()?>

<form method="POST" action="<?= URL ?>loginValidation" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email">
    </div>  
    <div class="form-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="Mot de passe">
    </div> 
  
    <button type="submit" class="btn btn-primary">Connexion</button>
    <p>Pas encore de compte <a href="<?= URL ?>register">S'inscrire</a></p>
</form>

<?php 
$titre = "Login";
$content = ob_get_clean();
require "template.php";
?>