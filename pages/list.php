<link href="css/list.css" rel="stylesheet">

<?php
$id_user = 1;
$searchCharacters = $connection->prepare('SELECT * FROM `character_sheets` WHERE id_user = ? ORDER BY name');
$searchCharacters->bindParam(1, $id_user, PDO::PARAM_STR);
$searchCharacters->execute();
$characters = $searchCharacters->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="liste">
<?php foreach ($characters as $character) {?>
    <div class="characard"><img src="<?= $character['img']?>">
<h2><?= $character['name'] ?></h2></div>
<?php
}
?></div>