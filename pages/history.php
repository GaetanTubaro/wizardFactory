<?php
$rolls = [];

if (isset($_GET['idGame'])) {
    $game = $connection->query('SELECT * FROM games WHERE id =' . $_GET['idGame'])
        ->fetchAll(PDO::FETCH_CLASS, Game::class);
    if ($game[0]->validateMj()) {
        $rolls = $connection->query('SELECT * FROM dice_rolls LEFT JOIN character_sheets ON character_sheets.id = dice_rolls.id_charac WHERE id_game =' . $_GET['idGame'])->fetchAll(PDO::FETCH_CLASS, Dice::class);
    }
} elseif (isset($_GET['idCharac'])) {
    $character = $connection->query('SELECT * FROM character_sheets WHERE id =' . $_GET['idCharac'])
        ->fetchAll(PDO::FETCH_CLASS, Character::class);
    if ($character[0]->getId() == $_SESSION['id']) {
        $rolls = $connection->query('SELECT * FROM dice_rolls JOIN character_sheets ON character_sheets.id = dice_rolls.id_charac WHERE id_charac =' . $_GET['idCharac'])->fetchAll(PDO::FETCH_CLASS, Dice::class);
    }
}

if (empty($rolls)) { ?>
    <div class="d-flex justify-content-center mt-5">
        <p>Aucun lancer de dé ici !</p>
    </div>
<?php
} else { ?>
    <div class="container mt-5">
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
