<!DOCTYPE HTML>

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
		if(!empty($_POST['login']) && !empty($_POST['password'])){
			//sont il dans la base de données ?

			$sql = "SELECT * FROM USERS WHERE login = :log AND passwd = :pass";
			$stmt = $connexion -> prepare($sql);
			$stmt -> bindParam(':log', $_POST['login']);
			$stmt -> bindParam(':pass', md5($_POST['password']));
			$stmt -> execute();

			if($stmt->rowCount() != 1){
				$errorMessage = "Mauvais identifiants !";
			}
			else{
				// on ouvre la session
				session_start();
				// on enregistre le login de session
				$_SESSION['login'] = $_POST['login'];
				//on redirige vers le fichier suite.php
				header('Location: activite.php');
			}
		}
		else{
			$errorMessage = 'Veuillez inscrire vos identifiants !';
		}
	}
?>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Formulaire d'authentification</title>
		        <!-- CSS bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="jumbotron.css" rel="stylesheet">
	</head>
	<body>
		<?php
			if(!empty($errorMessage)){
				echo $errorMessage;
			}
		?>
		
		
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
		
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<fieldset>
				<legend>Identifiez-vous</legend>
				<p>
					<label for="login">Login :</label>
					<input type="text" name="login" value="" />
				</p>
				<p>
					<label for="password">Password :</label>
					<input type="password" name="password" value="" />
					<input type="submit" value="Se logger" />
				</p>
				<input type="button" value="s'inscrire" onclick="document.location.replace('inscription.php')" />
			</fieldset>
		</form>
	</body>
</html>
