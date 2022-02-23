<link href="css/table.css" rel="stylesheet">

<?php

$id_game = $_GET["table"];
$searchGame = $connection->prepare('SELECT * FROM `games` WHERE id = ?');
$searchGame->bindParam(1, $id_game, PDO::PARAM_STR);
$searchGame->setFetchMode(PDO::FETCH_CLASS, Game::class);
$searchGame->execute();
$game = $searchGame->fetch();

$id_game = $game->getId();
$gameChar = $connection->prepare('SELECT * FROM `character_sheets` JOIN `game_character` ON  character_sheets.id = game_character.id_charac WHERE id_game =' . $game->getId());
$gameChar->execute();
$characters = $gameChar->fetchAll(PDO::FETCH_CLASS, Character::class);

$pocessChar = $connection->prepare('SELECT * FROM `users` JOIN `game_character` ON  users.id = game_character.id_user WHERE id_charac = :id AND id_game =' . $game->getId());
$pocessChar->setFetchMode(PDO::FETCH_CLASS, Users::class);
$pocessChar->bindParam(":id", $charac_id);
?>

<h1 class="mx-3 pt-3">Personnages de la partie : <?= $game->getName() ?>.</h1>
<div class="mt-4 mx-2 d-flex flex-wrap align-items-stretch">
    <?php foreach ($characters as $character) {;
        $charac_id = $character->getId();
        $pocessChar->execute();
        $pocess = $pocessChar->fetch(); ?>
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
            <?php if ($pocess) { ?>
                <h5 class="mx-auto pb-2">Joué par : <?= $pocess->getPseudo() ?></h5>
            <?php } else { ?>
                <h5 class="mx-auto pb-2">Non affilié</h5>
            <?php } ?>
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
    <a href="?page=creationCharForm&id_game=<?= $id_game ?>">
        <div class="card card-add mx-2 h-100" style="width:15rem; min-height:15rem">
            <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="auto" fill="currentColor" class="bi bi-plus-lg m-auto" viewBox="0 0 16 16">
                <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
            </svg>
        </div>
    </a>
</div>