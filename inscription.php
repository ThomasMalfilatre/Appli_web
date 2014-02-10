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
				header('Location: Acceuil.php');
				}
			}
		else{
		$errorMessage = 'Veuillez saisir tous les champs de texte !';
		}
	}
	
?>


<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Application Web</title>

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
          <form class="navbar-form navbar-right" role="form" method="post">
            <div class="form-group">
              <input type="text" name="login" placeholder="Login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button action="activite.php" type="submit" class="btn btn-success">Connexion</button>
             <a href="inscription.php"><button type="button" name="inscription" class="btn btn-success" >Inscription</button></a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    
    

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
		<form action="inscription.php" method="post">
        <h1>Inscription</h1>
        <p> Veuillez entrer votre login et votre mot de passe à enregistrer </p>
        <p>
			<label for="login">Login :</label>
			<input type="text" name="login" value="" />
		</p>
		<p>
			<label for="password">Password :</label>
			<input type="password" name="password1" value="" />
		</p>
		<p>
			<label for="password">Retapez votre password :</label>
			<input type="password" name="password2" value="" />			
		</p>
		<p>					
			<input type="submit" value="Enregistrer" />
					
		</p>
	  </form>
      </div>
    </div>

    <div class="container">


      <hr>

      <footer>
        <p>&copy; IUT ORLEANS 2014</p>
      </footer>
    </div> <!-- /container -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>



