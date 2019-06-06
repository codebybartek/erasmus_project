<?php

	include_once('../includes/connection.php');
	include_once('../includes/film.php');
	session_start();

	$film = new Film;

	if(isset($_POST['deleteId']) && isset($_SESSION['id_role'])) {
		if($_SESSION['id_role'] != 2) {
			global $pdo;
			$query = $pdo->prepare("DELETE FROM comments WHERE id_comment = ? ");
			$query->bindValue(1, $_POST['deleteId']);
			$query->execute();
			if(isset($_POST['seriesId'])){
                header('Location: /series.php?id=' . $_POST['seriesId']);
            }else {
                header('Location: /film.php?id=' . $_POST['filmId']);
            }
		}
	}else{
		print_r("expression");
	}

?>
