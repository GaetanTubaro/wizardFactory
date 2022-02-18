<link href="css/list.css" rel="stylesheet">

<?php
$id_user = $_SESSION["id"];
$searchCharacters = $connection->prepare('SELECT * FROM `character_sheets` WHERE id_user = ? ORDER BY name');
$searchCharacters->bindParam(1, $id_user, PDO::PARAM_STR);
$searchCharacters->execute();
$characters = $searchCharacters->fetchAll(PDO::FETCH_CLASS, Character::class);
?>

<div class="mt-4 mx-2 d-flex flex-wrap align-items-stretch">
    <?php foreach ($characters as $character) { ?>

        <div class="card mx-2" style="width: 15rem;">

            <div class="d-flex flex-column align-items-center" style="height:15rem; width:100%;box-sizing:border-box">
                <a href="?page=details&character=<?= $character->getId() ?>"><img src="<?= $character->getImg() ?>" class="card-img-top" style="max-height:15rem; max-width:100%;width:auto;height:auto;box-sizing:border-box">
            </div>

            </a>
            <div class="card-body d-flex justify-content-center align-items-center">
                <a href="?page=details&character=<?= $character->getId() ?>">
                    <h2 class="card-title text-center"><?= $character->getName() ?>
                    </h2>
                </a>
            </div>
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
    <a href="?page=creationCharForm">
        <div class="card card-add mx-2 h-100" style="width:15rem; min-height:15rem">
            <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="auto" fill="currentColor" class="bi bi-plus-lg m-auto" viewBox="0 0 16 16">
                <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
            </svg>
        </div>
    </a>
</div>