<?php
$rolls = [];

if (isset($_GET['idGame'])) {
    $findGame = $connection->query('SELECT * FROM games WHERE id =' . $_GET['idGame']);
    $findGame->setFetchMode(PDO::FETCH_CLASS, Game::class);
    $game = $findGame->fetch();
    $game_id = $game->getId();
    $game_name = $game->getName();
    if ($game->validateMj()) {
        $rolls = $connection->query('SELECT * FROM dice_rolls LEFT JOIN character_sheets ON character_sheets.id = dice_rolls.id_charac WHERE id_game =' . $_GET['idGame'])->fetchAll(PDO::FETCH_CLASS, Dice::class);
    }
} elseif (isset($_GET['idCharac'])) {
    $findCharacter = $connection->query('SELECT character_sheets.*, game_character.id_game, game_character.id_user, games.name as game_name FROM character_sheets LEFT JOIN game_character ON character_sheets.id = game_character.id_charac LEFT JOIN games ON games.id = game_character.id_game WHERE character_sheets.id =' . $_GET['idCharac']);
    $findCharacter->setFetchMode(PDO::FETCH_CLASS, Character::class);
    $character = $findCharacter->fetch();
    $game_id = $character->getId_game();
    $game_name = $character->game_name;
    if ($character->getId_user() == $_SESSION['id']) {
        $rolls = $connection->query('SELECT * FROM dice_rolls JOIN character_sheets ON character_sheets.id = dice_rolls.id_charac WHERE id_charac =' . $_GET['idCharac'])->fetchAll(PDO::FETCH_CLASS, Dice::class);
    }
}?>

<nav class="mt-4 ms-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?page=list">Liste des tables</a></li>
                <li class="breadcrumb-item"><a href="?page=table&table=<?= $game_id ?>"><?= $game_name ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Historique des lancers</li>
            </ol>
        </nav>

<?php
if (empty($rolls)) { ?>
    <div class="d-flex justify-content-center mt-4">
        <p>Aucun lancer de dé ici !</p>
    </div>
<?php
} else { ?>
    <div class="container mt-4">
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Personnage</th>
                <th scope="col">Nombre de faces</th>
                <th scope="col">Résultat</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody> <?php
                foreach ($rolls as $roll) { ?>
                <tr>
                    <td><?php if (isset($roll->name)) {
                    echo $roll->name;
                } else {
                    echo "Aucun";
                } ?></td>
                    <td>
                        <?= $roll->getSides() ?>
                    </td>
                    <td>
                        <?= $roll->getResult() ?>
                    </td>
                    <td>
                        <?= $roll->getDate_roll() ?>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php }
