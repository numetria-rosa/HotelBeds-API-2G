<?php
if ( !isset($_SESSION['SuperSuperAdmin']) || $_SESSION['SuperSuperAdmin'] == false ) {
  header("location:".$WORKPATH."login.php");
  die();
}
$superSuper_roles = stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->role));$principal = stripslashes(utf8_decode($_SESSION['SuperSuperAdmin']->principal));
$superRoles       = explode(',', $superSuper_roles);
?>