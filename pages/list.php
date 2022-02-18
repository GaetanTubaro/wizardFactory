<link href="css/list.css" rel="stylesheet">

<?php
$id_user = $_SESSION["id"];
$searchCharacters = $connection->prepare('SELECT * FROM `character_sheets` WHERE id_user = ? ORDER BY name');
$searchCharacters->bindParam(1, $id_user, PDO::PARAM_STR);
$searchCharacters->execute();
$characters = $searchCharacters->fetchAll(PDO::FETCH_CLASS, Character::class);
?>

<a href="?page=creationCharForm"><button class="btn btn-primary">Créer un nouveau personnage</button></a>

<div class="liste mx-2">
    <?php foreach ($characters as $character) { ?>

        <div class="card mx-2" style="width: 15rem;">
            <a href="?page=details&character=<?= $character->getId() ?>">
                <div class="d-flex flex-column align-items-center" style="height:15rem; width:100%;box-sizing:border-box"><img src="<?= $character->getImg() ?>" class="card-img-top" style="max-height:15rem; max-width:100%;width:auto;height:auto;box-sizing:border-box"></div>
                <div class="card-body">
                    <h2 class="card-title text-center"><?= $character->getName() ?>
                    </h2>
                </div>
            </a>
            <div class="card-footer d-flex justify-content-center">
                <a href="?page=details&character=<?= $character->getId() ?>&type=deleteChar" class="w-100">
                    <button class="btn m-0 p-0 w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </button>
                </a>
            </div>
        </div>
    <?php
    }
    ?>
</div>