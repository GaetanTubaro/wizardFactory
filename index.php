<?php
include_once 'includes/header.php';

if (empty($_GET['page'])) {
    $page = 'creationCharForm';
} else {
    $page = $_GET["page"];
}

include 'pages/' . $page . '.php';
include_once 'includes/footer.php';
