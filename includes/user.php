<?php

/**
* 
*/
class User
{
	
	public function fetch_all(){
		global $pdo;

		$query = $pdo->prepare("SELECT users.id_user, users.name_user, users.email_user , roles.name_role FROM users INNER JOIN roles ON users.id_role=roles.id_role");

		$query->execute();

		return $query->fetchAll();
	}

	public function fetch_one($id){
		global $pdo;

		$query = $pdo->prepare("SELECT users.id_user, users.name_user, users.email_user, users.password_user, users.id_role, roles.name_role FROM users INNER JOIN roles ON users.id_role=roles.id_role WHERE users.id_user = :id_user");
		$query->execute(['id_user' => $id]);

		$query->execute();

		return $query->fetch();
	}

}

?>