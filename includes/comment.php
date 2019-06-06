<?php


/**
		Comments - get all comments and show on film page.
		Edit or delete comment if you are user.
		Add new one.

**/
class Comments
{

	public function fetch_comment_film($id){
		global $pdo;
		$query = $pdo->prepare("SELECT comments.body_comment, comments.date_comment, users.name_user FROM comments INNER JOIN users ON comments.id_user=users.id_user WHERE comments.id_film = :id_film");
		$query->execute(['id_film' => $id]);
		return $query->fetchAll();
	}
	public function fetch_comment_series($id){
		global $pdo;
		$query = $pdo->prepare("SELECT comments.id_comment, comments.body_comment, comments.date_comment, users.name_user FROM comments INNER JOIN users ON comments.id_user=users.id_user WHERE comments.id_series = :id_series");
		$query->execute(['id_series' => $id]);
		return $query->fetchAll();
	}
	public function fetch_comment_season($id){
		global $pdo;
		$query = $pdo->prepare("SELECT comments.body_comment, comments.date_comment, users.name_user FROM comments INNER JOIN users ON comments.id_user=users.id_user WHERE comments.id_season = :id_season");
		$query->execute(['id_season' => $id]);
		return $query->fetchAll();
	}
		public function fetch_comment_episode($id){
		global $pdo;
		$query = $pdo->prepare("SELECT comments.body_comment, comments.date_comment, users.name_user FROM comments INNER JOIN users ON comments.id_user=users.id_user WHERE comments.id_episode = :id_episode");
		$query->execute(['id_episode' => $id]);

		return $query->fetchAll();
	}
}


?>
