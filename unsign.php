<?php
	require 'config.php';
		
	$cnn = new mysqli($server, $user, $password, $database);
	if($cnn->connect_error){
		die("Connection failed");
	}

	$id = $_REQUEST["id"];
	$sql = "update registration set Signature = NULL, Timestamp = NULL where ID = '" . $id . "'";

	if($cnn->query($sql) === TRUE){
		echo "1";
	}else{
		echo "0";
	}
	
?>