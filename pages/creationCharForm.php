<?php
if(isset($_POST['img']) || isset($_POST['name'])){
    if (!filter_var($_POST['img'], FILTER_CALLBACK, array('options' => 'isAString'))
    ) {
        $_POST['img'] = "src/blank-avatar.png";
    }
    if (filter_var($_POST['name'], FILTER_CALLBACK, array('options' => 'isAString')) 
    && isAGoodNumber($_POST['strength'])
    && isAGoodNumber($_POST['dexterity'])
    && isAGoodNumber($_POST['constitution'])
    && isAGoodNumber($_POST['inteligence'])
    && isAGoodNumber($_POST['wisdom'])
    && isAGoodNumber($_POST['luck'])
    ) {
        $request = new Character($_POST);
    }
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
<input type="number" class="form-control" name="inteligence" placeholder="5" required>
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
<label for="formFile" class="form-label">Charger une Image</label>
<input class="form-control" type="file" name="img">
</div>
<div>
<button type="submit" class="btn btn-primary mb-3">Création</button>
<span>
    <?php if(isset($_POST['name'])){
    if (!filter_var($_POST['name'], FILTER_CALLBACK, array('options' => 'isAString'))) {?>
    <?='Veuillez entrer un nom valide !'?>
<?php
}}?>
</span>
</div>
</form>
</div>