<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rbpms");
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/rbpms/');
define('SITE_PATH', 'http://localhost/rbpms/');

define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'photu/');
define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'photu/');
?>
