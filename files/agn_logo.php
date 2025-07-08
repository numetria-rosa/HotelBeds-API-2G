<?php
session_start();
include_once("DB_FUNCTION_INC.php");
$site = new SITE();
$AGN 		= $_SESSION['USER'];
$agence 	= $AGN['id'];

$image_name = $_FILES['agn_logo']['name'];
$tmp_name 	= $_FILES['agn_logo']['tmp_name'];
$size 		= $_FILES['agn_logo']['size'];
$type 		= $_FILES['agn_logo']['type'];
$error 		= $_FILES['agn_logo']['error'];

if($type == "image/png" || $type == "image/jpeg"){
	$target_dir = "../admin/images/logo/";
	$target_file = $_FILES['agn_logo']['name'];
	$info = new SplFileInfo($target_file);
	$EXT  = $info->getExtension();
	$Newtarget_file = date("YmdHis").md5($target_file).".".$EXT;
	if(move_uploaded_file($_FILES['agn_logo']['tmp_name'],$target_dir.$Newtarget_file)){
		$_SESSION['Newtarget_file'] = $Newtarget_file;
		$_SESSION['USER']['logo']=$Newtarget_file;
		$update = $site->updateAgenceLogo($agence,$Newtarget_file);
	}
}

?>
