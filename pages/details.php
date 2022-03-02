<link href="css/details.css" rel="stylesheet">

<?php if (isset($_GET["character"])) {
    $id_character = $_GET["character"];
} else {
    header('Location: ?page=list');
}

$findCharacter = $connection->prepare('SELECT character_sheets.*, game_character.id_game, game_character.id_user, games.id_mj, games.name AS game_name FROM `character_sheets`
JOIN game_character ON character_sheets.id = game_character.id_charac
JOIN games ON game_character.id_game = games.id
WHERE character_sheets.id = ?');
$findCharacter->bindParam(1, $id_character, PDO::PARAM_STR);
$findCharacter->setFetchMode(PDO::FETCH_CLASS, Character::class);
$findCharacter->execute();
$character = $findCharacter->fetch();

if (isset($_GET['type'])) {
    if ($character->id_mj == $_SESSION['id']) {
        switch ($_GET['type']) {
            case 'newSkill':
                if (isset($_POST['skill_name']) && isAString($_POST['skill_name']) && isset($_POST['skill_level']) && is_numeric($_POST['skill_level']) && isset($_POST['skill_stat'])) {
                    $infoSkill = array_merge($_POST, ['id_character' => $id_character, 'id_game' => $character->getId_game()]);
                    $skillAdded = new Skill($infoSkill);
                    $errors = $skillAdded->checkData();
                    if (empty($errors)) {
                        $skillAdded->addSkill($connection);
                        header('Location: ?page=details&character=' . $id_character);
                    } else {
                        foreach ($errors as $error) {
                            ?>
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
            case 'addSkill':
                if (isset($_POST['idSkill'])) {
                    $connection->exec('UPDATE skills SET id_charac = ' . $id_character . ' WHERE id = ' . $_POST['idSkill']);
                }
                break;
            case 'changeSkill':
                if (isset($_POST['skill_name']) && isAString($_POST['skill_name']) && isset($_POST['skill_level']) && is_numeric($_POST['skill_level']) && isset($_POST['skill_stat'])) {
                    $infoSkill = array_merge($_POST, ['id_character' => $id_character, 'id_skill' => $_GET['idSkill'], 'id_game' => $character->getId_game()]);
                    $skillChange = new Skill($infoSkill);
                    $errors = $skillChange->checkData();
                    if (empty($errors)) {
                        $skillChange->changeSkill($connection);
                        header('Location: ?page=details&character=' . $id_character);
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
                    case 'deleteSkill':
                        $deletedSkill = new Skill(['id_skill' => $_GET['idSkill']]);
                        $sql = 'UPDATE skills SET id_charac = NULL WHERE id=' . $deletedSkill->getId();
                        $connection->exec($sql);
                        header('Location: ?page=details&character=' . $id_character);
                        break;
                    case 'newEquipment':
                        if (isset($_POST['equipment_name']) && isAString($_POST['equipment_name']) && isset($_POST['equipment_range']) && is_numeric($_POST['equipment_range']) && isset($_POST['equipment_damages'])  && is_numeric($_POST['equipment_damages'])) {
                            $infosEquipment = array_merge($_POST, ['id_character' => $id_character, 'id_game' => $character->getId_game()]);
                            $equipmentAdded = new Equipment($infosEquipment);
                            $errors = $equipmentAdded->checkData();
                            if (empty($errors)) {
                                $equipmentAdded->addEquipment($connection);
                                header('Location: ?page=details&character=' . $id_character);
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
                    case 'addEquipment':
                        if (isset($_POST['idEquipment'])) {
                            $connection->exec('UPDATE equipments SET id_charac = ' . $id_character . ' WHERE id = ' . $_POST['idEquipment']);
                        }
                        break;
                    case 'changeEquipment':
                        if (isset($_POST['equipment_name']) && isAString($_POST['equipment_name']) && isset($_POST['equipment_range']) && is_numeric($_POST['equipment_range']) && isset($_POST['equipment_damages'])  && is_numeric($_POST['equipment_damages'])) {
                            $infosEquipment = array_merge($_POST, ['id_equipment' => $_GET['idEquipment'], 'id_game' => $character->getId_game()]);
                            $equipmentChange = new Equipment($infosEquipment);
                            $errors = $equipmentChange->checkData();
                            if (empty($errors)) {
                                $equipmentChange->changeEquipment($connection);
                                header('Location: ?page=details&character=' . $id_character);
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
                    case 'deleteEquipment':
                        $deletedEquipment = new Equipment(['id_equipment' => $_GET['idEquipment']]);
                        $sql = 'UPDATE equipments SET id_charac = NULL WHERE id=' . $deletedEquipment->getId();
                        $connection->exec($sql);
                        header('Location: ?page=details&character=' . $id_character);
                        break;
                    case 'charChange':
                        if (isset($_POST['name']) && isset($_POST['currentHp']) && isset($_POST['hpMax']) && isset($_POST['mpMax']) && isset($_POST['currentMp']) && isset($_POST['init']) && isset($_POST['strength']) && isset($_POST['dexterity']) && isset($_POST['constitution']) && isset($_POST['intelligence']) && isset($_POST['wisdom']) && isset($_POST['luck'])) {
                            $changeChar = new Character($_POST);
                            $changeChar->checkImg($_POST['img']);
                            $errorChar = $changeChar->validateInt();
                            if (empty($errorChar)) {
                                $changeChar->updateChar($connection, $id_character);
                                header('Location: ?page=details&character=' . $id_character);
                            } else {
                                foreach ($errorChar as $error) { ?>
                            <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                                <p class="mb-0">Oups ! <?= $error ?>. Veuillez entrer une donnée
                                    valide.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div><?php
                                }
                            }
                        }
                        break;
                    case 'deleteChar':
                        $character->deleteChar($connection);
                        header('Location: ?page=table&table=' . $character->getId_game());
                        break;
                    case 'changePlayer':
                        if (isset($_POST['chgPlayer'])) {
                            $newPlayer = new Users();
                            $newPlayer->setPseudo($_POST['chgPlayer']);
                            $newPlayer->linkUserToChar($connection, $id_character);
                        }
                        break;
                }
    } else {
        header('Location: ?page=details&character=' . $id_character);
    }
} ?>

<div class="container-fluid px-5 mt-4">
    <div class="row d-flex justify-content-center align-items-start">
        <nav class="mb-3" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?page=list">Liste des tables</a></li>
                <li class="breadcrumb-item"><a href="?page=table&table=<?= $character->getId_game() ?>"><?= $character->game_name ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $character->getName() ?></li>
            </ol>
        </nav>

        <?php
        include "includes/character_stats.php";
        include "includes/character_skills.php";
        include "includes/character_equipments.php";
        ?>
    </div>
</div>
</div>