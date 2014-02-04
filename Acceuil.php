<!DOCTYPE html>

<?php

	// PHP D'ENREGISTREMENT
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
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
	  
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="Acceuil.php">Acceuil</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" action="Acceuil.php" method="post">
            <div class="form-group">
              <input type="text" name="login" placeholder="Login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Connexion</button>
            <a href="inscription.php"><button type="button" name="inscription" class="btn btn-success" >Inscription</button></a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    
    

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Bienvenue!</h1>
        <p> Cette application gère les activités des clients enregistrés </p>
      </div>
    </div>

    <div class="container">


      <hr>

      <footer>
        <p>&copy; IUT ORLEANS 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
