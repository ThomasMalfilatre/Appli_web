<?php
	session_start();
	echo "Au revoir, ".$_SESSION['login']." vous avez ete deconnecte.";
	session_destroy();

	// header("Location: log.php");
?>