<?php

//Récupération du personnage
$is_mj = $_SESSION["id"] == $character->id_mj;

$playerChar = $connection->prepare('SELECT * FROM `users` JOIN `game_character` ON  users.id = game_character.id_user WHERE id_charac = ' . $character->getId() . ' AND id_game = ' .  $character->getId_game());
$playerChar->setFetchMode(PDO::FETCH_CLASS, Users::class);
$playerChar->execute();
$player = $playerChar->fetch();

if ($character == false || ($_SESSION["id"] != $character->getId_user() && !$is_mj)) {
    header('Location: ?page=list');
} ?>

        <div class="col-3 d-flex justify-content-center align-items-center">
            <img class="img-fluid" src="<?= $character->getImg() ?>">
        </div>
        <div class="col-6">
            <div class="row d-flex justify-content-space-between">
                <h1 class="col-6"><?= $character->getName() ?>
                </h1>
                <?php if ($is_mj) { ?>
                    <span class="col-6">
                        <button class="btn m-1 p-1" data-bs-toggle="modal" data-bs-target="#charChangeForm<?= $character->getId() ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                        <a href="?page=details&character=<?= $character->getId() ?>&type=deleteChar"><button class="btn m-1 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button></a>
                    </span>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-6">
                    <h2 class="stat">Points de Vie</h2>
                    <p class="ms-3"><?= $character->getCurrentHp() . " / " . $character->getHpMax() ?>
                    </p>
                    <h2 class="stat">Force</h2>
                    <p class="ms-3"><?= $character->getStrength() ?>
                    </p>
                    <h2 class="stat">Dextérité</h2>
                    <p class="ms-3"><?= $character->getDexterity() ?>
                    </p>
                    <h2 class="stat">Constitution</h2>
                    <p class="ms-3"><?= $character->getConstitution() ?>
                    </p>
                    <h2 class="stat">Initiative</h2>
                    <p class="ms-3"><?= $character->getInit() ?>
                    </p>
                </div>
                <div class="col-6">
                    <h2 class="stat">Points de Magie</h2>
                    <p class="ms-3"><?= $character->getCurrentMp() . " / " . $character->getMpMax() ?>
                    </p>
                    <h2 class="stat">Intelligence</h2>
                    <p class="ms-3"><?= $character->getIntelligence() ?>
                    </p>
                    <h2 class="stat">Sagesse</h2>
                    <p class="ms-3"><?= $character->getWisdom() ?>
                    </p>
                    <h2 class="stat">Chance</h2>
                    <p class="ms-3"><?= $character->getLuck() ?>
                    </p>
                    <h2 class="stat">Joueur/Joueuse</h2>
                    <?php if ($player) { ?>
                        <p class="mt-1 mb-0 ms-3"><?= $player->getPseudo() ?>
                        <?php } else { ?>
                        <p class="mt-1 mb-0 ms-3"> Aucun(e).
                        <?php } ?>
                        <?php if ($is_mj) { ?>
                            <button class="btn p-0 mb-2 ms-3" data-bs-toggle="modal" data-bs-target="#changePlayer<?= $character->getId() ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                            </button>
                        <?php } ?>
                        </p>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- -------------------------------------HTML PART END---------------------------------------------- -->
    <!-- ------------------------------------------------------------------------------------------------ -->
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
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Point de vie</label>
                                    <input type="number" class="form-control" name="currentHp" value="<?= $character->getCurrentHp() ?>" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Point de mana</label>
                                    <input type="number" class="form-control" name="currentMp" value="<?= $character->getCurrentMp() ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
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
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Point de mana total</label>
                                    <input type="number" class="form-control" name="mpMax" value="<?= $character->getMpMax() ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Dextérité</label>
                                    <input type="number" class="form-control" name="dexterity" value="<?= $character->getDexterity() ?>" required>
                                    <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Force</label>
                                    <input type="number" class="form-control" name="strength" value="<?= $character->getStrength() ?>" required>
                                    <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Intélligence</label>
                                    <input type="number" class="form-control" name="intelligence" value="<?= $character->getIntelligence() ?>" required>
                                    <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Chance</label>
                                    <input type="number" class="form-control" name="luck" value="<?= $character->getLuck() ?>" required>
                                    <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Constitution</label>
                                    <input type="number" class="form-control" name="constitution" value="<?= $character->getConstitution() ?>" required>
                                    <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Sagesse</label>
                                    <input type="number" class="form-control" name="wisdom" value="<?= $character->getWisdom() ?>" required>
                                    <span class="form-text mt-0 ms-3">Entre 5 et 20</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="text" class="form-control" name="img" value="<?= $character->getImg() ?>" required>
                        </div>
                        <button formaction="?page=details&character=<?= $id_character ?>&type=charChange" type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------------------------------------- -->
    <!---------------------------------------fin modal modif character ------------------------------------------>
    <!-- ----------------------------------------------------------------------------------------------------- -->
    
            <!-- -------------------------------------------------------------------------------------- -->
            <!------------------------------- Modal changement Jouer start ------------------------------->
            <!-- -------------------------------------------------------------------------------------- -->
            <div class="modal fade" id="changePlayer<?= $character->getId() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Assigner un Joueur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="text" class="form-control mb-3" name="chgPlayer" required>
                                <button formaction="?page=details&character=<?= $id_character ?>&type=changePlayer" type="submit" class="btn btn-primary">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -------------------------------------------------------------------------------------- -->
            <!------------------------------- Modal changement Jouer end --------------------------------->
            <!-- -------------------------------------------------------------------------------------- -->