

<?php
	
	include_once('../includes/connection.php');
	include_once('../includes/film.php');
	include_once('../header.php');


	if(isset($_SESSION['logged_in'])) {
	
	if(isset($_GET['order'])){
		$order = explode(" ", $_GET['order']);
		$column = $order[0];
		$direct = $order[1];
	}else{
		$order = NULL;
		$column = 'Id_film';
		$direct = 'asc';
	}
	if(isset($_GET['mod'])){
		$mod =  $_GET['mod'];
	}else{
		$mod =  "no";
	}

	$film = new Film;
	$films= $film->fetch_all();

	if($mod ==="edit" || $mod ==="delete" || $mod ==="no" || $mod === "1"){
		if ($films) {
			$i = 0;
			echo '<h2>Edit film:</h2>';
			echo '<div class="container"><div class="row row-margin">';
			foreach ($films as $film){ $i++; ?> 
				<form action='admin.php?mod=edit' method='post'>	
					<article class='lg33 sm50 xs100 film_edit film padding-15'>
						<div class='film_content'>
							<img src= "<?php echo $film['img_film']; ?>" alt="<?php echo $film['title_film']; ?>">
							<input class="hidden_input" type="text" name="Id_film" value="<?php echo $film['id_film']; ?>">
							<span class="date_of_product"><input type="text" name="date_film" value="<?php echo $film['date_film']; ?>"></span>
							<span class="rate">
								<?php 
									$film2 = new Film;
									$rate = $film2->fetch_rate($film['id_film']);
									echo floor($rate['average_rate']); 
								?>	
							</span>
							<div class="body_content">
								<h3><input type="text" name="title_film" value="<?php echo $film['title_film']; ?>"></h3>
								<p><textarea rows="7" name="description_film"><?php echo $film['description_film']; ?></textarea></p>
								<span class="show_trailer">Trailer</span>
								<span class="trailer"><textarea type="text" name="trailer_film" value="<?php echo $film['trailer_film']; ?>"><?php echo $film['trailer_film']; ?></textarea></span>
								<input class="change_input" type="submit" value="Edit" name="mod2">
								<input class="delete_input" type="submit" value="Delete" name="del">
							</div>
						</div>
					</article>
				</form>
			<?php }	?>
			</div></div>
			<?php
			if($_POST){
				$Id_film = htmlspecialchars(trim($_POST['Id_film']));
				$title_film = htmlspecialchars(trim($_POST['title_film']));
				$description_film = htmlspecialchars(trim($_POST['description_film']));
				$date_film = htmlspecialchars(trim($_POST['date_film']));
				$trailer_film = htmlspecialchars(trim($_POST['trailer_film']));
				if(isset($_POST['mod2'])){
					$mod2 = htmlspecialchars(trim($_POST['mod2']));
					print_r($mod2);
				}
				if(isset($_POST['del']) && !$mod2){
					$del = htmlspecialchars(trim($_POST['del']));	
					print_r($del);
				}
				if($title_film && $description_film && $date_film && $trailer_film){
					if($mod2){
						$query = $pdo->prepare("UPDATE films SET title_film  = ? , description_film = ? , date_film = ?, trailer_film = ?  WHERE Id_film=? ");

						$query->bindValue(1, $title_film);
						$query->bindValue(2, $description_film);
						$query->bindValue(3, $date_film);
						$query->bindValue(4, $trailer_film);
						$query->bindValue(5, $Id_film);

						$query->execute();
						print_r("sdadsa");
						header('Location: index.php');
					}
				}
				if($del){
					$query = $pdo->prepare("DELETE FROM films WHERE Id_film= ? ");
					$query->bindValue(1, $Id_film);
					$query->execute();
					header('Location:admin.php');
				}
			}
		} }else if($mod ==="add"){ ?>
	
	<div class="container">
		<div class="row row-margin">
			<aside class="lg100 add_film">
				<h2>Add new film:</h2>
				<form action='?mod=add' method='post' enctype='multipart/form-data'>		
					<div class="lg50 xs100 padding-15">
						<label>Film title</label>
						<input type='text' name='title_film'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Film description</label>
						<textarea type='text' name='description_film'></textarea>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Film date of production</label>
						<input type='number' name='date_film'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Trailer</label>
						<input type='text' name='trailer_film'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Director:</label>
						<input type='text' name='director_film'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Country</label>
						<select name='country_film'>
							  <option value='1'>USA</option>
							  <option value='2'>France</option>
							  <option value='3'>UK</option>
							  <option value='4'>Spain</option>
						 </select>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Image</label>
						<input type='file' name='file'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Category</label>
						<select name='category'>
							  <option value='1'>dramat</option>
							  <option value='2'>horror</option>
							  <option value='3'>romantic</option>
							  <option value='4'>comedy</option>
						 </select>
					</div>
					<input class="submit" type='submit' name='add' value='Add'>
				</form>
			</aside>
		</div>
	</div>
	<?php
	if($_POST){
			$title_film = htmlspecialchars(trim($_POST['title_film']));
			$description_film = htmlspecialchars(trim($_POST['description_film']));
			$date_film = htmlspecialchars(trim($_POST['date_film']));
			$trailer_film = htmlspecialchars(trim($_POST['trailer_film']));
			$director_film = htmlspecialchars(trim($_POST['director_film']));
			$country_film = htmlspecialchars(trim($_POST['country_film']));
			$category = $_POST['category'];

			$file = $_FILES['file'];
	
			if($_FILES){
				$filedir = "../assets/images/".basename($file['name']);
				$type = pathinfo($file['name'], PATHINFO_EXTENSION);
				if($type == "jpg" || $type == "png")
					move_uploaded_file($file['tmp_name'], $filedir);
					print_r($filedir);
			}

			$add = htmlspecialchars(trim($_POST['add']));
			if($title_film && $description_film && $date_film && $add && $trailer_film){

				$query = $pdo->prepare("INSERT INTO films SET title_film= ? , description_film= ?, director_film= ?, id_country= ?, img_film=?, date_film= ?, trailer_film = ?, id_category= ? ");
				$query->bindValue(1, $title_film);
				$query->bindValue(2, $description_film);
				$query->bindValue(3, $director_film);
				$query->bindValue(4, $country_film);
				$query->bindValue(5, $filedir);
				$query->bindValue(6, $date_film);
				$query->bindValue(7, $trailer_film);
				$query->bindValue(8, $category);

				$query->execute();		
				

				header('Location: admin.php?mod=add');
			}
		}
	}
}
?>
