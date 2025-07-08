<?php
session_start();
include_once("files/STRINGS.php");
session_unset();
session_destroy();
header("location:".$WORKPATH."login.php");
?>