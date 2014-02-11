<?php

		require_once 'connect.php';

		//session_start();
		if(!empty($_SESSION['login'])){
		}
		else{
			header('Location: Acceuil.php');
		}


		$dsn = "mysql:dbname=".BASE.";host=".SERVER;
		try{
			$connexion = new PDO($dsn,USER,PASSWD);
		}
		catch(PDOException $e){
			printf("Echec de la connexion : %s\n", $e->getMessage());
			exit();
		}
		$requete = "SELECT * FROM PARTICIPE p, ACTIVITE a WHERE p.activite = a.id AND p.users = :log";
		$stmt = $connexion -> prepare($requete);
		$stmt -> bindParam(':log', $_SESSION['login']);
		$stmt->execute();
		
		echo "<ul>";
		foreach($stmt as $q){
			echo "<li> $q[nom] le $q[Date] à $q[Heure] </li>";
		}
		echo "</ul>";
?>
