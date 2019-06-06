<?php 
	
	include_once('includes/connection.php');
	include_once('includes/film.php');
	include_once('header.php');

	$film = new Film;
	$films = $film->fetch_all();
	if(isset($_GET['rate'])){
		$id = $_GET['id_film'];
		$rate = $_GET['rate'];
		$film->add_rate($id, $rate);
		header('Location:index.php');
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
									<div class="create_info">
										<span class="director"><?php echo $film['director_film']; ?></span>,
										<span class="country"><?php echo $film['country']; ?></span>
									</div>
									<a href="film.php?id=<?php echo $id; ?>" class="see_more">See more</a>
									<span onclick="showAddrate(<?php echo $id; ?>)" class="add_rate">Add your rate</span>
									<form class="add_rate_form" id="form_rate<?php echo $id; ?>" action="index.php" method="get">
											<select name='rate'>
										  		<option value='1'>★</option>
										  		<option value='2'>★★</option>
										  		<option value='3'>★★★</option>
										  		<option value='4'>★★★★</option>
										  		<option value='5'>★★★★★</option>
											</select>
											<input class="hidden_input" type="number" name="id_film" value="<?php echo $id; ?>">
											<input class="submit" type='submit' name='add' value='Add'>
									</form>
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
	  	function showAddrate(id) {
		  	var rateForm = document.getElementById("form_rate"+id);
		  	rateForm.style.display = "inline-block";
		}


	</script>
</body>
</html>