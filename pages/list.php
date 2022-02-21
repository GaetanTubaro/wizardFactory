<link href="css/list.css" rel="stylesheet">

<?php
$id_user = $_SESSION['id'];

$findGames = $connection->prepare('SELECT * FROM games WHERE id_mj = :id');
$findGames->bindParam(':id', $id_user, PDO::PARAM_INT);
$findGames->execute();
$games = $findGames->fetchAll(PDO::FETCH_CLASS, Game::class);

$findGamesPlayer = $connection->prepare('SELECT games.name AS game_name, character_sheets.name AS character_name FROM games
INNER JOIN game_character ON games.id = game_character.id_game
INNER JOIN character_sheets ON character_sheets.id = game_character.id_charac WHERE id_user = :id');
$findGamesPlayer->bindParam(':id', $id_user, PDO::PARAM_INT);
$findGamesPlayer->execute();
$gamesPlayer = $findGamesPlayer->fetchAll();

$findPlayers = $connection->prepare('SELECT pseudo FROM users LEFT JOIN game_character ON users.id = game_character.id_user WHERE game_character.id_game = :id');
$findPlayers->bindParam(':id', $game_id);
?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-6 ps-4">
            <h1 class="text-center">Mes parties MJ</h1>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Nom de la table</th>
                        <th scope="col">Participants</th>
                        <th scope="col">Supprimer
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($games as $game) {
                        $game_id = $game->getId();
                        $findPlayers->execute();
                        $players = $findPlayers->fetchAll(PDO::FETCH_CLASS, Users::class) ?>
                        <tr>
                            <td><?= $game->getName() ?></td>
                            <td>
                                <ul class="mb-0 ps-0"><?php foreach ($players as $player) { ?>
                                        <li><?= $player->getPseudo() ?></li><?php } ?>
                                </ul>
                            </td>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </td>
                        </tr>
                    <?php
                    } ?>
                    <tr>
                        <td colspan=3 class="text-center">
                            Nouvelle table
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-6 pe-4">
            <h1 class="text-center">Mes parties Joueur</h1>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Nom de la table</th>
                        <th scope="col">Personnage joué</th>
                        <th scope="col">Supprimer
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($gamesPlayer as $game) { ?>
                        <tr>
                            <td><?= $game['game_name'] ?></td>
                            <td><?= $game['character_name'] ?></td>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>