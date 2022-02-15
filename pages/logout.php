<?php
include "includes/header.php";

session_destroy();
header("Location:?page=login");

include "includes/footer.php"
?>