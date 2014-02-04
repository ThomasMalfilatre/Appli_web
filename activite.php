<!DOCTYPE html>

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










<html>
	<head>
		<meta charset="utf-8" />
	</head>

	

	<input type="button" value="participe" onclick="document.location.replace('ajout_participe.php')" />
	<input type="button" value="deconnexion" onclick="document.location.replace('deconnexion.php')" />

</html>	
