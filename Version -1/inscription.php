<!DOCTYPE html>


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

	$errorMessage = '';

	// test de l'envoi du formulaire
	if(!empty($_POST)){
		//les identifiants sont transmis ?
		if(!empty($_POST['login']) && !empty($_POST['password1']) && !empty($_POST['password2']) ){
			//sont il dans la base de données ?
			$sql = "SELECT * FROM USERS WHERE login = :log"; 
			$stmt = $connexion -> prepare($sql);
			$stmt -> bindParam(':log', $_POST['login']);
			$stmt -> execute();

			//on verifie s'il n'y a pas deja un identifiant avec le meme login
			if($stmt->rowCount() == 1){
				$errorMessage = "Pseudo déjà utilisé !";
			}
			//on verifie si les 2 mots de passe sont différents
			elseif( ($_POST['password1']) != ($_POST['password2']) ){
				$errorMessage = "Mot de passe incorrect !";
			}
			else{
				//on enregistre les nouveaux identifiants dans la BDD
				$ajout = $connexion	-> prepare("INSERT INTO USERS VALUES (:log, :pass)");
				$ajout -> bindParam(':log', $_POST['login']);	
				$ajout -> bindParam(':pass', md5($_POST['password1']));
				$ajout -> execute();

				//on redirige vers le fichier log.php
				header('Location: log.php');
				}
			}
		else{
		$errorMessage = 'Veuillez saisir tous les champs de texte !';
		}
	}
	
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
    </head>
    
    <body>
		
		<?php
			if(!empty($errorMessage)){
				echo $errorMessage;
			}
		?>
		
		<form action="inscription.php" method="post">
		
		<fieldset>
				<legend>Inscrivez-vous</legend>
				<p>
					<label for="login">Login :</label>
					<input type="text" name="login" value="" />
				</p>
				<p>
					<label for="password">Password :</label>
					<input type="password" name="password1" value="" />
					
					<label for="password">Retapez votre password :</label>
					<input type="password" name="password2" value="" />			
							
					<input type="submit" value="Enregistrer" />
					
				</p>
		</fieldset>
		</form>
    </body>
    
</html>
