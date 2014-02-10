<!DOCTYPE html>

<?php session_start() ?>

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
          <form class="navbar-form navbar-right" role="form" action="Acceuil.php" method="post">
            <div class="form-group">
              <input type="text" name="login" placeholder="Login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Connexion</button>
            <a href="inscription.php"><button type="button" name="inscription" class="btn btn-success" >Inscription</button></a>
            <a href="deconnexion.php"><button type="button" class="btn btn-success" >Deconnexion</button></a>
            <? echo $_SESSION['login'] // permet de mettre le nom de l'utilisateur courant dans la barre de menu?>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    
    

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Liste des activités</h1>
        <p> Voiçi la liste de vos activités </p>
      </div>
      <?php include('liste_activite.php') ?>
      <label for="activite">Activité :</label>
		<select name="activite">
		<?php include('ajout_participe.php'); ?>
		</select>
		<label for="creneau">Creneau horaire</label>

		<link rel="stylesheet" href="css/jquery-ui.css">
			<script src="js/jquery-1.9.1.js"></script>
			<script src="js/jquery-ui.js"></script>
			<script>
			$(function() {
			$( "#datepicker" ).datepicker();
			});
		</script>

		<input type="text" name="creneau" id="datepicker"/>
		<input type="submit" value="S'inscrire" />
	</p>
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
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
