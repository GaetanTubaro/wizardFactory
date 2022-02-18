<link href="css/charForm.css" rel="stylesheet">

<?php
if (isset($_POST['name']) && isset($_POST['hpMax']) && isset($_POST['mpMax']) && isset($_POST['init']) && isset($_POST['strength']) && isset($_POST['dexterity']) && isset($_POST['constitution']) && isset($_POST['intelligence']) && isset($_POST['wisdom']) && isset($_POST['luck'])) {
    $newChar = new Character($_POST);
    $newChar->checkImg($_POST['img']);
    $testChar = $newChar->validateInt();
    if (empty($testChar) && $newChar->validateCount()) {
        $request = "INSERT INTO `character_sheets` (`name`,`hpMax`,`currentHp`,`mpMax`,`currentMp`,`initiative`,`strength`,`dexterity`,`constitution`,`intelligence`,`wisdom`,`luck`,`img`,`id_user`) VALUES ('" . $newChar->getName() . "'," . $newChar->getHpMax() . "," . $newChar->getCurrentHp() . "," . $newChar->getMpMax() . "," . $newChar->getCurrentMp() . "," . $newChar->getInit() . "," . $newChar->getStrength() . "," . $newChar->getDexterity() . "," . $newChar->getConstitution() . "," . $newChar->getIntelligence() . "," . $newChar->getWisdom() . "," . $newChar->getLuck() . ",'" . $newChar->getImg() . "'," . $newChar->getId_user() . ")";
        $count = $connection->exec($request);
        header('location: ?page=list');
    } else {
        foreach ($testChar as $error) { ?>
            <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                <p class="mb-0"><?= $error ?>. Veuillez entrer une donnée valide.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><?php
                }
            }
        }


                    ?>

<div class="container">
    <form method="POST">
        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-4">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Entrez un nom de personnage</label>
                    <input type="text" class="form-control" name="name" placeholder="Super couscous" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Entrez un nombre de point de vie</label>
                    <input type="number" class="form-control" name="hpMax" placeholder="10 000 milliards" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Entrez un nombre de point de mana</label>
                    <input type="number" class="form-control" name="mpMax" placeholder="1000 milliards" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Entrez l'initiative (maximum 10)</label>
                    <input type="number" class="form-control" name="init" placeholder="5" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Force (minimum 5 maximum 20)</label>
                    <input type="number" class="form-control" name="strength" placeholder="5" required>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Dextérité (minimum 5 maximum 20)</label>
                    <input type="number" class="form-control" name="dexterity" placeholder="5" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Constitution (minimum 5 maximum 20)</label>
                    <input type="number" class="form-control" name="constitution" placeholder="5" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Intélligence (minimum 5 maximum 20)</label>
                    <input type="number" class="form-control" name="intelligence" placeholder="5" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Sagesse (minimum 5 maximum 20)</label>
                    <input type="number" class="form-control" name="wisdom" placeholder="5" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Chance (minimum 5 maximum 20)</label>
                    <input type="number" class="form-control" name="luck" placeholder="5" required>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image : Entrez une url</label>
                        <input class="form-control" type="text" name="img" placeholder="https://www.xxxxxx.xx">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mb-3">Création</button>
                    </div>
                </div>
            </div>
    </form>
</div>