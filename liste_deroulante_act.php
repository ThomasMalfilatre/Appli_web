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
	$requete = $connexion ->prepare("SELECT * FROM PARTICIPE p, ACTIVITE a WHERE p.users = :log AND p.activite = a.id");
	$requete -> bindParam(':log', $_SESSION['login']);
	$requete -> execute();
	foreach($requete as $q){
		echo "<option> $q[id] $q[nom] $q[Date] $q[Heure] </option>";
	}
	
?>
