<?php

/**
*
*/
class Article
{

	public function fetch_all(){
		global $pdo;

		$query = $pdo->prepare("SELECT article.id_article, article.title_article, article.description_article, article.date_article, article.img_art, article.url_address ,users.name_user FROM article INNER JOIN users ON users.id_user = article.id_user ORDER BY article.date_article LIMIT 4");

		$query->execute();

		return $query->fetchAll();
	}


	/*public function add_article_film($article_title,$article_description){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO article SET article_title= ? , article_description= ?, id_film= ?");
		$query->bindValue(1, $article_title);
		$query->bindValue(2, $article_description);
		$query->bindValue(3, $id_film);
		$query->execute();
	}*/
}

?>
