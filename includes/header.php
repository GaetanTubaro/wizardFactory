<?php
session_start();
include "includes/config.inc.php";

spl_autoload_register(function ($class) {
    require_once "classes/$class.php";
});

require_once 'includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wizard Factory</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Wizard Factory</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php
                        if (isset($_SESSION["login"])) {
                            echo '<a class="nav-link" href="?page=list">Liste</a>';
                            echo '<a class="nav-link" href="?page=creationCharForm">Créer</a>';
                            echo '<a class="nav-link" href="?page=logout">Deconnexion</a>';
                            echo '<a class="nav-link"> Bienvenue ' . $_SESSION["login"] . '!! :D</a>';
                        } else {
                            echo '<a class="nav-link" href="?page=login">Connexion</a>';
                            echo '<a class="nav-link" href="?page=signup">Inscription</a>';
                        }
                            ?>
                </div>
            </div>
        </div>
    </nav>