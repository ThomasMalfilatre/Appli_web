<?php
	require_once 'connect.php';
	$dsn = "mysql:dbname=".BASE.";host=".SERVER;
	try{
		$connexion = new PDO($dsn,USER,PASSWD);
	}
	catch(PDOException $e){
		printf("Echec de la connexion : %s\n", $e->getMessage());
		exit();
	}

	session_start();


	if ( $_POST['act']) { //verifie que l'utilisateur saisi bien des valeurs

		$rep = explode(' ', $_POST['act']);
		$activite = $rep[0];
		$day = $rep[2];
		$h = $rep[3];

		$suppr = $connexion	-> prepare("DELETE FROM PARTICIPE WHERE users = :log and activite = :activite and Date = :d and Heure = :h" );
		$suppr -> bindParam(':log', $_SESSION['login']);	
		$suppr -> bindParam(':activite', $activite);	
		$suppr -> bindParam(':d', $day);
		$suppr -> bindParam(':h', $h);
		$suppr -> execute();
	}
	
	header("Location: activite.php");	
?>
