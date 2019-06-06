<?php

	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	session_start();

	$article = new Article;

	if(isset($_POST['deleteId']) && isset($_SESSION['id_role'])) {
		if($_SESSION['id_role'] != 2) {
			global $pdo;
			$query = $pdo->prepare("DELETE FROM article WHERE id_article = ? ");
			$query->bindValue(1, $_POST['deleteId']);
			$query->execute();
			header('Location: /admin/articles.php');
		}
	}else{
		print_r("expression");
	}

?>
