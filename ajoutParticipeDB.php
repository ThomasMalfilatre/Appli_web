<?php
	require_once 'connect.php';
	session_start();
	$dsn = "mysql:dbname=".BASE.";host=".SERVER;
	try{
		$connexion = new PDO($dsn,USER,PASSWD);
	}
	catch(PDOException $e){
		printf("Echec de la connexion : %s\n", $e->getMessage());
		exit();
	}

	$ajout = $connexion	-> prepare("INSERT INTO PARTICIPE VALUES (:user, :act, :creneau)");
	$ajout -> bindParam(':user', $_SESSION['login']);	
	$ajout -> bindParam(':act', str_split($_POST['activite'])[0]);	
	$ajout -> bindParam(':creneau', $_POST['creneau']);
	$ajout -> execute();

	header("Location: activite.php");
?>