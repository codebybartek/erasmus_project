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
		$comments_all = $comments->fetch_comment($id);
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
								</div>	
								<?php } ?>
							</div>
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
	</script>
	

<?php }else{
		header('Location: index.php');
		exit();
	}

?>
</body>
</html>>