

<?php

	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	include_once('../header.php');


	if(isset($_SESSION['logged_in']) && isset($_SESSION['id_role'])) {
	if($_SESSION['id_role'] == 1) {


	$article = new Article();
	$articles= $article->fetch_all();


	if(isset($_GET['mod'])){
		$mod =  $_GET['mod'];
		if(isset($_POST['add']) && $mod=='add'){
			$title_article = htmlspecialchars($_POST['title_article']);
			$description_article = htmlspecialchars($_POST['description_article']);
			$address = htmlspecialchars($_POST['url_address']);
			$file = $_FILES['file'];
                if($_FILES){
                    $filedir = "../assets/images/".basename($file['name']);
                    $type = pathinfo($file['name'], PATHINFO_EXTENSION);
                    if($type == "jpg" || $type == "png")
                        move_uploaded_file($file['tmp_name'], $filedir);
                }
			$date = date('Y-m-d H:i:s');
			$query = $pdo->prepare("INSERT INTO article (title_article, description_article, date_article, img_art, id_user, url_address) VALUES  (:title_article, :description_article , :date_article, :img_art, :id_user, :address)");

			$query->execute(['title_article' => $title_article, 'description_article' =>  $description_article, 'date_article' =>  $date, 'img_art' => $filedir, 'id_user' => 1, 'address' => $address]);
			header('Location: /admin/articles.php');

		}
	}


?>

	<div class="container">
		<div class="row row-margin">
			<aside class="lg100 add_film">
				<h2>Users:</h2>
				<table class="table_users">
				  <tr>
				    <th>Id</th>
				    <th>Title</th>
				    <th>Description</th>
				    <th>Date</th>
                    <th>Url address</th>
				    <th>Delete</th>
				  </tr>
				  <?php foreach ($articles as $article) { ?>
				  <tr>
				    <td><?php echo $article['id_article']; ?></td>
				    <td><?php echo $article['title_article']; ?></td>
				    <td><?php echo $article['description_article']; ?></td>
				    <td><?php echo $article['date_article']; ?></td>
                      <td><a href="<?php echo $article['url_address']; ?>"><?php echo $article['url_address']; ?></a></td>
				    <td><form action='deleteArticle.php' method="post">
				       		<input type="hidden" name="deleteId" value="<?php echo $article['id_article']; ?>">
				       		<input class="delete_input_user" type="submit" name="submit" value="Delete">
				     	</form>
				    </td>
				  </tr>
				  <?php } ?>
				</table>
			</aside>
		</div>
	</div>

	<div class="container">
		<div class="row row-margin">
			<aside class="lg100 add_user add_film">
				<h2 class="buttonLink" onclick="showAddForm()">Add aricle &Xi;</h2>
				<form action='?mod=add' method='post' enctype='multipart/form-data' id="addForm">
					<div class="lg50 xs100 padding-15">
						<label>Article title: </label>
						<input type='text' name='title_article' >
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Article description: </label>
                        <textarea name='description_article'></textarea>
					</div>
                    <div class="lg50 xs100 padding-15">
                        <label>Article url: </label>
                        <input type='text' name='url_address'>
                    </div>
                    <div class="lg50 xs100 padding-15">
                        <label>Image</label>
                        <input type='file' name='file'>
                    </div>
					<input class="submit" type='submit' name='add' value='Add'>
				</form>
			</aside>
		</div>
	</div>

	<script type="text/javascript">
		function showAddForm() {
	    	var form = document.getElementById("addForm");
	    	if(form.style.display === "block"){
	    		form.style.display = "none";
	    	}else{
	    		form.style.display = "block";
	    	}
	    }
	</script>


<?php }} ?>
