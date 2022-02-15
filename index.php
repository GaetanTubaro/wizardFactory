<?php
    require_once 'includes/header.php';
?>



<?php
    require_once 'includes/footer.php';

include_once 'includes/header.php';

if (empty($_GET['page'])) {
    $page = 'login';
} else {
    $page = $_GET["page"];
}

include 'pages/'. $page .'.php';
include_once 'includes/footer.php';
