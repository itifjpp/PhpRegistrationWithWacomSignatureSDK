<?php
	require 'config.php';
		
	$cnn = new mysqli($server, $user, $password, $database);
	if($cnn->connect_error){
		die("Connection failed");
	}

	$sigText = $_REQUEST["sigText"];
	$id = $_REQUEST["id"];
	$sql = "update registration set Signature = '" . $sigText . "', Timestamp=now() where ID = '" . $id . "'";

	if($cnn->query($sql) === TRUE){
		echo $sql;
	}else{
		echo "0";
	}
	
?>