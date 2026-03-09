<?php ob_start()?>

<p>Ici le contenu de ma page d'acceuil</p>

<?php 
$titre = "Bibliothèque";
$content = ob_get_clean();
require "template.php";
?>