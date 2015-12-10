<?php
	require 'config.php';
		
	$cnn = new mysqli($server, $user, $password, $database);
	if($cnn->connect_error){
		die("Connection failed");
	}

	$id = $_REQUEST["id"];
	$remark = $_REQUEST["remark"];
	$sql = "update registration set Remarks = '" . $remark . "' where ID = '" . $id . "'";

	if($cnn->query($sql) === TRUE){
		echo "1";
	}else{
		echo "0";
	}
	
?>