<?php
date_default_timezone_set("Africa/Tunis");
setlocale(LC_TIME, "fr_FR");
include("DB_INC.php");
include("OTHER_FUNC.php");
include("STRINGS.php");

if($WHEREAMIURL != $WORKPATH."agn/login/" && $WHEREAMIURL != $WORKPATH."agn/register/"){
	if(!isset($_SESSION['isSuperAdmin'])){
	}
}



class SITE{

	function SelectFromTable($table)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromTableORD($table,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromTableWC($table,$champ,$value,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' ORDER BY `".$ord."` ".$dir." ";

		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromTableWCLimit($table,$champ,$value,$limit,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' ORDER BY `".$ord."` ".$dir." LIMIT ".$limit." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromTableW2CLimit($table,$champ,$value,$champ2,$value2,$limit,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE ( `".$champ."`='".$value."' AND `".$champ2."`>='".$value2."' ) ORDER BY `".$ord."` ".$dir." LIMIT ".$limit." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromTableW3CLimit($table,$champ,$value,$champ2,$value2,$champ3,$value3,$limit,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE ( `".$champ."`='".$value."' AND `".$champ2."`>='".$value2."' AND `".$champ3."`='".$value3."' ) ORDER BY `".$ord."` ".$dir." LIMIT ".$limit." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function selectWLIMIT($table,$ord,$dir,$limit_start,$limit_end)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "select * from `".$table."` ORDER BY ".$ord." ".$dir." limit ".$limit_start." , ".$limit_end;
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function selectW1CLIMIT($table,$champ,$valeur,$ord,$dir,$limit_start,$limit_end)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "select * from `".$table."` WHERE ".$champ." = '".$valeur."'  ORDER BY ".$ord." ".$dir." limit ".$limit_start." , ".$limit_end;
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromGroupByWC($table,$group,$champ,$value,$champ2)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' OR `".$champ2."`='".$value."' GROUP BY `".$group."` ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromGroupBy($table,$group,$champ,$value)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' GROUP BY `".$group."` ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromTableW2C($table,$champ,$value,$champ2,$value2,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' AND `".$champ2."`='".$value2."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function SelectFromTableW2CNOT($table,$champ,$value,$champ2,$value2,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' AND `".$champ2."`!='".$value2."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function SelectFromTableW2COR($table,$champ,$value,$champ2,$value2,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' OR `".$champ2."`='".$value2."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	
	function SelectFromTableDistinct($table,$distinct,$champ,$value,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' GROUP BY `".$distinct."` ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function SelectFromTableDistinctNC($table,$distinct,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` GROUP BY `".$distinct."` ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function countResaFilter($Condition)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `booking` ".$Condition." ORDER BY `pid` DESC ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}

	function resaFilter($Condition)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `booking` ".$Condition." ORDER BY `pid` DESC ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function countTaskFilter($Condition)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `historyused` ".$Condition." ORDER BY `pid` DESC ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}
	
	function taskFilter($Condition)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `historyused` ".$Condition." ORDER BY `pid` DESC ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function updateMarkup($markupb2c){
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `markup` SET
		`markup_b2c`='".$markupb2c."'" ;
	
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}
		else{return $sqlSelect;}
		$db->disconnect();
	}

	function updateMarkupb2b($markupb2b){
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `markup` SET
		`markup_b2b`='".$markupb2b."'" ;
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}
		else{return $sqlSelect;}
		$db->disconnect();
	}
	function updateMarkupb2e($markupb2e){
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `markup` SET
		`markup_b2e`='".$markupb2e."'" ;
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}
		else{return $sqlSelect;}
		$db->disconnect();
	}
	function updateMarkuppersonne($markuppersonne){
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `markup` SET
		`markuppersonne`='".$markuppersonne."'" ;
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}
		else{return $sqlSelect;}
		$db->disconnect();
	}
	function updateMarkuppersonneb2b($markuppersonne){
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `markup` SET
		`markup_personne_b2b`='".$markuppersonne."'" ;
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}
		else{return $sqlSelect;}
		$db->disconnect();
	}
	function updateMarkuppersonneb2e($markuppersonne){
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `markup` SET
		`markup_personne_b2e`='".$markuppersonne."'" ;
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}
		else{return $sqlSelect;}
		$db->disconnect();
	}
	function SelectLastObjectTable($table,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` ORDER BY `".$ord."` ".$dir." LIMIT 0,1 ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}
	function SelectObjectTableWC($table,$champ,$value,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}
	function SelectObjectTableW2C($table,$champ,$value,$champ2,$value2,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' AND `".$champ2."`='".$value2."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}
	function SelectObjectTableW3C($table,$champ,$value,$champ2,$value2,$champ3,$value3,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' AND `".$champ2."`='".$value2."' AND `".$champ3."`='".$value3."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}
	function SelectObjectTableW4C($table,$champ,$value,$champ2,$value2,$champ3,$value3,$champ4,$value4)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' AND `".$champ2."`='".$value2."' AND `".$champ3."`='".$value3."' AND `".$champ4."`='".$value4."'  ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}
	function SelectObjectTableW2CNOT($table,$champ,$value,$champ2,$value2,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."` = '".$value."' AND `".$champ2."` != '".$value2."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}
	function SelectObjectTableW2COR($table,$champ,$value,$champ2,$value2,$ord,$dir)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' OR `".$champ2."`='".$value2."' ORDER BY `".$ord."` ".$dir." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}

	function DelFrom($table,$champ,$value)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " DELETE FROM `".$table."` WHERE `".$champ."`='".$value."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function countTableWBC($table,$condition)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE ".$condition." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}

	function countTable($table)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}

	function countTableWC($table,$condition,$value)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` = '".$value."'";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}
	function countTableWCOR($table,$condition,$value,$condition2,$value2)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` = '".$value."' OR `".$condition2."` = '".$value2."' ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}
	function countTableW2C($table,$condition,$value,$condition2,$value2)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` = '".$value."' AND `".$condition2."` = '".$value2."' ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}
	function countTableW3C($table,$condition,$value,$condition2,$value2,$condition3,$value3)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` = '".$value."' AND `".$condition2."` = '".$value2."' AND `".$condition3."` = '".$value3."' ";
		$reqSelect = $db->query($sqlSelect);
		//echo $sqlSelect ; die();
		return $db->numRows();
		$db->disconnect();
	}
	function countTableW4C($table,$condition,$value,$condition2,$value2,$condition3,$value3,$condition4,$value4)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` = '".$value."' AND `".$condition2."` = '".$value2."' AND `".$condition3."` = '".$value3."' AND `".$condition4."` = '".$value4."' ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}
	function countTableExp($table,$condition,$value,$condition2,$value2)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` = '".$value."' AND `".$condition2."` >= '".$value2."' ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}

	function selectTableCron($table,$condition,$value)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."`<'".$value."'  ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function countTableCron($table,$condition,$value)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` >= '".$value."'  ";
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}
	
	function selectTableCronContract($table,$condition,$value,$condition2,$value2)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = "SELECT * FROM `".$table."` WHERE `".$condition."` = '".$value."' AND `".$condition2."` < '".$value2."' ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function connect($login, $password){
		$db = new Db();
		$db->connect();
		$sqlSelect = sprintf(" SELECT * FROM `users` WHERE `role` !='Eleve' AND `email` = '%s' AND `password` = '%s' ",$login,$password);
		$reqSelect = $db->query($sqlSelect);
		return $db->numRows();
		$db->disconnect();
	}
	function profile($login, $password){
		$db = new Db();
		$db->connect();
		$sqlSelect = sprintf(" SELECT * FROM `users` WHERE `role` !='Eleve' AND `email` = '%s' AND `password` = '%s' ",$login,$password);
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}

	function AgnAdd($agn_name,$pays,$ville,$localite,$adresse,$zipcode,$iata,$telephone,$fax,$email,$rc,$if,$licence,$last_name,$first_name,$username,$password,$langue,$devise,$verif,$verified,$etat,$created_on)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `agence` (`nom_agence`,`code_pays`,`code_ville`,`ville`,`adresse`,`code_postal`,`code_iata`,`tel`,`fax`,`email`,`reg_commerce`,`num_fiscal`,`num_licence`,`nom`,`prenom`,`login`,`password`,`code_langue`,`code_devise`,`verification`,`verified`,`etat`,`created_on`,`last_login`,`email_client`,`tel_client`) VALUES ('".$agn_name."','".$pays."','".$ville."','".$localite."','".$adresse."','".$zipcode."','".$iata."','".$telephone."','".$fax."','".$email."','".$rc."','".$if."','".$licence."','".$last_name."','".$first_name."','".$username."','".$password."','".$langue."','".$devise."','".$verif."','".$verified."','".$etat."','".$created_on."','".$created_on."','".$email."','".$telephone."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function aProfilEdit($agn_nom,$agn_prenom,$agn_email_client,$agn_telephone,$username,$password,$PID)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `agence` SET
			`nom`='".$agn_nom."' ,
			`prenom`='".$agn_prenom."' ,
			`email_client`='".$agn_email_client."' ,
			`tel_client`='".$agn_telephone."' ,
			`login`='".$username."' ,
			`password`='".$password."'  

			WHERE `pid`='".$PID."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function wProfilEdit($agn_nom,$agn_prenom,$agn_email_client,$agn_telephone,$username,$password,$PID)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `workers` SET
			`nom`='".$agn_nom."' ,
			`prenom`='".$agn_prenom."' ,
			`email`='".$agn_email_client."' ,
			`tel`='".$agn_telephone."' ,
			`login`='".$username."' ,
			`password`='".$password."'  

			WHERE `pid`='".$PID."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function editAgence($agence_nom,$agence_email,$pays,$ville,$agence_zip,$agence_iata,$agence_adresse,$agence_licence,$agence_fiscal,$agence_registre,$user_nom,$user_prenom,$user_phone,$user_fax,$PID)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `agence` SET
			`nom_agence`='".$agence_nom."' ,
			`email`='".$agence_email."' ,
			`code_pays`='".$pays."' ,
			`code_ville`='".$ville."' ,
			`code_postal`='".$agence_zip."' ,
			`code_iata`='".$agence_iata."' ,
			`adresse`='".$agence_adresse."' ,
			`num_licence`='".$agence_licence."' ,
			`num_fiscal`='".$agence_fiscal."' ,
			`reg_commerce`='".$agence_registre."' ,
			`nom`='".$user_nom."' ,
			`prenom`='".$user_prenom."' ,
			`tel_client`='".$user_phone."' ,
			`fax`='".$user_fax."' 

			WHERE `pid`='".$PID."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function addWorker($last_name,$first_name,$email,$login,$password,$etat,$created_on,$last_login)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `superworkers` (`last_name`,`first_name`,`email`,`login`,`password`,`created_on`,`last_login`,`etat`) VALUES ('".$last_name."','".$first_name."','".$email."','".$login."','".$password."','".$created_on."','".$last_login."','".$etat."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function editWorker($worker_tel,$worker_email,$worker_password,$roles,$role,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `workers` SET
			`tel`='".$worker_tel."' ,
			`email`='".$worker_email."' ,
			`password`='".$worker_password."' ,
			`roles`='".$roles."' ,
			`role`='".$role."' 

			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function Verif($pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `agence` SET
			`verified`='1' 

			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function editWorkerEtat($E,$pid,$PID)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `workers` SET
			`etat`='".$E."' 

			WHERE (`pid`='".$pid."' AND `agence`='".$PID."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function lastLogin($table,$champ,$valeur,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `".$table."` SET
			`".$champ."`='".$valeur."' 

			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	function lastLoginid($table,$champ,$valeur,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `".$table."` SET
			`".$champ."`='".$valeur."' 

			WHERE `id`='".$pid."' ";
		

		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function editAgenceEtat($E,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `user` SET
			`Etat`='".$E."' 

			WHERE `id`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function editSuperEtat($E,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `superworkers` SET
			`etat`='".$E."' 

			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function editSuperAgence($agn_login,$agn_markup_personne,$password,$agn_devise,$agn_markup,$agn_adress,$agn_zipcode,$agn_ville,$agn_pays,$agn_rc,$agn_mf,$agn_iata,$agn_licence,$agn_etat,$roles,$client_nom,$client_prenom,$client_email,$client_tel,$agn_pid,$canal)
	{
	
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `user` SET
		
			`username`='".$agn_login."' ,
			`markup`='".$agn_markup."' ,
			`adresse`='".$agn_adress."' ,
			`code_postal`='".$agn_zipcode."' ,
			`code_pays`='".$agn_pays."' ,
			`code_ville`='".$agn_ville."' ,
			`code_iata`='".$agn_iata."' ,			
			`num_licence`='".$agn_licence."' ,
			`num_fiscal`='".$agn_mf."' ,
			`reg_commerce`='".$agn_rc."' ,
			`Etat`='".$agn_etat."' ,
			`roles`='".$roles."' ,
			`lastname`='".$client_nom."' ,
			`firstname`='".$client_prenom."' ,
			`email`='".$client_email."' ,
			`canal`='".$canal."' ,
			`password`='".$password."' ,
			`code_devise`='".$agn_devise."' ,
			`markup_personne`='".$agn_markup_personne."',
			`telephone`='".$client_tel."' 
			WHERE `id`='".$agn_pid."' ";

		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateLogo($agn_pid,$logo)
	{
		
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `user` SET
			`logo`='".$logo."' 
			WHERE `id`='".$agn_pid."' ";

		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}





    function UserNameCheck($login)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT * FROM `user` WHERE username = '%s'", $login);
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function EmailCheck($email)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT id FROM `user` WHERE email = '%s'", $email);
        $reqSelect = $db->query($sqlSelect);
        $result = $db->fetchArray();

        if (empty($result)) {
            return 0;
        } else {
            return $result[0]['id'];
        }

        $db->disconnect();
    }

	function insertSuperAgence($agn_devise,$agn_markup_personne,$agn_login,$password,$agn_markup,$agn_adress,$agn_zipcode,$agn_ville,$agn_pays,$agn_rc,$agn_mf,$agn_iata,$agn_licence,$agn_etat,$roles,$client_nom,$client_prenom,$client_email,$client_tel,$agn_pid,$canal,$logo)
	{
		$created=date("Y-m-d H:i:s"); 
		$db = new Db();
		$db->connect();
		$sqlSelect = "INSERT INTO `user`  (`username`,`markup`,`adresse`,`code_postal`,`code_pays`,`code_ville`,`code_iata`,`num_licence`,
		`num_fiscal`,`reg_commerce`,`Etat`,`roles`,`firstname`,`lastname`,`email`,`telephone`,`canal`,`password`,`CreatedAt`,`logo`,`code_devise`,`markup_personne`) VALUES
		('".$agn_login."','".$agn_markup."','".$agn_adress."','".$agn_zipcode."','".$agn_pays."','".$agn_ville."','".$agn_iata."','".$agn_licence."',
		'".$agn_mf."','".$agn_rc."','".$agn_etat."','".$roles."','".$client_prenom."','".$client_nom."','".$client_email."','".$client_tel."','".$canal."','".$password."','".$created."','".$logo."','".$agn_devise."','".$agn_markup_personne."')";
		$reqSelect = $db->query($sqlSelect);
		return 'ok';
		$db->disconnect();
	}

	function saveSuperWorker($last_name,$first_name,$email,$login,$password,$etat,$roles,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `superworkers` SET
			`last_name`='".$last_name."' ,
			`first_name`='".$first_name."' ,
			`email`='".$email."' ,
			`login`='".$login."' ,
			`password`='".$password."' ,
			`role`='".$roles."' ,
			`etat`='".$etat."' 

			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);

		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function saveSuperWorkerSB($last_name,$first_name,$email,$login,$password,$etat,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `superworkers` SET
			`last_name`='".$last_name."' ,
			`first_name`='".$first_name."' ,
			`email`='".$email."' ,
			`login`='".$login."' ,
			`password`='".$password."' ,
			`etat`='".$etat."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}else{return $sqlSelect;}
		$db->disconnect();
	}

	function addAgenceDeposit($agence,$deposit,$currency,$deposit_on,$comment,$oldCredit,$superworker)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `deposit` (`agence`,`deposit`,`currency`,`deposit_on`,`comment`,`oldCredit`,`superworker`) VALUES ('".$agence."','".$deposit."','".$currency."','".$deposit_on."','".$comment."','".$oldCredit."','".$superworker."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateAgenceCredit($agence,$CREDIT)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `user` SET
			`credit`='".$CREDIT."' 
			WHERE `id`='".$agence."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}


	function updateUserB2C($markup){
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `user` SET
			`markup`='".$markup."' 
			WHERE `canal`='B2C' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelStars($name,$number)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelsstars` (`name`,`number`) VALUES ('".$name."','".$number."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){
		return $sqlSelect;
		}else{
		return $sqlSelect;
		}
		$db->disconnect();
	}

	function updateHotelStars($name,$number,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelsstars` SET
			`name`='".$name."' ,
			`number`='".$number."' 

			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function insertCurrency($CurrLongName,$CurrShortName,$CurrChange,$CurrToTND)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `devises` (`CurrLongName`,`CurrShortName`,`CurrChange`,`CurrToTND`) VALUES ('".$CurrLongName."','".$CurrShortName."','".$CurrChange."','".$CurrToTND."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updateCurrency($CurrLongName,$CurrShortName,$CurrChange,$CurrToTND,$CurrPid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `devises` SET
			`CurrLongName`='".$CurrLongName."' ,
			`CurrShortName`='".$CurrShortName."' ,
			`CurrChange`='".$CurrChange."' ,
			`CurrToTND`='".$CurrToTND."' 

			WHERE `pid`='".$CurrPid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateCountry($PaysPid,$PaysNom,$PaysAlpha2,$PaysAlpha3)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `pays` SET
			`nom`='".$PaysNom."' ,
			`alpha2`='".$PaysAlpha2."' ,
			`alpha3`='".$PaysAlpha3."' 

			WHERE `id_pays`='".$PaysPid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateCity($CityPid,$CityNomFra,$CityNomEng)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `ville` SET
			`nom_fra`='".$CityNomFra."' ,
			`nom_eng`='".$CityNomEng."' 

			WHERE `id_ville`='".$CityPid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertCity($PaysPid,$CityNomFra,$CityNomEng)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `ville` (`id_pays`,`nom_fra`,`nom_eng`) VALUES ('".$PaysPid."','".$CityNomFra."','".$CityNomEng."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelBank($name)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelsbank` (`name`) VALUES ('".$name."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){return $sqlSelect;}
				else{return $sqlSelect;}
		$db->disconnect();
	}

	function updateHotelBank($name,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelsbank` SET
			`name`='".$name."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelAmenities($name)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelamenities` (`name`) VALUES ('".$name."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelAmenities($name,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelamenities` SET
			`name`='".$name."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelAmenitie($name,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelamenitie` (`name`,`pidAmenitie`) VALUES ('".$name."','".$pid."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelAmenitie($name,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelamenitie` SET
			`name`='".$name."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{return $sqlSelect;}
				else
				{return $sqlSelect;}
		$db->disconnect();
	}

	function editHotelEtat($E,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotels` SET
			`HotelStatus`='".$E."' 

			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function editPeriodEtat($E,$pidHotel)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`Status`='".$E."' 

			WHERE `pidHotel`='".$pidHotel."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertSuperHotel($HotelName,$HotelAddress,$HotelLocation,$HotelZipCode,$HotelPays,$HotelVille,$HotelPhone,$HotelFax,$HotelDevise,$HotelLanguage,$HotelWebsite,$HotelEmail,$HotelPassword,$HotelStatus,$HotelContactLastName,$HotelContactFirstName,$HotelReservation,$HotelBank,$HotelBankRib,$HotelStars,$HotelShortDescription,$HotelLongDescription,$HotelSpecialCondition,$HotelSpecialInformation,$HotelAmenities,$HotelReduction,$HotelVerification,$HotelCreatedOn,$HotelLastLogin,$HotelUrl)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotels` (`HotelName`,`HotelAddress`,`HotelLocation`,`HotelZipCode`,`HotelCountry`,`HotelCity`,`HotelPhone`,`HotelFax`,`HotelDevise`,`HotelLanguage`,`HotelWebsite`,`HotelEmail`,`HotelPassword`,`HotelStatus`,`HotelContactLastName`,`HotelContactFirstName`,`HotelReservation`,`HotelBank`,`HotelBankRib`,`HotelStars`,`HotelShortDescription`,`HotelLongDescription`,`HotelSpecialCondition`,`HotelSpecialInformation`,`HotelAmenities`,`HotelReduction`,`HotelVerification`,`HotelCreatedOn`,`HotelLastLogin`,`HotelUrl`) VALUES ('".$HotelName."','".$HotelAddress."' ,'".$HotelLocation."','".$HotelZipCode."','".$HotelPays."','".$HotelVille."','".$HotelPhone."','".$HotelFax."','".$HotelDevise."','".$HotelLanguage."','".$HotelWebsite."','".$HotelEmail."','".$HotelPassword."','".$HotelStatus."','".$HotelContactLastName."','".$HotelContactFirstName."','".$HotelReservation."','".$HotelBank."','".$HotelBankRib."','".$HotelStars."','".$HotelShortDescription."','".$HotelLongDescription."','".$HotelSpecialCondition."','".$HotelSpecialInformation."','".$HotelAmenities."','".$HotelReduction."','".$HotelVerification."','".$HotelCreatedOn."','".$HotelLastLogin."','".$HotelUrl."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function editSuperHotel($HotelName,$HotelAddress,$HotelLocation,$HotelZipCode,$HotelPays,$HotelVille,$HotelPhone,$HotelFax,$HotelDevise,$HotelLanguage,$HotelWebsite,$HotelEmail,$HotelPassword,$HotelStatus,$HotelContactLastName,$HotelContactFirstName,$HotelReservation,$HotelBank,$HotelBankRib,$HotelStars,$HotelShortDescription,$HotelLongDescription,$HotelSpecialCondition,$HotelSpecialInformation,$HotelAmenities,$HotelReduction,$HotelPid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotels` SET
			`HotelName`='".$HotelName."' ,
			`HotelAddress`='".$HotelAddress."' ,
			`HotelLocation`='".$HotelLocation."' ,
			`HotelZipCode`='".$HotelZipCode."' ,
			`HotelCountry`='".$HotelPays."' ,
			`HotelCity`='".$HotelVille."' ,
			`HotelPhone`='".$HotelPhone."' ,
			`HotelFax`='".$HotelFax."' ,
			`HotelDevise`='".$HotelDevise."' ,
			`HotelLanguage`='".$HotelLanguage."' ,
			`HotelWebsite`='".$HotelWebsite."' ,
			`HotelEmail`='".$HotelEmail."' ,
			`HotelPassword`='".$HotelPassword."' ,			
			`HotelStatus`='".$HotelStatus."' ,
			`HotelContactLastName`='".$HotelContactLastName."' ,
			`HotelContactFirstName`='".$HotelContactFirstName."' ,
			`HotelReservation`='".$HotelReservation."' ,
			`HotelBank`='".$HotelBank."' ,
			`HotelBankRib`='".$HotelBankRib."' ,
			`HotelStars`='".$HotelStars."' ,
			`HotelShortDescription`='".$HotelShortDescription."' ,
			`HotelLongDescription`='".$HotelLongDescription."'  ,
			`HotelSpecialCondition`='".$HotelSpecialCondition."'  ,
			`HotelSpecialInformation`='".$HotelSpecialInformation."'  ,
			`HotelAmenities`='".$HotelAmenities."'  ,
			`HotelReduction`='".$HotelReduction."'  

			WHERE `pid`='".$HotelPid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelImages($ImageName,$HotelPid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelimages` (`name`,`pidHotel`) VALUES ('".$ImageName."','".$HotelPid."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelRoomType($name)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelroomstype` (`name`) VALUES ('".$name."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelRoomType($name,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelroomstype` SET
			`name`='".$name."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelRoomMeal($name)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelroomsmeal` (`name`) VALUES ('".$name."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect){
		return $sqlSelect;}
		else{
		return $sqlSelect;
		}
		$db->disconnect();
	}

	function updateHotelRoomMeal($name,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelroomsmeal` SET
			`name`='".$name."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelRoomSupp($name)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelroomssupp` (`name`) VALUES ('".$name."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelRoomSupp($name,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelroomssupp` SET
			`name`='".$name."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function insertHotelContract($RoomType,$RoomMeal,$PeriodStart,$PeriodEnd,$PeriodPrice,$Supplement,$SuppPrice,$pidHotel)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelcontract` (`RoomType`,`RoomMeal`,`PeriodStart`,`PeriodEnd`,`PeriodPrice`,`RoomSupp`,`RoomSuppPrice`,`pidHotel`) VALUES ('".$RoomType."','".$RoomMeal."','".$PeriodStart."','".$PeriodEnd."','".$PeriodPrice."','".$Supplement."','".$SuppPrice."','".$pidHotel."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updateHotelContract($RoomType,$RoomMeal,$PeriodStart,$PeriodEnd,$PeriodPrice,$Supplement,$SuppPrice,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontract` SET
			`RoomType`='".$RoomType."' ,
			`RoomMeal`='".$RoomMeal."' ,
			`PeriodStart`='".$PeriodStart."' ,
			`PeriodEnd`='".$PeriodEnd."' ,
			`PeriodPrice`='".$PeriodPrice."' ,
			`RoomSupp`='".$Supplement."' ,
			`RoomSuppPrice`='".$SuppPrice."' 
			
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updateHotel2Contract($RoomType,$RoomMeal,$PeriodStart,$PeriodEnd,$PeriodPrice,$pidHotel,$Meal)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontract` SET
			`RoomType`='".$RoomType."' ,
			`RoomMeal`='".$RoomMeal."' ,
			`PeriodStart`='".$PeriodStart."' ,
			`PeriodEnd`='".$PeriodEnd."' ,
			`PeriodPrice`='".$PeriodPrice."' 
			
			WHERE `pidHotel`='".$pidHotel."' AND `RoomMeal`='".$Meal."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	
	function insertHotelContractPeriod($PeriodStart,$PeriodEnd,$pidHotel,$pidCity,$retrocession,$minstay)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelcontractperiod` (`PeriodStart`,`PeriodEnd`,`pidHotel`,`pidCity`,`retrocession`,`minstay`) VALUES ('".$PeriodStart."','".$PeriodEnd."','".$pidHotel."','".$pidCity."','".$retrocession."','".$minstay."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updateHotelContractPeriods($PeriodStart,$PeriodEnd,$retrocession,$minstay,$Single,$SingleUnit,$Week,$WeekUnit,$WeekDays,$perRoom,$pid,$updatedOn,$updatesuperworker)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`retrocession`='".$retrocession."' ,
			`minstay`='".$minstay."' ,
			`Single`='".$Single."' ,
			`SingleUnit`='".$SingleUnit."' ,
			`Week`='".$Week."' ,
			`WeekUnit`='".$WeekUnit."' ,
			`WeekDays`='".$WeekDays."' ,
			`perRoom`='".$perRoom."' ,
			`PeriodStart`='".$PeriodStart."' ,
			`PeriodEnd`='".$PeriodEnd."' ,  
			`updatedOn`='".$updatedOn."' ,  
			`updatesuperworker`='".$updatesuperworker."' 
			
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelContractPeriod($PeriodStart,$PeriodEnd,$Retrocession,$Minstay,$Quota,$Single,$SingleUnit,$Week,$WeekUnit,$WeekDays,$perRoom,$Markup,$pid,$updatedOn,$updatesuperworker)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`retrocession`='".$Retrocession."' ,
			`minstay`='".$Minstay."' ,
			`quota`='".$Quota."' ,
			`Single`='".$Single."' ,
			`SingleUnit`='".$SingleUnit."' ,
			`Week`='".$Week."' ,
			`WeekUnit`='".$WeekUnit."' ,
			`WeekDays`='".$WeekDays."' ,
			`perRoom`='".$perRoom."' ,
			`markup`='".$Markup."' ,
			`PeriodStart`='".$PeriodStart."' ,
			`PeriodEnd`='".$PeriodEnd."' , 
			`updatedOn`='".$updatedOn."'  ,
			`updatesuperworker`='".$updatesuperworker."'  
			
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelContractPeriodsStatus($status,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`status`='".$status."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelContractPeriodsStatusCron($status,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`Status`='".$status."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelContractPeriodsPromo($promo,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`promo`='".$promo."' 
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function insertHotelContractMealSupp($table,$champ1,$valeur1,$champ2,$valeur2,$champ3,$valeur3,$champ4,$valeur4)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `".$table."` (`".$champ1."`,`".$champ2."`,`".$champ3."`,`".$champ4."`) VALUES ('".$valeur1."','".$valeur2."','".$valeur3."','".$valeur4."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelContractCpSupp($table,$champ1,$valeur1,$champ2,$valeur2,$champ3,$valeur3,$champ4,$valeur4)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `".$table."` (`".$champ1."`,`".$champ2."`,`".$champ3."`,`".$champ4."`) VALUES ('".$valeur1."','".$valeur2."','".$valeur3."','".$valeur4."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelContractNew($PeriodStart,$PeriodEnd,$PeriodRetrocession,$PeriodMinStay,$PeriodQuota,$pidCity,$pidCountry,$pidHotel,$insertedOn,$superworker)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelcontractperiod` 
		(`PeriodStart`,`PeriodEnd`,`pidHotel`,`pidCity`,`pidCountry`,`retrocession`,`minstay`,`quota`,`insertedOn`,`insertsuperworker`,`updatedOn`,`updatesuperworker`) VALUES 
		('".$PeriodStart."','".$PeriodEnd."','".$pidHotel."','".$pidCity."','".$pidCountry."','".$PeriodRetrocession."','".$PeriodMinStay."','".$PeriodQuota."','".$insertedOn."','".$superworker."','".$insertedOn."','".$superworker."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updateHotelContractMealSupp($table,$champ1,$valeur1,$champ2,$valeur2,$champ3,$valeur3,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `".$table."` SET
			`".$champ1."`='".$valeur1."' ,
			`".$champ2."`='".$valeur2."' ,
			`".$champ3."`='".$valeur3."'  
			
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelContractCpSupp($table,$champ1,$valeur1,$champ2,$valeur2,$champ3,$valeur3,$pid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `".$table."` SET
			`".$champ1."`='".$valeur1."' ,
			`".$champ2."`='".$valeur2."' ,
			`".$champ3."`='".$valeur3."'  
			
			WHERE `pid`='".$pid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelReduction($ReduType,$ReduBed,$ReduKid,$ReduAgeStart,$ReduAgeEnd,$ReduAdult,$ReduRedu,$ReduUnit,$pidHotel)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelcontractreduction` (`ReduType`,`ReduBed`,`ReduKid`,`ReduAgeStart`,`ReduAgeEnd`,`ReduAdult`,`ReduRedu`,`ReduUnit`,`pidHotel`) VALUES ('".$ReduType."','".$ReduBed."','".$ReduKid."','".$ReduAgeStart."','".$ReduAgeEnd."','".$ReduAdult."','".$ReduRedu."','".$ReduUnit."','".$pidHotel."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertHotelReductionCP($ReduType,$ReduBed,$ReduKid,$ReduAgeStart,$ReduAgeEnd,$ReduAdult,$ReduRedu,$ReduUnit,$pidHotel,$pidPeriod)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelcontractreduction` (`ReduType`,`ReduBed`,`ReduKid`,`ReduAgeStart`,`ReduAgeEnd`,`ReduAdult`,`ReduRedu`,`ReduUnit`,`pidHotel`,`pidPeriod`) VALUES ('".$ReduType."','".$ReduBed."','".$ReduKid."','".$ReduAgeStart."','".$ReduAgeEnd."','".$ReduAdult."','".$ReduRedu."','".$ReduUnit."','".$pidHotel."','".$pidPeriod."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updateHotelReduction($ReduBed,$ReduKid,$ReduAgeStart,$ReduAgeEnd,$ReduAdult,$ReduRedu,$ReduUnit,$ReduPid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractreduction` SET
			`ReduBed`='".$ReduBed."' ,
			`ReduKid`='".$ReduKid."' ,
			`ReduAgeStart`='".$ReduAgeStart."' ,
			`ReduAgeEnd`='".$ReduAgeEnd."' ,
			`ReduAdult`='".$ReduAdult."' ,
			`ReduRedu`='".$ReduRedu."' ,
			`ReduUnit`='".$ReduUnit."'  
			
			WHERE `pid`='".$ReduPid."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updatePeriodCity($pidCity,$pidHotel)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`pidCity`='".$pidCity."'  
			
			WHERE `pidHotel`='".$pidHotel."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updatePeriodCountry($pidCountry,$pidHotel)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`pidCountry`='".$pidCountry."'  
			
			WHERE `pidHotel`='".$pidHotel."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function updatePeriodSingle($pidPeriod,$SuppPrice)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotelcontractperiod` SET
			`Single`='".$SuppPrice."'  
			
			WHERE `pid`='".$pidPeriod."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function insertContractReductionNew($ReduType,$ReduBed,$ReduKid,$ReduAgeStart,$ReduAgeEnd,$ReduAdult,$ReduRedu,$ReduUnit,$pidHotel,$pidPeriod)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelcontractreduction` (`ReduType`,`ReduBed`,`ReduKid`,`ReduAgeStart`,`ReduAgeEnd`,`ReduAdult`,`ReduRedu`,`ReduUnit`,`pidHotel`,`pidPeriod`) VALUES ('".$ReduType."','".$ReduBed."','".$ReduKid."','".$ReduAgeStart."','".$ReduAgeEnd."','".$ReduAdult."','".$ReduRedu."','".$ReduUnit."','".$pidHotel."','".$pidPeriod."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	
	function insertNewTour($TourName,$TourDuration,$HotelName,$HotelLocation,$HotelLatitude,$HotelLongitude,$TourDetails,$dataPrice,$dataDouble,$hasKids,$KidFreeAge,$KidAgeFrom,$KidAgeTo,$dataChild,$hasExtra,$dataExtra,$ValidUntil,$TourStatus,$TourUrl)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `tours` (`TourName`, `TourDuration`, `HotelName`, `HotelLocation`, `HotelLatitude`, `HotelLongitude`, `TourDetails`, `dataPrice`, `dataDouble`, `hasKids`, `KidFreeAge`, `KidAgeFrom`, `KidAgeTo`, `dataChild`, `hasExtra`, `dataExtra`, `ValidUntil`, `TourStatus`, `TourUrl`) VALUES ('".$TourName."', '".$TourDuration."', '".$HotelName."', '".$HotelLocation."', '".$HotelLatitude."', '".$HotelLongitude."', '".$TourDetails."', '".$dataPrice."', '".$dataDouble."', '".$hasKids."', '".$KidFreeAge."', '".$KidAgeFrom."', '".$KidAgeTo."', '".$dataChild."', '".$hasExtra."', '".$dataExtra."', '".$ValidUntil."', '".$TourStatus."', '".$TourUrl."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updateTourImage($TourImage,$PidTour)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `tours` SET
			`TourImage`='".$TourImage."'  
			
			WHERE `pid`='".$PidTour."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function insertTourOption($OptionName,$OptionAdultPrice,$OptionKidPrice,$PidTour)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `toursoption` (`OptionName`,`OptionAdultPrice`,`OptionKidPrice`,`PidTour`) VALUES ('".$OptionName."','".$OptionAdultPrice."','".$OptionKidPrice."','".$PidTour."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function insertTourImages($ImageName,$TourPid)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `toursimages` (`ImageName`,`TourPid`) VALUES ('".$ImageName."','".$TourPid."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}
	
	function updateHotelUrl($HotelUrl,$PID)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `hotels` SET
			`HotelUrl`='".$HotelUrl."'  
			
			WHERE `pid`='".$PID."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function BookClientUpdate($table,$champ,$value,$champ2,$value2,$cond,$val)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " UPDATE `".$table."` SET
			`".$champ."`='".$value."' ,
			`".$champ2."`='".$value2."'  
			
			WHERE `".$cond."`='".$val."' ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return $sqlSelect;
				}
				else
				{
				return $sqlSelect;
				}
		$db->disconnect();
	}

	function searchTableLike($table,$champ,$value,$ord,$dir,$limit)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."` LIKE '%".$value."%' GROUP BY `".$ord."` LIMIT ".$limit." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}
	
	function searchTableLikeD($table,$champ,$value,$ord,$dir,$limit)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."` LIKE '%".$value."%' GROUP BY `".$ord."` LIMIT ".$limit." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	
	function bookingFilter($table,$champ,$value,$ord,$dir,$limit)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."` LIKE '%".$value."%' ORDER BY `".$ord."` ".$dir." LIMIT ".$limit." ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function userFilterDJ($table,$champ1,$value1,$value2,$ord,$dir,$limit)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ1."` LIKE '%".$value1."%' AND `canal` = '".$value2."'  ORDER BY `".$ord."` ".$dir." LIMIT ".$limit." ";
	
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	function insertHistory($superWorker,$insertedOn,$tache,$usedTable,$comment)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `historyused` (`superWorker`,`insertedOn`,`tache`,`usedTable`,`comment`) VALUES ('".$superWorker."','".$insertedOn."','".$tache."','".$usedTable."','".$comment."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return 1;
				}
				else
				{
				return 0;
				}
		$db->disconnect();
	}

	function diagramSumAgency($pidagence,$bookingservicetype)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT SUM(`grossamount`) AS SOMME FROM `booking` WHERE `pidagence`='".$pidagence."' AND `bookingservicetype`='".$bookingservicetype."' AND `currentstatus`='vouchered' ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}

	function diagramSumAgent($pidagent,$bookingservicetype)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT SUM(`grossamount`) AS SOMME FROM `booking` WHERE `pidagent`='".$pidagent."' AND `bookingservicetype`='".$bookingservicetype."' AND `currentstatus`='vouchered' ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchObject();
		$db->disconnect();
	}

	function fetchDataOnline()
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " SELECT * FROM `online` WHERE last_activity > DATE_SUB(NOW(), INTERVAL 3615 SECOND) ORDER BY `agencypid` ASC ";
		$reqSelect = $db->query($sqlSelect);
		return $db->fetchArray();
		$db->disconnect();
	}
	
	function insertMeal($newRoomMeal, $newPeriodPrice, $newpidPeriod)
	{
		$db = new Db();
		$db->connect();
		$sqlSelect = " INSERT INTO `hotelcontractmeal` (`RoomMeal`,`PeriodPrice`,`pidPeriod`) VALUES ('".$newRoomMeal."','".$newPeriodPrice."','".$newpidPeriod."') ";
		$reqSelect = $db->query($sqlSelect);
		if($reqSelect)
				{
				return 1;
				}
				else
				{
				return 0;
				}
		$db->disconnect();
	}

}
?>
