<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 1;
}
$findCharacter = $connection->prepare('SELECT * FROM `character_sheets` WHERE id = ?');
$findCharacter->bindParam(1, $id, PDO::PARAM_STR);
$findCharacter->setFetchMode(PDO::FETCH_CLASS, Character::class);
$findCharacter->execute();
$character = $findCharacter->fetch();

$findSkills = $connection->prepare('SELECT * FROM `skills` WHERE id_charac = ?');
$findSkills->bindParam(1, $id, PDO::PARAM_STR);
$findSkills->execute();
$skills = $findSkills->fetchAll(PDO::FETCH_CLASS, Skill::class);

$findEquipements = $connection->prepare('SELECT * FROM `equipements` WHERE id_charac = ?');
$findEquipements->bindParam(1, $id, PDO::PARAM_STR);
$findEquipements->execute();
$equipements = $findEquipements->fetchAll(PDO::FETCH_CLASS, Equipement::class);
?>

<link href="css/details.css" rel="stylesheet">

<div class="container-fluid p-5">
  <div class="row d-flex justify-content-center align-items-start">
    <div class="col-3 d-flex justify-content-center align-items-center">
      <img class="img-fluid" src="<?= $character->getImg() ?>">
    </div>
    <div class="col-6">
      <h1><?= $character->getName() ?></h1>
      <div class="row">
        <div class="col-6">
          <h2 class="stat">Points de Vie</h2>
          <p class="ms-3"><?= $character->getCurrentHp() . " / " . $character->getHpMax() ?></p>
          <h2 class="stat">Force</h2>
          <p class="ms-3"><?= $character->getStrength() ?></p>
          <h2 class="stat">Constitution</h2>
          <p class="ms-3"><?= $character->getConstitution() ?></p>
          <h2 class="stat">Sagesse</h2>
          <p class="ms-3"><?= $character->getWisdom() ?></p>
        </div>
        <div class="col-6">
          <h2 class="stat">Points de Magie</h2>
          <p class="ms-3"><?= $character->getCurrentMp() . " / " . $character->getMpMax() ?></p>
          <h2 class="stat">Dextérité</h2>
          <p class="ms-3"><?= $character->getDexterity() ?></p>
          <h2 class="stat">Intelligence</h2>
          <p class="ms-3"><?= $character->getIntelligence() ?></p>
          <h2 class="stat">Chance</h2>
          <p class="ms-3"><?= $character->getLuck() ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4 d-flex justify-content-center align-items-start">
    <div class="col-4">
      <h2>Compétences</h2>
      <?php foreach ($skills as $skill) { ?>
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title"><?= $skill->getName() ?></h5>
            <p class="card-text"><span style='font-style:bold'>Statistique liée :</span> <?= $skill->getStats() ?></p>
            <p class="card-text"><span style='font-style:bold'>Niveau :</span> <?= $skill->getLevel() ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="col-4">
      <h2>Equipements</h2>
      <?php foreach ($equipements as $equipement) { ?>
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title"><?= $equipement->getName() ?></h5>
            <p class="card-text"><span style='font-style:bold'>Dégâts :</span> <?= $equipement->getDamages() ?></p>
            <p class="card-text"><span style='font-style:bold'>Portée :</span> <?= $equipement->getRange() ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>


<!-- <form class="row g-3">
  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">Email</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Password</label>
    <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
  </div>
</form> -->