<?php 
try{
	$pdo = new PDO('mysql:host=localhost;dbname=thebestfilms', 'root', '');
}catch(PDOException $e) {
	exit('Database error...');
}
	
?>