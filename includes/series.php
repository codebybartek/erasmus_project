<?php

/**
* 
*/
class Series
{
	
	public function fetch_all(){
		global $pdo;

		$query = $pdo->prepare("SELECT series.id_series, countries.country, series.title_series, series.description_series, series.img_series, series.date_series, series.director_series, series.trailer_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category INNER JOIN countries ON countries.id_country=series.id_country");

		$query->execute();

		return $query->fetchAll();
	}

	public function fetch_data($id){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM series WHERE id_series = :id_series");
		$query->execute(['id_series' => $id]); 

		return $query->fetch();
	}

	public function get_user_id($name){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users WHERE name_user = :name");
		$query->execute(['name' => $name]); 

		return $query->fetch();
	}

	public function fetch_season($id){
		global $pdo;
		$query = $pdo->prepare("SELECT season.id_season, season.season_name,season.season_year FROM series INNER JOIN season ON season.id_series=series.id_series WHERE series.id_series = :id_series");
		$query->execute(['id_series' => $id]); 

		return $query->fetchAll();
	}

	public function add_season($season_name,$season_year,$id_series){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO season SET season_name= ? , season_year= ?, id_series= ?");
		$query->bindValue(1, $season_name);
		$query->bindValue(2, $season_year);
		$query->bindValue(3, $id_series);
		$query->execute();		
	}
	
	public function fetch_episode($id){
		global $pdo;
		$query = $pdo->prepare("SELECT episode.id_episode, episode.episode_name, episode.episode_aired, episode.episode_description FROM season INNER JOIN episode ON episode.id_season=season.id_season  WHERE season.id_season = :id_season ");
		$query->execute(['id_season' => $id]); 

		return $query->fetchAll();
	}

	public function add_comment($id, $comment, $user){
		global $pdo;
		$date = date('Y-m-d H:i:s');
		$query = $pdo->prepare("INSERT INTO comments (id_series, body_comment, id_user, date_comment) VALUES (:id_series, :comment, :user, :currentDate)");
		$query->execute(['id_series' => $id, 'comment' =>  $comment, 'user' =>  $user, 'currentDate' => $date]);
	}

	public function add_episode($episode_aired,$episode_name,$episode_description,$id_season){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO episode SET episode_aired= ? , episode_name= ?, episode_description= ?, id_season= ?");
		$query->bindValue(1, $episode_aired);
		$query->bindValue(2, $episode_name);
		$query->bindValue(3, $episode_description);
		$query->bindValue(4, $id_season);
		$query->execute();
	}

	public function fetch_rate_series($id){
		global $pdo;
		$query = $pdo->prepare("SELECT AVG(rates.rate) AS average_rate FROM rates INNER JOIN series ON series.id_series = rates.id_series WHERE rates.id_series = :id_series");
		$query->execute(['id_series' => $id]);

		return $query->fetch(); 
		
	}
	public function fetch_rate_season($id){
		global $pdo;
		$query = $pdo->prepare("SELECT AVG(rates.rate) AS average_rate FROM rates INNER JOIN season ON season.id_season = rates.id_season WHERE rates.id_season = :id_season");
		$query->execute(['id_season' => $id]);

		return $query->fetch(); 
		
	}
	public function fetch_rate_episode($id){
		global $pdo;
		$query = $pdo->prepare("SELECT AVG(rates.rate) AS average_rate FROM rates INNER JOIN episode ON episode.id_episode = rates.id_episode WHERE rates.id_episode = :id_episode");
		$query->execute(['id_episode' => $id]);

		return $query->fetch(); 
		
	}

	public function add_rate_series($id, $rate){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO rates (id_series, rate) VALUES (:id_series, :rate)");
		$query->execute(['id_series' => $id, 'rate' =>  $rate]);
	}
	public function add_rate_season($id, $rate){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO rates (id_season, rate) VALUES (:id_season, :rate)");
		$query->execute(['id_season' => $id, 'rate' =>  $rate]);
	}
	public function add_rate_episode($id, $rate){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO rates (id_episode, rate) VALUES (:id_episode, :rate)");
		$query->execute(['id_episode' => $id, 'rate' =>  $rate]);
	}

	public function fetch_selcted($column, $direct){
		global $pdo;
		$order = "DESC";
		if($column=='Id_series'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY Id_series ASC");
			}else{
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY Id_series DESC");
			}
		}else if($column=='title_series'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY title_series ASC");
			}else{
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY title_series DESC");
			}
		}else if($column=='description_series'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY description_series ASC");
			}else{
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY description_series DESC");
			}
		}else if($column=='rate_series'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY rate_series ASC");
			}else{
				$query = $pdo->prepare("SELECT series.title_series, series.description_series, series.img_film, series.date_series, category.name_category FROM series INNER JOIN category ON category.id_category=series.id_category ORDER BY rate_series DESC");
			}
		}else{
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT * FROM series ORDER BY date_series ASC");
			}else{
				$query = $pdo->prepare("SELECT * FROM series ORDER BY date_series DESC");
			}
		}
		
		$query->execute();

		return $query->fetchAll();
	}
}

?>