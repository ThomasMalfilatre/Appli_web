<?php
	function listAct(){
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
	}	
?>

<html lang="fr">
	<head>
		<title>Inscription à une activité</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			if(!empty($errorMessage)){
				echo $errorMessage;
			}
		?>
		<form action="ajoutParticipeDB.php" method="post">
			<fieldset>
				<legend>Inscription</legend>
				<p>
					<label for="activite">Activité :</label>
					<select name="activite">
						<?php listAct(); ?>
					</select>
					<label for="creneau">Creneau horaire</label>
					<input type="datetime-local" name="creneau" />
					<input type="submit" value="S'inscrire" />
				</p>
			</fieldset>
		</form>
	</body>
</html>