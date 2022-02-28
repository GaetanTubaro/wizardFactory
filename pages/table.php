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



if (isset($_GET['type'])) {
    if ($game->validateMj()) {
        switch ($_GET['type']) {
        case 'changeName':
            $changeName = 'UPDATE games SET name ="' . $_POST['chgname'] . '" WHERE id=' . $id_game;
            $updateName = $connection->exec($changeName);
            if ($updateName == false || $updateName == 0) {
                return false;
            } else {
                header('location: ?page=table&table=' . $id_game);
            }
            break;
        case 'deleteEquipment':
            $deletedEquipment = new Equipment(['id_equipment' => $_GET['idEquipment']]);
            $deletedEquipment->deleteEquipment($connection);
            header('Location: ?page=table&table=' . $id_game);
            break;
        case 'newEquipment':
            if (isset($_POST['equipment_name']) && isAString($_POST['equipment_name']) && isset($_POST['equipment_range']) && is_numeric($_POST['equipment_range']) && isset($_POST['equipment_damages'])  && is_numeric($_POST['equipment_damages'])) {
                $infosEquipment = array_merge($_POST, ['id_game' => $id_game]);
                $equipmentAdded = new Equipment($infosEquipment);
                $errors = $equipmentAdded->checkData();
                if (empty($errors)) {
                    $equipmentAdded->addEquipment($connection);
                    header('Location: ?page=table&table=' . $id_game);
                } else {
                    foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée
                                valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><?php
                            }
                }
            }
                    break;
                case 'changeEquipment':
                    if (isset($_POST['equipment_name']) && isAString($_POST['equipment_name']) && isset($_POST['equipment_range']) && is_numeric($_POST['equipment_range']) && isset($_POST['equipment_damages'])  && is_numeric($_POST['equipment_damages'])) {
                        $infosEquipment = array_merge($_POST, ['id_equipment' => $_GET['idEquipment'], 'id_game' => $id_game]);
                        $equipmentChange = new Equipment($infosEquipment);
                        $errors = $equipmentChange->checkData();
                        if (empty($errors)) {
                            $equipmentChange->changeEquipment($connection);
                            header('Location: ?page=table&table=' . $id_game);
                        } else {
                            foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée
                                valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><?php
                            }
                        }
                    }
                    break;
                case 'newSkill':
                    if (isset($_POST['skill_name']) && isAString($_POST['skill_name']) && isset($_POST['skill_level']) && is_numeric($_POST['skill_level']) && isset($_POST['skill_stat']) && isAString($_POST['skill_stat']) && isset($id_game)) {
                        $infosSkill = array_merge($_POST, ['id_game' => $id_game]);
                        $skillAdded = new Skill($infosSkill);
                        $errors = $skillAdded->checkData();
                        if (empty($errors)) {
                            $skillAdded->addSkill($connection);
                            header('Location: ?page=table&table=' . $id_game);
                        } else {
                            foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée
                                valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><?php
                            }
                        }
                    }
                    break;
                case 'changeSkill':
                    if (isset($_POST['skill_name']) && isAString($_POST['skill_name']) && isset($_POST['skill_level']) && is_numeric($_POST['skill_level']) && isset($_POST['skill_stat']) && isAString($_POST['skill_stat'])) {
                        $infosSkill = array_merge($_POST, ['id_skill' => $_GET['idSkill'], 'id_game' => $id_game]);
                        $skillChange = new Skill($infosSkill);
                        $errors = $skillChange->checkData();
                        if (empty($errors)) {
                            $skillChange->changeSkill($connection);
                            header('Location: ?page=table&table=' . $id_game);
                        } else {
                            foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée
                                valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

<?php
                            }
                        }
                    }
                    break;
                case 'deleteSkill':

                    $skillToDelete = new Skill(['id_skill' => $_GET['idSkill']]);
                    $sql = 'DELETE FROM game_skill WHERE id_skill=' . $skillToDelete->getId();
                    $connection->exec($sql);
                    $sql = 'DELETE FROM skills WHERE id=' . $skillToDelete->getId();
                    $connection->exec($sql);
                    header('Location: ?page=table&table=' . $id_game);
                    break;
            }
    } else {
        header('Location: ?page=table&table=' . $id_game);
    }
}

        $equipTable = $connection->prepare('SELECT * FROM `equipments` JOIN `game_equipment` ON equipments.id = game_equipment.id_equipment WHERE id_charac IS NULL');
        $equipTable->execute();
        $unequiped = $equipTable->fetchAll(PDO::FETCH_CLASS, Equipment::class);

        $skillTable = $connection->prepare('SELECT * FROM `skills` JOIN `game_skill` ON skills.id = game_skill.id_skill WHERE id_charac IS NULL');
        $skillTable->execute();
        $unskilled = $skillTable->fetchAll(PDO::FETCH_CLASS, Skill::class);
?>

<!--------------------------------- TITRE -------------------------------------->
<h1 class="mx-3 pt-3"><?= $game->getName() ?>
    <button title="Changer le nom de table" class="btn m-1 p-1" data-bs-toggle="modal" data-bs-target="#changeTableName">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
        </svg>
    </button>
</h1>

<!--------------------------------- BOUTONS -------------------------------------->
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="characters-tab" data-bs-toggle="tab" data-bs-target="#characters" type="button" role="tab" aria-controls="characters" aria-selected="true">Personnages</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab" aria-controls="skills" aria-selected="false">Compétences</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="equipments-tab" data-bs-toggle="tab" data-bs-target="#equipments" type="button" role="tab" aria-controls="equipments" aria-selected="false">Equipements</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!--------------------------------- PERSONNAGES -------------------------------------->
        <div class="tab-pane fade show active" id="characters" role="tabpanel" aria-labelledby="characters-tab">
            <div class="mt-4 mx-2 d-flex flex-wrap align-items-stretch">
                <?php foreach ($characters as $character) {
    ;
    $charac_id = $character->getId();
    $pocessChar->execute();
    $pocess = $pocessChar->fetch(); ?>
                    <div class="card mx-2" style="width: 15rem;">

                        <div class="d-flex flex-column align-items-center" style="height:15rem; width:100%;box-sizing:border-box">
                            <a href="?page=details&character=<?= $character->getId() ?>"><img src="<?= $character->getImg() ?>" class="card-img-top" style="max-height:15rem; max-width:100%;width:auto;height:auto;box-sizing:border-box">
                            </a>
                        </div>


                        <div class="card-body d-flex justify-content-center align-items-center">
                            <a href="?page=details&character=<?= $character->getId() ?>">
                                <h2 class="card-title text-center"><?= $character->getName() ?>
                                </h2>
                            </a>
                        </div>
                        <?php if ($pocess) { ?>
                            <h5 class="mx-auto pb-2 text-center">Joué par : <?= $pocess->getPseudo() ?>
                            </h5>
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
                <a title="Créer un personnage" href="?page=creationCharForm&id_game=<?= $id_game ?>">
                    <div class="card card-add mx-2 h-100" style="width:15rem; min-height:15rem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="auto" fill="currentColor" class="bi bi-plus-lg m-auto" viewBox="0 0 16 16">
                            <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <!--------------------------------- COMPETENCES -------------------------------------->
        <div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills-tab">
            <div class="mt-4 mx-2 d-flex flex-wrap align-items-stretch">
                <?php
                if ($unskilled) {
                    foreach ($unskilled as $unskill) {
                        ?>
                        <div class="card mx-2" style="width: 20%;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="m-0 d-inline"><?= $unskill->getName() ?>
                                    </h5>
                                    <span class="ms-auto">
                                        <button class="btn m-1 p-1" data-bs-toggle="modal" data-bs-target="#skillChangeForm<?= $unskill->getId() ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <a href="?page=table&table=<?= $id_game ?>&type=deleteSkill&idSkill=<?= $unskill->getId() ?>"><button class="btn m-1 p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </a>
                                    </span>
                                </div>
                                <p class="card-text mb-1"><span style='font-style:bold'>Niveau :</span> <?= $unskill->getLevel() ?>
                                </p>
                                <p class="card-text mb-1"><span style='font-style:bold'>Stats :</span> <?= $unskill->getStats() ?>
                                </p>
                            </div>
                        </div>
                        <!---------------------------------------------------------->
                        <!----------------- Modal modif skill ----------------->
                        <!---------------------------------------------------------->
                        <div class="modal fade" id="skillChangeForm<?= $unskill->getId() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modifier une compétence</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="changeSkill" action="" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label">Nom</label>
                                                <input type="text" class="form-control" name="skill_name" value="<?= $unskill->getName() ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Niveau</label>
                                                <span class="form-text mt-0 ms-3">Supérieur à 0</span>
                                                <input type="number" class="form-control" name="skill_level" value="<?= $unskill->getLevel() ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Statistique liée</label>
                                                <select class="form-select" name="skill_stat">
                                                    <?php foreach (Skill::POSSIBLE_STATS as $statistique) { ?>
                                                        <option value="<?= $statistique ?>" <?php if ($unskill->getStats() == $statistique) {
                            echo "selected";
                        } ?>><?= $statistique ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <button formaction="?page=table&table=<?= $id_game ?>&type=changeSkill&idSkill=<?= $unskill->getId() ?>" type="submit" class="btn btn-primary">Modifier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin modal modif compétence -->
                <?php
                    }
                }
                ?>
                <button title="Créer une compétence" class="card card-add mx-2 p-4" style="width: 10%; height: auto" data-bs-toggle="modal" data-bs-target="#skillAddForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" fill="currentColor" class="bi bi-plus-lg m-auto" viewBox="0 0 16 16">
                        <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                    </svg>
                </button>
            </div>
        </div>




        <!-------------------------------- Modal Ajout Compétence -------------------------------------->
        <div class="modal fade" id="skillAddForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ajouter une compétence</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="newSkill" action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control" name="skill_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Niveau</label>
                                <span class="form-text mt-0 ms-3">Compris entre 1 et 5</span>
                                <input type="number" class="form-control" name="skill_level" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Statistique liée</label>
                                <select class="form-select" name="skill_stat">
                                    <option value="Force" selected>Force</option>
                                    <option value="Dextérité">Dextérité</option>
                                    <option value="Constitution">Constitution</option>
                                    <option value="Intelligence">Intelligence</option>
                                    <option value="Sagesse">Sagesse</option>
                                    <option value="Chance">Chance</option>
                                </select>
                            </div>
                            <button formaction="?page=table&table=<?= $id_game ?>&type=newSkill" type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--------------------------------- EQUIPEMENTS -------------------------------------->
        <div class="tab-pane fade" id="equipments" role="tabpanel" aria-labelledby="equipments-tab">
            <div class="mt-4 mx-2 d-flex flex-wrap align-items-stretch">
                <?php
                if ($unequiped) {
                    foreach ($unequiped as $unequip) {
                        ?>
                        <div class="card mx-2" style="width: 20%;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="m-0 d-inline"><?= $unequip->getName() ?>
                                    </h5>
                                    <span class="ms-auto">
                                        <button class="btn m-1 p-1" data-bs-toggle="modal" data-bs-target="#equipmentChangeForm<?= $unequip->getId() ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <a href="?page=table&table=<?= $id_game ?>&type=deleteEquipment&idEquipment=<?= $unequip->getId() ?>"><button class="btn m-1 p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </a>
                                    </span>
                                </div>
                                <p class="card-text mb-1"><span style='font-style:bold'>Dégâts :</span> <?= $unequip->getDamages() ?>
                                </p>
                                <p class="card-text mb-1"><span style='font-style:bold'>Portée :</span> <?= $unequip->getRange() ?>
                                </p>
                            </div>
                        </div>

                        <!---------------------------------------------------------->
                        <!----------------- Modal modif equipement ----------------->
                        <!---------------------------------------------------------->
                        <div class="modal fade" id="equipmentChangeForm<?= $unequip->getId() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modifier un équipement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="changeEquipment" action="" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label">Nom</label>
                                                <input type="text" class="form-control" name="equipment_name" value="<?= $unequip->getName() ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Dégâts</label>
                                                <span class="form-text mt-0 ms-3">Supérieur à 0</span>
                                                <input type="number" class="form-control" name="equipment_damages" value="<?= $unequip->getDamages() ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Portée</label>
                                                <span class="form-text mt-0 ms-3">Comprise entre 0 et 5</span>
                                                <input type="number" class="form-control" name="equipment_range" value="<?= $unequip->getRange() ?>" required>
                                            </div>
                                            <button formaction="?page=table&table=<?= $id_game ?>&type=changeEquipment&idEquipment=<?= $unequip->getId() ?>" type="submit" class="btn btn-primary">Modifier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin modal modif equipement -->
                <?php
                    }
                }
                ?>
                <button title="Créer un équipement" class="card card-add mx-2 p-4" style="width: 10%; height: auto" data-bs-toggle="modal" data-bs-target="#equipmentAddForm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" fill="currentColor" class="bi bi-plus-lg m-auto" viewBox="0 0 16 16">
                        <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-------------------------------- Modal Ajout Equipement -------------------------------------->
<div class="modal fade" id="equipmentAddForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter un équipement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="newEquipment" action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="equipment_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dégâts</label>
                        <span class="form-text mt-0 ms-3">Supérieur à 0</span>
                        <input type="number" class="form-control" name="equipment_damages" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Portée</label>
                        <span class="form-text mt-0 ms-3">Comprise entre 0 et 5</span>
                        <input type="number" class="form-control" name="equipment_range" required>
                    </div>
                    <button formaction="?page=table&table=<?= $id_game ?>&type=newEquipment" type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>