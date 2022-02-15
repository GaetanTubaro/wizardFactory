<?php
if (isset($_POST['img']) || isset($_POST['name']) && isset($_POST['hpMax']) && isset($_POST['mpMax']) && isset($_POST['strength']) && isset($_POST['dexterity']) && isset($_POST['constitution']) && isset($_POST['intelligence']) && isset($_POST['wisdom']) && isset($_POST['luck'])) {
    $newChar = new Character($_POST);
    $request = "INSERT INTO `character_sheets` (`name`,`hpMax`,`currentHp`,`mpMax`,`currentMp`,`strength`,`dexterity`,`constitution`,`intelligence`,`wisdom`,`luck`,`img`) VALUES ('" . $newChar->getName() . "'," . $newChar->getHpMax() . "," . $newChar->getCurrentHp() . "," . $newChar->getMpMax() . "," . $newChar->getCurrentMp() . "," . $newChar->getStrength() . "," . $newChar->getDexterity() . "," . $newChar->getConstitution() . "," . $newChar->getIntelligence() . "," . $newChar->getWisdom() . "," . $newChar->getLuck() . ",'" . $newChar->getImg() . "')";
    $count = $connection->exec($request);
}


?>
<div class="w-25 ms-3">
    <form method="POST">
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
            <label for="formGroupExampleInput2" class="form-label">Force (minimum 5 maximum 20)</label>
            <input type="number" class="form-control" name="strength" placeholder="5" required>
        </div>
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
        <div class="mb-3">
            <label for="formFile" class="form-label">Image : Entrez une url</label>
            <input class="form-control" type="text" name="img" placeholder="https://www.xxxxxx.xx">
        </div>
        <div>
            <button type="submit" class="btn btn-primary mb-3">Création</button>
            <span>
                <?php if (isset($_POST['name'])) {
                    if (!filter_var($_POST['name'], FILTER_CALLBACK, array('options' => 'isAString'))) { ?>
                        <?= 'Veuillez entrer un nom valide !' ?>
                <?php
                    }
                } ?>
            </span>
        </div>
    </form>
</div>