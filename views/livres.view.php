<?php 
ob_start();
?>
<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php foreach($livres as $livre) : ?>
    <tr>
        <td><img src="public/images/<?= $livre->getImage() ;?>" width="60px;" alt=""></td>
        <td class="align-middle"><a href="<?= URL ?>livres/l/<?= $livre->getId() ?>"><?= $livre->getTitre() ;?></a></td>
        <td class="align-middle"><?= $livre->getNbPages() ;?></td>
        <td class="align-middle"><a href="<?= URL ?>livres/m/<?= $livre->getId() ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form action="<?= URL ?>livres/s/<?= $livre->getId() ?>" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce livre ?')">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="<?= URL ?>livres/a" class="btn btn-success d-block">Ajouter</a>

<?php    
$content = ob_get_clean();
$titre = "Les livres de ma bibliothèque";
require "template.php";
?>    
