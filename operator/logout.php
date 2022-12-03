<?php 
include('config.php');
unset($_SESSION['username']);
session_destroy();
header("Location: index.php");
?>