<?php

	include_once('includes/connection.php');
	include_once('includes/film.php');
	include_once('includes/comment.php');
	include_once('header.php');

	$film = new Film;

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$data = $film->fetch_data($id);
		$src_img = substr($data['img_film'],3);
		$rate = $film->fetch_rate($id);
		$comments = new Comments;
		$comments_all = $film->fetch_comment_film($id);
		if(isset($_SESSION['name'])){
			$id_user = $film->get_user_id($_SESSION['name']);
			if(isset($_POST['comment_body'])){
				$id_film = $_POST['id_film'];
				$comment_body = $_POST['comment_body'];
				$film->add_comment($id_film, $comment_body, $id_user['id_user']);
				unset($_POST['comment_body']);
				header('Location: /film.php?id='.$id);
			}
		}
?>
  	<div class="lg100 banner display_flex">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<section class="lg100 slide_content">
			<div class="container">
				<div class="row">
					<h2>The best films</h2>
					<h4>Look, watch, comment...</h4>
				</div>
			</div>
		</section>
	</div>
	<div class="lg100 film_page film">
		<div class="container">
			<div class="row">
				<div class="row row-margin">
					<div class="lg33 xs100 padding-15">
						<div class="film_content">
							<img src="<?php  echo $src_img; ?>">
							<span class="date_of_product"><?php echo $data['date_film']; ?></span>
							<span class="rate"><?php
								$rate_nr = floor($rate['average_rate']);

								$i = 5;
								while ( $i> 0) {
									if($rate_nr>0){
										echo '★';
									}else{
										echo '☆';
									}
									$i--;
									$rate_nr--;
								}

								?>
						</div>
						<div class="comments">
							<h5>Comments</h5>
							<div class="row">
								<?php foreach ($comments_all as $comment) {?>
								<div class="lg100 comment">
									<h6><?php echo $comment['name_user']; ?></h6>
									<span class="datetime"><?php echo $comment['date_comment']; ?></span>
									<p><?php echo $comment['body_comment']; ?></p>
									<?php if(isset($_SESSION['id_role'])) { if($_SESSION['id_role'] != 2) {  ?>

									<form action='admin/deleteComment.php' method="post">
								      <input type="hidden" name="deleteId" value="<?php echo $comment['id_comment']; ?>">
								       <input type="hidden" name="filmId" value="<?php echo $id; ?>">
								       <input class="delete_input_comment" type="submit" name="submit" value="Delete">
								      </form> <?php }}?>
								</div>
								<?php } ?>
							</div>
							<?php if(isset($_SESSION['logged_in'])) { ?>
								<span onclick="showAddcomment()" class="add_comment">Add new your comment</span>
								<form class="add_comment_form" id="form_comment" action="film.php?id=<?php echo $id; ?>" method="post">
									<div class="row row-margin">
										<div class="lg100 xs100 padding-15">
											<label>Comment</label>
											<textarea type='text' name='comment_body'></textarea>
										</div>
										<div class="lg100 xs100 padding-15">
											<input class="hidden_input" type="number" name="id_film" value="<?php echo $id; ?>">
											<input class="submit" type='submit' name='add' value='Add'>
										</div>
									</div>
								</form>
							<?php }?>
						</div>
					</div>
					<article class="lg66 xs100 padding-15">
						<h1><?php echo $data['title_film']; ?></h1>
						<p><?php echo $data['description_film']; ?></p>
						<?php echo htmlspecialchars_decode($data['trailer_film']); ?>
					</article>
				</div>
			</div>
		</div>
	</div>



	<script type="text/javascript">
		var slideIndex = 0;
	  	carousel();

	  	function carousel() {
	    	var i;
	    	var x = document.getElementsByClassName("slide_banner");
	    	for (i = 0; i < x.length; i++) {
	      		x[i].classList.remove("show");
	    	}
	    	slideIndex++;
	    	if (slideIndex > x.length) {slideIndex = 1}
	    		x[slideIndex-1].classList.add("show");
	    	setTimeout(carousel, 10000); // Change image every 2 seconds
	  	}
	  	function showAddcomment() {
	    	var rateForm = document.getElementById("form_comment");
	    	rateForm.style.display = "inline-block";
	    }
	</script>


<?php }else{
		header('Location: index.php');
		exit();
	}

?>
</body>
</html>>
