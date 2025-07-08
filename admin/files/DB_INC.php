<?php

class Db{

	var $host="localhost";
	var $user="root";
	var $pass="";
	var $database	= "dmcbookingpro";
	var $connId;
	var $output 	= array();
	var $result;

		function connect(){
			$this->connId = mysqli_connect($this->host,$this->user,$this->pass);
			mysqli_set_charset($this->connId,'utf8');
			mysqli_select_db($this->connId,$this->database) or die ("Erreur de connexion à la base ");
		}

		function query($sql){
			$this->result = mysqli_query($this->connId , $sql) or die( mysqli_error($this->connId));
			//$this->result = $conn->query($sql);
		}
		
		function affectedRows(){
			$count = mysqli_affected_rows($this->connId);
			return $count;
		}
		
		function fetchArray(){
			//unset($this->output);
			while ($data = mysqli_fetch_array($this->result)) {
			   $this->output[] = $data;
			}
			return $this->output;
		}

		function fetchObject(){
			$row = mysqli_fetch_object($this->result);
			return $row;
		}
		
		function numRows(){
			$count = mysqli_num_rows($this->result);
			return $count;		
		}

		function insert_id(){
			$id = mysqli_insert_id($this->connId);
			return $id;		
		}
		
		function disconnect(){
			mysqli_close($this->connId);
		}
}

?>
