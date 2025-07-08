<?php
session_start();


if(!empty($_FILES)){
	if (!isset($_SESSION['logo'])) {
		$_SESSION['logo'] = array();
	}

	$logo 	= $_SESSION['logo'];
	
	$targetDir 		= "images/logo/";

	$fileName 		= $_FILES['file']['name'];
	$info 			= new SplFileInfo($fileName);
	$EXT 			= $info->getExtension();
	$NewFileName 	= sprintf("%09d", mt_rand(1, 999999999));
	$NewFileName   .= '-'.date("YmdHis").'.'.$EXT;

	$targetFile 	= $targetDir.$NewFileName;
	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
		array_push($logo, $NewFileName);
	}
	$_SESSION['logo'] = $logo;
	
}




?>