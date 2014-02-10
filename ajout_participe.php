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
		$requete = $connexion ->prepare("SELECT * FROM ACTIVITE");
		$requete -> execute();
		foreach($requete as $q){
			echo "<option> $q[id] $q[nom] </option>";
		}
	
?>
