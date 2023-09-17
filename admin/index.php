<?php
ob_start();
require_once "public/config/uploader.php";
if (!isset($_SESSION['name'])) {
    header("Location: login.php?login=first");
}
require_once "view/layout/header.php";
$controller = @$_GET['c'] ? $_GET['c'] : 'index';
$action = @$_GET['a'] ? $_GET['a'] : 'index';

if (file_exists("controller/C$controller.php")) {
    require_once "controller/C$controller.php";
}

require_once "./view/layout/footer.php";
ob_end_flush();
?>