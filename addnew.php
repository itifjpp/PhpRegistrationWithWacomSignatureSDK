<?php
	require 'config.php';
		
	$cnn = new mysqli($server, $user, $password, $database);
	if($cnn->connect_error){
		die("Connection failed");
	}

	$company = $_REQUEST["company"];
	$title = $_REQUEST["title"];
	$name = $_REQUEST['name'];
	$sql = "insert into registration (Company, Title, Name) Values ('".$company."','".$title."','".$name."')";

	if($cnn->query($sql) === TRUE){
		echo "Success";
	}else{
		echo "Failed";
	}
	
?>