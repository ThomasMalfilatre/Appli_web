<!DOCTYPE html>

<?php session_start() ?>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/jquery.ui.timepicker.js"></script>
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">	
    <title>Application Web</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
	  
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="Acceuil.php">Acceuil</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" action="Acceuil.php" method="post">
            <div class="form-group">
            <? echo $_SESSION['login'] // permet de mettre le nom de l'utilisateur courant dans la barre de menu?>
            </div>
            <a href="deconnexion.php"><button type="button" class="btn btn-success" >Deconnexion</button></a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    
    

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Liste des activités</h1>
        <p> Voici la liste de vos activités </p>
      </div>
      <?php include('liste_activite.php') ?>
      
    <form action="ajoutParticipeDB.php" method="post">
      
		  <label for="activite">Activité :</label>
			
			<select name="activite">
			<?php include('ajout_participe.php'); ?>
			</select>
			
			<label for="Date"> le </label>
			<script>
				$(function() {
				$( "#datepicker" ).datepicker();
				});
			</script>
			<input type="text" name="Date" id="datepicker"/>
			
			<label for="Heure"> à </label>
			<script>
				$(function() {
				$( "#timepicker" ).timepicker();
				});
			</script>
			<input type="text" name="Heure" id="timepicker"/>	
			
			<input type="submit" value="S'inscrire" />
    </form>
    <br />
    <br />
    <form action="suppression.php" method="post">
      <label> Supprimer une activité :</label>
      <select name="act">
        <?php include("liste_deroulante_act.php") ?>
      </select>
      <input type="submit" value="Supprimer" />
    </form> 
	
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
