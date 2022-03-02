<link href="css/list.css" rel="stylesheet">

<?php

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
} else {
    header('Location: ?page=login');
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            if (isset($_POST['name'])) {
                $addGame = $connection->prepare('INSERT INTO games (name, id_mj) VALUES ("' . $_POST['name'] . '", ' . $id_user . ');');
                $addGame->execute();
                header('Location: ?page=list');
            }
            break;
        case 'delete':
            if (isset($_GET['game'])) {
                $findGameToDelete = $connection->query('SELECT * FROM games WHERE id = ' . $_GET['game']);
                $findGameToDelete->setFetchMode(PDO::FETCH_CLASS, Game::class);
                $deletedGame = $findGameToDelete->fetch();
                if ($deletedGame->validateMj()) {
                    $deletedGame->deleteTable($connection);
                }
                header('Location: ?page=list');
            }
            break;
        case 'changeMj':
            if (isset($_POST['idMj'])) {
                $findGameToChange = $connection->query('SELECT * FROM games WHERE id = ' . $_GET['game']);
                $findGameToChange->setFetchMode(PDO::FETCH_CLASS, Game::class);
                $changedGame = $findGameToChange->fetch();
                if ($changedGame->validateMj()) {
                    $findUser = $connection->prepare('SELECT id, pseudo FROM users WHERE pseudo LIKE "' . $_POST['idMj'] . '"');
                    $findUser->setFetchMode(PDO::FETCH_CLASS, Users::class);
                    $findUser->execute();
                    $user = $findUser->fetch();
                    if ($user == false || $user == 0) {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Joueur inconnu ou pseudo incorrect.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php
                    } else {
                        $changeRequestMj = 'UPDATE games SET id_mj =' . $user->getId() . ' WHERE id=' . $_GET['game'];
                        $changeMj = $connection->exec($changeRequestMj);
                        header('Location: ?page=list');
                    }
                } else {
                    header('Location: ?page=list');
                }
            }
            break;
    }
}


$findGames = $connection->prepare('SELECT * FROM games WHERE id_mj = :id');
$findGames->bindParam(':id', $id_user, PDO::PARAM_INT);
$findGames->execute();
$games = $findGames->fetchAll(PDO::FETCH_CLASS, Game::class);

$findGamesPlayer = $connection->prepare('SELECT games.name AS game_name, character_sheets.name AS character_name, character_sheets.id AS character_id FROM games
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
                        <th scope="col">Opérations
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
                            <td><a href="?page=table&table=<?= $game->getId() ?>"><?= $game->getName() ?></a></td>
                            <td>
                                <ul class="mb-0 ps-0"><?php foreach ($players as $player) { ?>
                                        <li><?= $player->getPseudo() ?></li><?php } ?>
                                </ul>
                            </td>
                            <td>
                                <button title="Jouer" class="btn" data-bs-toggle="modal" data-bs-target="#play<?= $game_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dice-6" viewBox="0 0 16 16">
                                        <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z" />
                                        <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-8 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg></button>
                                <button title="Changer le Mj de la partie" class="btn" data-bs-toggle="modal" data-bs-target="#changeTableMj<?= $game_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                    </svg></button>
                                <button title="Supprimer la partie" class="btn" data-bs-toggle="modal" data-bs-target="#deleteTable<?= $game_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></button>
                            </td>
                        </tr>
                        <!--------------------------------------------------------------------------------------------------------------------------->
                        <!------------------------------------------------- Modal suppresion -------------------------------------------------------->
                        <!--------------------------------------------------------------------------------------------------------------------------->
                        <div class="modal" id="deleteTable<?= $game_id ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Supprimer ?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Êtes-vous sûr de vouloir supprimer cette table ? Cela supprimera également tous les personnages, équipements et compétences liés. Cette décision est irréversible.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                                        <a href="?page=list&action=delete&game=<?= $game->getId() ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ----------------------------------------------------------------------------------------------------------- -->
                        <!----------------------------------------- Modal Change Mj Table Start ------------------------------------------->
                        <!-- ----------------------------------------------------------------------------------------------------------- -->
                        <div class="modal fade" id="changeTableMj<?= $game_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Changer le Mj de cette partie</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST">
                                            <input type="text" class="form-control mb-3" name="idMj" required>
                                            <button formaction="?page=list&action=changeMj&game=<?= $game->getId() ?>" type="submit" class="btn btn-primary">Modifier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ----------------------------------------------------------------------------------------------------------- -->
                        <!----------------------------------------- Modal Change MJ Table End --------------------------------------------->
                        <!-- ----------------------------------------------------------------------------------------------------------- -->
                    <?php
                    } ?>
                    <tr>
                        <td colspan=3 class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGame">
                                Nouvelle table
                            </button>
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
                        <th scope="col">Opérations
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($gamesPlayer as $game) { ?>
                        <tr>
                            <td><?= $game['game_name'] ?></td>
                            <td><a href="?page=details&character=<?= $game['character_id'] ?>"><?= $game['character_name'] ?></a></td>
                            <td><button title="Jouer" class="btn" data-bs-toggle="modal" data-bs-target="#playtable<?= $game_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dice-6" viewBox="0 0 16 16">
                                        <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z" />
                                        <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-8 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg></button>
                                <a href="?page=history&idCharac=<?= $game['character_id'] ?>"><button title="Historique" class="btn" data-bs-toggle="modal" data-bs-target="#historyRoll<?= $game_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                                        <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                                    </svg></button></a>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!----------------------------------------------------------------------------------------------------------------->
<!------------------------ Modal création table Start ------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="addGame" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Créer une table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <label class="form-label">Nom de la table</label>
                    <input type="text" class="form-control" name="name" required>
                    <button formaction="?page=list&action=add" type="submit" class="btn btn-primary mt-3">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------------------------->
<!------------------------ Modal création table End --------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------->