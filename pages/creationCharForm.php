<link href="css/charForm.css" rel="stylesheet">

<?php
if (isset($_POST['img']) || isset($_POST['name']) && isset($_POST['hpMax']) && isset($_POST['mpMax']) && isset($_POST['init']) && isset($_POST['strength']) && isset($_POST['dexterity']) && isset($_POST['constitution']) && isset($_POST['intelligence']) && isset($_POST['wisdom']) && isset($_POST['luck'])) {
    $newChar = new Character($_POST);
    $newChar->checkImg($_POST['img']);
    $testChar = $newChar->validateInt();
    if (empty($testChar) && $newChar->validateCount() && $newChar->validateName()) {
        $request = "INSERT INTO `character_sheets` (`name`,`hpMax`,`currentHp`,`mpMax`,`currentMp`,`initiative`,`strength`,`dexterity`,`constitution`,`intelligence`,`wisdom`,`luck`,`img`,`id_user`) VALUES ('" . $newChar->getName() . "'," . $newChar->getHpMax() . "," . $newChar->getCurrentHp() . "," . $newChar->getMpMax() . "," . $newChar->getCurrentMp() . "," . $newChar->getInit() . "," . $newChar->getStrength() . "," . $newChar->getDexterity() . "," . $newChar->getConstitution() . "," . $newChar->getIntelligence() . "," . $newChar->getWisdom() . "," . $newChar->getLuck() . ",'" . $newChar->getImg() . "'," . $newChar->getId_user() . ")";
        $count = $connection->exec($request);
    }
}


?>
<div class="w-25 ms-3">
    <form method="POST">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Entrez un nom de personnage</label>
            <input type="text" class="form-control" name="name" placeholder="Super couscous" required>
            <span class="red">
                <?php if (isset($newChar) && !$newChar->validateName()) { ?>
                    <?= 'Veuillez entrer un nom valide !' ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Entrez un nombre de point de vie</label>
            <input type="number" class="form-control" name="hpMax" placeholder="10 000 milliards" required>
            <span class="red">
                <?php if (isset($testChar['hpMax'])) { ?>
                    <?= $testChar['hpMax'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Entrez un nombre de point de mana</label>
            <input type="number" class="form-control" name="mpMax" placeholder="1000 milliards" required>
            <span class="red">
                <?php if (isset($testChar['mpMax'])) { ?>
                    <?= $testChar['mpMax'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Entrez l'initiative (maximum 10)</label>
            <input type="number" class="form-control" name="init" placeholder="5" required>
            <span class="red">
                <?php if (isset($testChar['init'])) { ?>
                    <?= $testChar['init'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Force (minimum 5 maximum 20)</label>
            <input type="number" class="form-control" name="strength" placeholder="5" required>
            <span class="red">
                <?php if (isset($testChar['strength'])) { ?>
                    <?= $testChar['strength'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Dextérité (minimum 5 maximum 20)</label>
            <input type="number" class="form-control" name="dexterity" placeholder="5" required>
            <span class="red">
                <?php if (isset($testChar['dexterity'])) { ?>
                    <?= $testChar['dexterity'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Constitution (minimum 5 maximum 20)</label>
            <input type="number" class="form-control" name="constitution" placeholder="5" required>
            <span class="red">
                <?php if (isset($testChar['constitution'])) { ?>
                    <?= $testChar['constitution'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Intélligence (minimum 5 maximum 20)</label>
            <input type="number" class="form-control" name="intelligence" placeholder="5" required>
            <span class="red">
                <?php if (isset($testChar['intelligence'])) { ?>
                    <?= $testChar['intelligence'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Sagesse (minimum 5 maximum 20)</label>
            <input type="number" class="form-control" name="wisdom" placeholder="5" required>
            <span class="red">
                <?php if (isset($testChar['wisdom'])) { ?>
                    <?= $testChar['wisdom'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Chance (minimum 5 maximum 20)</label>
            <input type="number" class="form-control" name="luck" placeholder="5" required>
            <span class="red">
                <?php if (isset($testChar['luck'])) { ?>
                    <?= $testChar['luck'] ?>
                <?php
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image : Entrez une url</label>
            <input class="form-control" type="text" name="img" placeholder="https://www.xxxxxx.xx">
        </div>
        <div>
            <button type="submit" class="btn btn-primary mb-3">Création</button>
        </div>
    </form>
</div>