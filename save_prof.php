<?php
require_once('header.php');
$_SESSION['mmiquest']['prof_id'] = $_GET['pid'];
header('Location: carte.php');
?>