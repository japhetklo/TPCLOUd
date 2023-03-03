<?php
	$servername="localhost";
	$username="root";
	$password="";
	try{
		$bd=new PDO("mysql:host=$servername", $username, $password);
		$bd->exec('SET NAMES utf8');
		$sql="CREATE DATABASE if not exists dbetudiant";
		$bd->exec($sql);		
	}
	catch(PDOException $e){
		echo "Erreur :".$e->getMessage();
	}

	$bdd=new PDO("mysql:host=$servername; dbname=dbetudiant", $username, $password);
	$bdd->exec('SET NAMES utf8');
	$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING)

	
?>