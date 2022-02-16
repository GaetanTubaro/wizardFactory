<link href="css/list.css" rel="stylesheet">

<?php
$id_user = 1;
$searchCharacters = $connection->prepare('SELECT name, img, id FROM `character_sheets` WHERE id_user = ? ORDER BY name');
$searchCharacters->bindParam(1, $id_user, PDO::PARAM_STR);
$searchCharacters->execute();
$characters = $searchCharacters->fetchAll(PDO::FETCH_CLASS, Character::class);
?>

<a href="?page=creationCharForm"><button class="btn btn-primary">Créer un nouveau personnage</button></a>

<div class="liste mx-2">
    <?php foreach ($characters as $character) { ?>
        <a href="?page=details&id=<?= $character->getId() ?>"><div class="card mx-2" style="width: 15rem;">
            <img src="<?= $character->getImg() ?>" class="card-img-top">
            <div class="card-body">
                <h2 class="card-title text-center"><?= $character->getName() ?></h2>
            </div>
        </div>
    <?php
    }
    ?>
</div>