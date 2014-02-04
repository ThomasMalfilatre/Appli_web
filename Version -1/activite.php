<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
	</head>

	<?php

		require_once 'connect.php';

		session_start();
		if(!empty($_SESSION['login'])){
			echo 'Bienvenue ' . $_SESSION['login']."<br />";
		}
		else{
			header('Location: log.php');
		}

		echo "Votre liste d'activités :<br />";

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
			echo "<li> $q[nom] le $q[creneau] </li>";
		}
		echo "</ul>";
	?>

	<input type="button" value="participe" onclick="document.location.replace('ajout_participe.php')" />
	<input type="button" value="deconnexion" onclick="document.location.replace('deconnexion.php')" />

</html>	