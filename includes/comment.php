<?php 


/**
		Comments - get all comments and show on film page. 
		Edit or delete comment if you are user. 
		Add new one. 

**/
class Comments 
{
	
	public function fetch_comment($id){
		global $pdo;
		$query = $pdo->prepare("SELECT comments.body_comment, comments.date_comment, users.name_user FROM comments INNER JOIN users ON comments.id_user=users.id_user WHERE comments.id_film = :id_film");
		$query->execute(['id_film' => $id]);

		return $query->fetchAll();
	}
}


?>