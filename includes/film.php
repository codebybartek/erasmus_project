<?php

/**
* 
*/
class Film
{
	
	public function fetch_all(){
		global $pdo;

		$query = $pdo->prepare("SELECT films.id_film, films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category
");
		$query->execute();

		


		return $query->fetchAll();
	}

	public function fetch_data($id){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM films WHERE Id_film = :id_film");
		$query->execute(['id_film' => $id]); 

		return $query->fetch();
	}

	public function fetch_selcted($column, $direct){
		global $pdo;
		$order = "DESC";
		if($column=='Id_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY Id_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY Id_film DESC");
			}
		}else if($column=='title_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY title_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY title_film DESC");
			}
		}else if($column=='description_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY description_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY description_film DESC");
			}
		}else if($column=='rate_film'){
			if($direct==='asc'){
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY rate_film ASC");
			}else{
				$query = $pdo->prepare("SELECT films.title_film, films.description_film, films.img_film, films.rate_film, films.date_film, category.name_category FROM films INNER JOIN category ON category.id_category=films.id_category ORDER BY rate_film DESC");
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