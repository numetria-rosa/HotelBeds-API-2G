<?php 
session_start();
include_once("files/DB_FUNCTION_INC.php");
$site = new SITE();
if (isset($_SESSION['USER'])){
    unset($_SESSION['USER']);
    header('location:index.php');
}else{
    header('location:index.php');
}
?>