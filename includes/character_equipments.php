<?php

$findEquipments = $connection->prepare('SELECT * FROM `equipments` WHERE id_charac = ?');
$findEquipments->bindParam(1, $id_character, PDO::PARAM_STR);
$findEquipments->execute();
$equipments = $findEquipments->fetchAll(PDO::FETCH_CLASS, Equipment::class);

$findGameEquipments = $connection->prepare('SELECT * FROM `equipments` LEFT JOIN game_equipment ON equipments.id = game_equipment.id_equipment WHERE id_game =' . $character->getId_game() . ' AND ISNULL(id_charac)');
$findGameEquipments->execute();
$gameEquipments = $findGameEquipments->fetchAll(PDO::FETCH_CLASS, Equipment::class);
?>

<div class="col-4">
            <h2>Equipements</h2>
            <?php foreach ($equipments as $equipment) { ?>
                <div class="card mb-3" style="width: 100%;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="m-0 d-inline"><?= $equipment->getName() ?>
                            </h5>
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
                                    </button>
                                </a>
                            </span>
                        </div>
                        <p class="card-text mb-1"><span style='font-style:bold'>Dégâts :</span> <?= $equipment->getDamages() ?>
                        </p>
                        <p class="card-text mb-1"><span style='font-style:bold'>Portée :</span> <?= $equipment->getRange() ?>
                        </p>
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
                                    <button formaction="?page=details&character=<?= $id_character ?>&type=changeEquipment&idEquipment=<?= $equipment->getId() ?>" type="submit" class="btn btn-primary">Modifier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modal modif compétence -->
            <?php } ?>
            <?php if ($is_mj) { ?>        
            <div class="row">
                <div class="col-6 d-flex justify-content-center"><button class="btn btn-primary bg-info border-info d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#equipmentAddForm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2 bi bi-link" viewBox="0 0 16 16">
                            <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z" />
                            <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z" />
                        </svg>
                        Lier un équipement</button></div>
                <div class="col-6 d-flex justify-content-center"><button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#equipmentNewForm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2 bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        Nouvel équipement</button></div></div>
            <?php } ?>
            <!---------------------------------------------------------->
            <!-------------- Modal de création équipements ------------->
            <!---------------------------------------------------------->
            <div class="modal fade" id="equipmentNewForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <button formaction="?page=details&character=<?= $id_character ?>&type=newEquipment" type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Modal de création équipement -->

            <!-------------- Modal ajouter équipement de la table -------------->
        <div class="modal fade" id="equipmentAddForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Lier un équipement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="newSkill" action="" method="POST">
                            <label class="form-label">Choississez un équipement :</label>
                            <select class="form-select" name="idEquipment">
                                <?php
                                foreach ($gameEquipments as $gameEquipment) {
                                    ?>
                                <option value="<?= $gameEquipment->getId() ?>"><?= $gameEquipment->getName() . " - " . $gameEquipment->getDamages() . " dégât(s) - Portée " . $gameEquipment->getRange() ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <button formaction="?page=details&character=<?= $id_character ?>&type=addEquipment" type="submit" class="btn btn-primary mt-3">Lier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>