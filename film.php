<?php

	include_once('includes/connection.php');
	include_once('includes/film.php');

	$film = new Film;

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$data = $film->fetch_data($id);

		print_r($data);
	}else{
		header('Location: index.php');
		exit();
	}

?>