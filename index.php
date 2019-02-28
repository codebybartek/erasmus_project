<?php 
	
	include_once('includes/connection.php');
	include_once('includes/film.php');
	include_once('header.php');

	$film = new Film;
	$films = $film->fetch_all();

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
	<div class="lg100 films">
		<div class="container">
			<div class="row">
				<section class="lg100 header_films">
					<h1>The best films - Latest films</h1>
				</section>
				<div class="row row-margin">
					<?php foreach ($films as $film) { 
						$i=0; 
						$src_img = substr($film['img_film'],3);
						$id = $film['id_film'];
						?>
						<article class="lg33 sm50 xs100 film padding-15">
							<div class="film_content">
								<a href="film.php?id=<?php echo $id; ?>"><img src="<?php echo $src_img; ?>" alt="<?php echo $film['title_film']; ?>"></a>
								<span class="date_of_product"><?php echo $film['date_film']; ?></span>
								<div class="body_content">
									<h3><?php echo $film['title_film']; ?></h3>
									<p><?php echo $film['description_film']; ?></p>
									<a href="film.php?id=<?php echo $id; ?>" class="see_more">See more</a>
								</div>
							</div>
						</article>
						<?php 
							if($i==3){
								$i = 0;
								echo '</div><div class="row row-margin">';
							}}
						?>
				</div>
			</div>
		</div>
	</div>
	<footer class="lg100">
		<p>Copyrigts BARTEK</p>
	</footer>
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
</body>
</html>