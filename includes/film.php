<?php

/**
*
*/
class Film
{

	public function fetch_all(){
		global $pdo;

		$query = $pdo->prepare("SELECT films.id_film, countries.country, films.title_film, films.description_film, films.director_film, films.img_film, films.trailer_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category INNER JOIN countries ON countries.id_country=films.id_country");

		$query->execute();

		return $query->fetchAll();
	}

	public function fetch_data($id){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM films WHERE Id_film = :id_film");
		$query->execute(['id_film' => $id]);

		return $query->fetch();
	}
	public function get_user_id($name){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users WHERE name_user = :name");
		$query->execute(['name' => $name]);

		return $query->fetch();
	}

	public function fetch_rate($id){
		global $pdo;
		$query = $pdo->prepare("SELECT films.title_film, AVG(rates.rate) AS average_rate FROM rates INNER JOIN films ON films.id_film = rates.id_film WHERE rates.id_film = :id_film");
		$query->execute(['id_film' => $id]);

		return $query->fetch();
	}

	public function fetch_top_films(){
		global $pdo;
		$query = $pdo->prepare("SELECT films.Id_film, films.title_film, films.description_film, films.img_film, films.date_film, films.director_film, films.id_country, films.trailer_film, films.id_category, AVG(rates.rate) AS average_rate FROM rates INNER JOIN films ON films.id_film = rates.id_film GROUP BY films.Id_film ORDER BY average_rate DESC LIMIT 3");
		$query->execute();

		return $query->fetchAll();
	}

	public function add_rate($id, $rate){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO rates (id_film, rate) VALUES (:id_film, :rate)");
		$query->execute(['id_film' => $id, 'rate' =>  $rate]);
	}

	public function fetch_comment_film($id){
		global $pdo;
		$query = $pdo->prepare("SELECT comments.id_comment, comments.body_comment, comments.date_comment, users.name_user FROM comments INNER JOIN users ON comments.id_user=users.id_user  WHERE comments.id_film = :id_film");
		$query->execute(['id_film' => $id]);
		return $query->fetchAll();
	}

	public function add_comment($id, $comment, $user){
		global $pdo;
		$date = date('Y-m-d H:i:s');
$query = $pdo->prepare("INSERT INTO comments (id_film, body_comment, id_user, date_comment) VALUES (:id_film, :comment, :user, :currentDate)");
		$query->execute(['id_film' => $id, 'comment' =>  $comment, 'user' =>  $user, 'currentDate' => $date]);
	}

	public function fetch_selcted($column, $direct){
		global $pdo;
		$order = "DESC";
		if($column=='Id_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY Id_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY Id_film DESC");
			}
		}else if($column=='title_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY title_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY title_film DESC");
			}
		}else if($column=='description_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY description_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY description_film DESC");
			}
		}else if($column=='rate_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY rate_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY rate_film DESC");
			}
		}else{
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT * FROM films ORDER BY date_film ASC");
			}else{
				$query = $pdo->prepare("SELECT * FROM films ORDER BY date_film DESC");
			}
		}

		$query->execute();

		return $query->fetchAll();
	}
}

?>
