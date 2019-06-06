<?php

	include_once('../includes/connection.php');
	include_once('../includes/user.php');
	session_start();

	$user = new User;

	if(isset($_POST['deleteId']) && isset($_SESSION['id_role'])) {
		if($_SESSION['id_role'] != 2) {
			global $pdo;
			$query = $pdo->prepare("DELETE FROM users WHERE id_user = ? ");
			$query->bindValue(1, $_POST['deleteId']);
			$query->execute();
			header('Location: /admin/users.php');
		}
	}else{
		print_r("expression");
	}

?>
