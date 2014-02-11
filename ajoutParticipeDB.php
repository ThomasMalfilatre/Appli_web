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

	if ( $_POST['activite'] and $_POST['Date'] and $_POST['Heure'] ) { //verifie que l'utilisateur saisi bien des valeurs
	
		$requete = $connexion ->prepare("SELECT * FROM PARTICIPE where Date= :Date and Heure= :Heure");
		$d = explode('/', $_POST['Date']);
		$requete -> bindParam(':Date', date('c',mktime(0,0,0,$d[1],$d[0], $d[2])));
		$requete -> bindParam(':Heure', $_POST['Heure']);
		$requete -> execute();
		
		if($requete->rowCount() == 0) { //il n'y a pas d'activite prevue a cette heure 

			$ajout = $connexion	-> prepare("INSERT INTO PARTICIPE VALUES (:user, :act, :Date, :Heure)");
			$ajout -> bindParam(':user', $_SESSION['login']);	
			$ajout -> bindParam(':act', str_split($_POST['activite'])[0]);	
			$d = explode('/', $_POST['Date']);
			$ajout -> bindParam(':Date', date('c',mktime(0,0,0,$d[1],$d[0], $d[2])));
			$ajout -> bindParam(':Heure', $_POST['Heure']);
			$ajout -> execute();

			header("Location: activite.php");

		}

		else { 
			echo "Activite deja prevue a cette heure la " ;
		}
	}
	else {
		header("Location: activite.php");
	}
	
?>
