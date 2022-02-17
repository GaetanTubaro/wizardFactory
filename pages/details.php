<?php

//Récupération du personnage et de ses compétences
if (isset($_GET["character"])) {
    $id_character = $_GET["character"];
} else {
    $id_character = 1;
}
$findCharacter = $connection->prepare('SELECT * FROM `character_sheets` WHERE id = ?');
$findCharacter->bindParam(1, $id_character, PDO::PARAM_STR);
$findCharacter->setFetchMode(PDO::FETCH_CLASS, Character::class);
$findCharacter->execute();
$character = $findCharacter->fetch();

$findSkills = $connection->prepare('SELECT * FROM `skills` WHERE id_charac = ?');
$findSkills->bindParam(1, $id_character, PDO::PARAM_STR);
$findSkills->execute();
$skills = $findSkills->fetchAll(PDO::FETCH_CLASS, Skill::class);

$findEquipments = $connection->prepare('SELECT * FROM `equipments` WHERE id_charac = ?');
$findEquipments->bindParam(1, $id_character, PDO::PARAM_STR);
$findEquipments->execute();
$equipments = $findEquipments->fetchAll(PDO::FETCH_CLASS, Equipment::class);
//

if (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'addSkill':
            if (isset($_POST['skill_name']) && isAString($_POST['skill_name']) && isset($_POST['skill_level']) && is_numeric($_POST['skill_level']) && isset($_POST['skill_stat'])) {
                $skillAdded = new Skill();
                $skillAdded
                    ->setName($_POST['skill_name'])
                    ->setLevel($_POST['skill_level'])
                    ->setStats($_POST['skill_stat'])
                    ->setOwner($id_character);
                $errors = $skillAdded->checkData();
                if (empty($errors)) {
                    $addSkill = $connection->prepare('INSERT INTO skills (name, stats, level, id_charac) VALUES ("' . $skillAdded->getName() . '","' . $skillAdded->getStats() . '",' . $skillAdded->getLevel() . ',' . $skillAdded->getOwner() . ')');
                    $addSkill->execute();
                    header('Location: ?page=details&character=' . $id_character);
                } else {
                    foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><?php
                            }
                        }
                    }
                    break;
                case 'changeSkill':
                    if (isset($_POST['skill_name']) && isAString($_POST['skill_name']) && isset($_POST['skill_level']) && is_numeric($_POST['skill_level']) && isset($_POST['skill_stat'])) {
                        $skillChange = new Skill();
                        $skillChange
                            ->setId($_GET['idSkill'])
                            ->setName($_POST['skill_name'])
                            ->setLevel($_POST['skill_level'])
                            ->setStats($_POST['skill_stat'])
                            ->setOwner($id_character);
                        $errors = $skillChange->checkData();
                        if (empty($errors)) {
                            $changeSkill = $connection->prepare('UPDATE skills SET name = "' . $skillChange->getName() . '", level = ' . $skillChange->getLevel() . ', stats = "' . $skillChange->getStats() . '" WHERE id =' . $skillChange->getId());
                            $changeSkill->execute();
                            header('Location: ?page=details&character=' . $id_character);
                        } else {
                            foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><?php
                            }
                        }
                    }
                    break;
                case 'deleteSkill':
                    $deleteSkill = $connection->prepare('DELETE FROM skills WHERE id=' . $_GET['idSkill']);
                    $deleteSkill->execute();
                    header('Location: ?page=details&character=' . $id_character);
                    break;
                case 'addEquipment':
                    if (isset($_POST['equipment_name']) && isAString($_POST['equipment_name']) && isset($_POST['equipment_range']) && is_numeric($_POST['equipment_range']) && isset($_POST['equipment_damages'])  && is_numeric($_POST['equipment_damages'])) {
                        $equipmentAdded = new Equipment();
                        $equipmentAdded
                            ->setName($_POST['equipment_name'])
                            ->setDamages($_POST['equipment_damages'])
                            ->setRange($_POST['equipment_range'])
                            ->setOwner($id_character);
                        $errors = $equipmentAdded->checkData();
                        if (empty($errors)) {
                            $addEquipment = $connection->prepare('INSERT INTO equipments (name, damages, range_area, id_charac) VALUES ("' . $equipmentAdded->getName() . '","' . $equipmentAdded->getDamages() . '",' . $equipmentAdded->getRange() . ',' . $equipmentAdded->getOwner() . ')');
                            $addEquipment->execute();
                            header('Location: ?page=details&character=' . $id_character);
                        } else {
                            foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><?php
                            }
                        }
                    }
                    break;
                case 'changeEquipment':
                    if (isset($_POST['equipment_name']) && isAString($_POST['equipment_name']) && isset($_POST['equipment_range']) && is_numeric($_POST['equipment_range']) && isset($_POST['equipment_damages'])  && is_numeric($_POST['equipment_damages'])) {
                        $equipmentChange = new Equipment();
                        $equipmentChange
                            ->setName($_POST['equipment_name'])
                            ->setDamages($_POST['equipment_damages'])
                            ->setRange($_POST['equipment_range'])
                            ->setOwner($id_character);
                        $errors = $equipmentChange->checkData();
                        if (empty($errors)) {
                            $changeEquipment = $connection->prepare('UPDATE equipments SET name ="' . $equipmentChange->getName() . '", damages =' . $equipmentChange->getDamages() . ', range_area =' . $equipmentChange->getRange() . ' WHERE id=' . $_GET['idEquipment']);
                            $changeEquipment->execute();
                            header('Location: ?page=details&character=' . $id_character);
                        } else {
                            foreach ($errors as $error) { ?>
                        <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                            <p class="mb-0">Oups ! <?= $error ?> Veuillez entrer une donnée valide.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><?php
                            }
                        }
                    }
                    break;
                case 'charChange':
                    if (isset($_POST['name']) && isset($_POST['currentHp']) && isset($_POST['hpMax']) && isset($_POST['mpMax']) && isset($_POST['currentMp']) && isset($_POST['init']) && isset($_POST['strength']) && isset($_POST['dexterity']) && isset($_POST['constitution']) && isset($_POST['intelligence']) && isset($_POST['wisdom']) && isset($_POST['luck'])) {
                        $changeChar = new Character($_POST);
                        $changeChar->checkImg($_POST['img']);
                        $errorChar = $changeChar->validateInt();
                        if (empty($errorChar) && $changeChar->validateName()) {
                            $requestChange = $connection->prepare("UPDATE `character_sheets` SET name = '" . $changeChar->getName() . "', currentHp = " . $changeChar->getCurrentHp() . ", currentMp = " . $changeChar->getCurrentMp() . ", hpMax = " . $changeChar->getHpMax() . ", initiative = " . $changeChar->getInit() . ", strength = " . $changeChar->getStrength() . ", dexterity = " . $changeChar->getDexterity() . ", mpMax = " . $changeChar->getMpMax() . ", constitution = " . $changeChar->getConstitution() . ", intelligence = " . $changeChar->getIntelligence() . ", wisdom = " . $changeChar->getWisdom() . ", luck = " . $changeChar->getLuck() . ", img = '" . $changeChar->getImg() . "' WHERE id =" . $id_character);
                            $requestChange->execute();
                            header('Location: ?page=details&character=' . $id_character);
                        }
                    }
                    break;
            }
        }
                                ?>

<link href="css/details.css" rel="stylesheet">

<div class="container-fluid p-5">
    <div class="row d-flex justify-content-center align-items-start">
        <div class="col-3 d-flex justify-content-center align-items-center">
            <img class="img-fluid" src="<?= $character->getImg() ?>">
        </div>
        <div class="col-6">
            <div class="row d-flex justify-content-space-between">
                <h1 class="col-6"><?= $character->getName() ?></h1>
                <span class="col-6">
                    <button class="btn m-1 p-1" data-bs-toggle="modal" data-bs-target="#charChangeForm<?= $character->getId() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                    </button>
                    <button class="btn m-1 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </button>
                </span>
            </div>
            <div class="row">
                <div class="col-6">
                    <h2 class="stat">Points de Vie</h2>
                    <p class="ms-3"><?= $character->getCurrentHp() . " / " . $character->getHpMax() ?></p>
                    <h2 class="stat">Force</h2>
                    <p class="ms-3"><?= $character->getStrength() ?></p>
                    <h2 class="stat">Dextérité</h2>
                    <p class="ms-3"><?= $character->getDexterity() ?></p>
                    <h2 class="stat">Constitution</h2>
                    <p class="ms-3"><?= $character->getConstitution() ?></p>
                    <h2 class="stat">Initiative</h2>
                    <p class="ms-3"><?= $character->getInit() ?></p>
                </div>
                <div class="col-6">
                    <h2 class="stat">Points de Magie</h2>
                    <p class="ms-3"><?= $character->getCurrentMp() . " / " . $character->getMpMax() ?></p>
                    <h2 class="stat">Intelligence</h2>
                    <p class="ms-3"><?= $character->getIntelligence() ?></p>
                    <h2 class="stat">Sagesse</h2>
                    <p class="ms-3"><?= $character->getWisdom() ?></p>
                    <h2 class="stat">Chance</h2>
                    <p class="ms-3"><?= $character->getLuck() ?></p>
                </div>
            </div>
        </div>
    </div>
    <<<<<<< HEAD <div class="row mt-4 d-flex justify-content-center">
        <div class="col-4 d-flex flex-column">
            =======
            <!-- ----------------------------------------------------------------------------------------------------- -->
            <!-----------------------------------début modal modif character------------------------------------------ -->
            <!-- ----------------------------------------------------------------------------------------------------- -->
            <div class="modal fade" id="charChangeForm<?= $character->getId() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modifier Personnage</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form name="changeChar" action="" method="POST">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nom</label>
                                            <input type="text" class="form-control" name="name" value="<?= $character->getName() ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Point de vie</label>
                                            <input type="number" class="form-control" name="currentHp" value="<?= $character->getCurrentHp() ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Point de mana</label>
                                            <input type="number" class="form-control" name="currentMp" value="<?= $character->getCurrentMp() ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Initiative</label>
                                            <input type="number" class="form-control" name="init" value="<?= $character->getInit() ?>" required>
                                            <span class="form-text mt-0 ms-3">Maximum 10</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Point de vie total</label>
                                            <input type="number" class="form-control" name="hpMax" value="<?= $character->getHpMax() ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Force</label>
                                            <input type="number" class="form-control" name="strength" value="<?= $character->getStrength() ?>" required>
                                            <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Dextérité</label>
                                            <input type="number" class="form-control" name="dexterity" value="<?= $character->getDexterity() ?>" required>
                                            <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Constitution</label>
                                            <input type="number" class="form-control" name="constitution" value="<?= $character->getConstitution() ?>" required>
                                            <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Point de mana total</label>
                                            <input type="number" class="form-control" name="mpMax" value="<?= $character->getMpMax() ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Intélligence</label>
                                            <input type="number" class="form-control" name="intelligence" value="<?= $character->getIntelligence() ?>" required>
                                            <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sagesse</label>
                                            <input type="number" class="form-control" name="wisdom" value="<?= $character->getWisdom() ?>" required>
                                            <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Chance</label>
                                            <input type="number" class="form-control" name="luck" value="<?= $character->getLuck() ?>" required>
                                            <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="text" class="form-control" name="img" value="<?= $character->getImg() ?>" required>
                                    </div>
                                </div>
                                <button formaction="?page=details&character=<?= $id_character ?>&type=charChange" type="submit" class="btn btn-primary">Modifier</button></formaction=>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ----------------------------------------------------------------------------------------------------- -->
            <!---------------------------------------fin modal modif character ------------------------------------------>
            <!-- ----------------------------------------------------------------------------------------------------- -->
            <div class="row mt-4 d-flex justify-content-center align-items-start">
                <div class="col-4">
                    >>>>>>> b9a6ea8 (n5 ajout fonctionnalité modification fiche perso)
                    <h2>Compétences</h2>
                    <?php foreach ($skills as $skill) { ?>
                        <div class="card mb-3" style="width: 100%;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="m-0 d-inline"><?= $skill->getName() ?></h5>
                                    <span class="ms-auto">
                                        <button class="btn m-1 p-1" data-bs-toggle="modal" data-bs-target="#skillChangeForm<?= $skill->getId() ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <a href="?page=details&character=<?= $_GET['character'] ?>&type=deleteSkill&idSkill=<?= $skill->getId() ?>"><button class="btn m-1 p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button></a>
                                    </span>
                                </div>
                                <p class="card-text mb-1"><span style='font-style:bold'>Statistique liée :</span> <?= $skill->getStats() ?></p>
                                <p class="card-text mb-1"><span style='font-style:bold'>Niveau :</span> <?= $skill->getLevel() ?></p>
                            </div>
                        </div>

                        <!---------------------------------------------------------->
                        <!----------------- Modal modif compétence ----------------->
                        <!---------------------------------------------------------->
                        <div class="modal fade" id="skillChangeForm<?= $skill->getId() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                <input type="text" class="form-control" name="skill_name" value="<?= $skill->getName() ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Statistique liée</label>
                                                <select class="form-select" name="skill_stat">
                                                    <?php foreach (Skill::POSSIBLE_STATS as $statistique) { ?>
                                                        <option value="<?= $statistique ?>" <?php if ($skill->getStats() == $statistique) {
                                                                                                echo "selected";
                                                                                            } ?>><?= $statistique ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Niveau</label>
                                                <span class="form-text mt-0 ms-3">Compris entre 0 et 5</span>
                                                <input type="number" class="form-control" name="skill_level" value="<?= $skill->getLevel() ?>" required>
                                            </div>
                                            <button formaction="?page=details&character=<?= $id_character ?>&type=changeSkill&idSkill=<?= $skill->getId() ?>" type="submit" class="btn btn-primary">Modifier</button></formaction=>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin modal modif compétence -->

                    <?php } ?>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#skillAddForm">Créer une nouvelle compétence</button>

                    <!---------------------------------------------------------->
                    <!-------------- Modal de création compétence -------------->
                    <!---------------------------------------------------------->
                    <div class="modal fade" id="skillAddForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Ajouter une compétence</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form name="addSkill" action="" method="POST">
                                        <div class="mb-3">
                                            <label class="form-label">Nom</label>
                                            <input type="text" class="form-control" name="skill_name" required>
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
                                        <div class="mb-3">
                                            <label class="form-label">Niveau</label>
                                            <span class="form-text mt-0 ms-3">Compris entre 0 et 5</span>
                                            <input type="number" class="form-control" name="skill_level" required>
                                        </div>
                                        <button formaction="?page=details&character=<?= $id_character ?>&type=addSkill" type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Modal de création compétence -->

                </div>
                <div class="col-4 d-flex flex-column">
                    <h2>Equipements</h2>
                    <?php foreach ($equipments as $equipment) { ?>
                        <div class="card mb-3" style="width: 100%;">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="m-0 d-inline"><?= $equipment->getName() ?></h5>
                                    <span class="ms-auto">
                                        <button class="btn m-1 p-1" data-bs-toggle="modal" data-bs-target="#equipmentChangeForm<?= $equipment->getId() ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <a href="?page=details&character=<?= $_GET['character'] ?>&type=deleteEquipment&idEquipment=<?= $equipment->getId() ?>"><button class="btn m-1 p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button></a>
                                    </span>
                                </div>
                                <p class="card-text mb-1"><span style='font-style:bold'>Dégâts :</span> <?= $equipment->getDamages() ?></p>
                                <p class="card-text mb-1"><span style='font-style:bold'>Portée :</span> <?= $equipment->getRange() ?></p>
                            </div>
                        </div>

                        <!---------------------------------------------------------->
                        <!----------------- Modal modif equipement ----------------->
                        <!---------------------------------------------------------->
                        <div class="modal fade" id="equipmentChangeForm<?= $equipment->getId() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                <input type="text" class="form-control" name="equipment_name" value="<?= $equipment->getName() ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Dégâts</label>
                                                <span class="form-text mt-0 ms-3">Supérieur à 0</span>
                                                <input type="number" class="form-control" name="equipment_damages" value="<?= $equipment->getDamages() ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Portée</label>
                                                <span class="form-text mt-0 ms-3">Comprise entre 0 et 5</span>
                                                <input type="number" class="form-control" name="equipment_range" value="<?= $equipment->getRange() ?>" required>
                                            </div>
                                            <button formaction="?page=details&character=<?= $id_character ?>&type=changeEquipment&idEquipment=<?= $equipment->getId() ?>" type="submit" class="btn btn-primary">Modifier</button></formaction=>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin modal modif compétence -->
                    <?php } ?>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#equipmentAddForm">Créer un nouvel équipement</button>

                    <!---------------------------------------------------------->
                    <!-------------- Modal de création équipements ------------->
                    <!---------------------------------------------------------->
                    <div class="modal fade" id="equipmentAddForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Ajouter un équipement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form name="addEquipment" action="" method="POST">
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
                                        <button formaction="?page=details&character=<?= $id_character ?>&type=addEquipment" type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Modal de création équipement -->
                </div>
            </div>
        </div>