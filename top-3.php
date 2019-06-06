<?php

include_once('includes/connection.php');
include_once('includes/film.php');
include_once('header.php');

$film = new Film;
$films = $film->fetch_top_films();
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
				<h1>Top 3 films</h1>
			</section>
			<div class="row row-margin">
				<?php foreach ($films as $film) {
					$i=0;
					$src_img = substr($film['img_film'],3);
					$id = $film['Id_film'];
					$film2 = new Film;
					$rate = $film2->fetch_rate($id);
					?>
					<article class="lg33 sm50 xs100 film padding-15">
						<div class="film_content">
							<a href="film.php?id=<?php echo $id; ?>"><img src="<?php echo $src_img; ?>" alt="<?php echo $film['title_film']; ?>"></a>
							<span class="date_of_product"><?php echo $film['date_film']; ?></span>
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

							?></span>
							<div class="body_content">
								<h3><?php echo $film['title_film']; ?></h3>
								<p>
									<?php
									$max_length = 350;
									if (strlen($film['description_film']) > $max_length)
									{
										$offset = ($max_length - 3) - strlen($film['description_film']);
										$description = substr($film['description_film'], 0, strrpos($film['description_film'], ' ', $offset)) . '...';
										echo $description;
									}else{
										echo $film['description_film'];
									}
									?>
								</p>
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
    <footer class="lg100 footer" style="text-align: center; padding: 40px 0;">
        <p>Copyrigts THEBESTFILMS</p>
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
