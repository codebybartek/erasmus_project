<?php

include_once('includes/connection.php');
include_once('includes/series.php');
include_once('includes/film.php');
include_once('includes/comment.php');
include_once('header.php');

$series = new Series;




if(isset($_GET['id'])){
	$id = $_GET['id'];
	$data = $series->fetch_data($id);
	$src_img = substr($data['img_series'],3);
	$rate = $series->fetch_rate_series($id);
	$season_list = $series->fetch_season($id);
	$comments = new Comments;
	$comments_all = $comments->fetch_comment_series($id);
	if(isset($_SESSION['name'])){
		$id_user = $series->get_user_id($_SESSION['name']);
		if(isset($_POST['comment_body'])){
			$id_series= $_POST['id_series'];
			$comment_body = $_POST['comment_body'];
			$series->add_comment($id_series, $comment_body, $id_user['id_user']);
			unset($_POST['comment_body']);
			header('Location: /series.php?id='.$id);
		}
		if(isset($_GET['rate1'])){
			$id1 = $_GET['id_season'];
			$rate1 = $_GET['rate1'];
			$series->add_rate_season($id1, $rate1);
		}
		if(isset($_GET['rate2'])){
			$id2 = $_GET['id_episode'];
			$rate2 = $_GET['rate2'];
			$series->add_rate_episode($id2, $rate2);
		}
		if(isset($_GET['title_episode'], $_GET['description_episode'], $_GET['date_episode'])){
			$id3 = $_GET['id_season_add'];
			$title_episode = $_GET['title_episode'];
			$description_episode = $_GET['description_episode'];
			$date_episode = $_GET['date_episode'];
			$series->add_episode($date_episode, $title_episode, $description_episode, $id3);
            header('Location: /series.php?id='.$id);
		}
		if(isset($_GET['season_name'], $_GET['season_year'])){
			$id = $_GET['id_series_add'];
			$season_name = $_GET['season_name'];
			$season_year = $_GET['season_year'];

			$series->add_season($season_name, $season_year, $id);
            header('Location: /series.php?id='.$id);
		}


		// DELETE SEASON

		if($_POST){
			if(isset($_POST['del_season'])){

				$id_season = $_POST['id_season'];
				$query = $pdo->prepare("DELETE FROM season WHERE id_season= ? ");
				$query->bindValue(1, $id_season);
				$query->execute();
			}
			if(isset($_POST['del_episode'])){
				$id_episode = htmlspecialchars(trim($_POST['id_episode']));
				$del = htmlspecialchars(trim($_POST['del_episode']));
				if($del){
					$query = $pdo->prepare("DELETE FROM episode WHERE id_episode= ? ");
					$query->bindValue(1, $id_episode);
					$query->execute();
				}
			}
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
					<h2>The best series</h2>
					<h4>Look, watch, comment...</h4>
				</div>
			</div>
		</section>
	</div>
	<div class="lg100 film_page film">
		<div class="container">
			<div class="row row-margin">
				<div class="lg33 xs100 padding-15">
					<div class="film_content">
						<img src="<?php  echo $src_img; ?>">
						<span class="date_of_product"><?php echo $data['date_series']; ?></span>
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
								       <input type="hidden" name="seriesId" value="<?php echo $id; ?>">
								       <input class="delete_input_comment" type="submit" name="submit" value="Delete">
								      </form> <?php }}?>
								</div>
								<?php } ?>
							</div>
							<?php if(isset($_SESSION['logged_in'])) { ?>
								<span onclick="showAddcomment()" class="add_comment">Add new your comment</span>
								<form class="add_comment_form" id="form_comment" action="series.php?id=<?php echo $id; ?>" method="post">
									<div class="row row-margin">
										<div class="lg100 xs100 padding-15">
											<label>Comment</label>
											<textarea type='text' name='comment_body'></textarea>
										</div>
										<div class="lg100 xs100 padding-15">
											<input class="hidden_input" type="number" name="id_series" value="<?php echo $id; ?>">
											<input class="submit" type='submit' name='add' value='Add'>
										</div>
									</div>
								</form>
							<?php }?>
					</div>
				</div>
				<article class="lg66 xs100 padding-15">
					<h1><?php echo $data['title_series']; ?></h1>
					<p><?php echo $data['description_series']; ?></p>
					<?php echo htmlspecialchars_decode($data['trailer_series']); ?>
				</article>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php if(isset($_SESSION['logged_in'])) { ?>
			<?php if(isset($_SESSION['id_role'])) { if($_SESSION['id_role'] != 2) { ?>
			<details>
				<summary>Add new season</summary>
				<form class="add_season" id="add_season<?php echo $id; ?>" action="" method="get">
					<input class="hidden_input" type="number" name="id" value="<?php echo $id; ?>">
					<div class="lg50 xs100 padding-15">
						<label>Season title</label>
						<input type='number' name='season_name'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Season year</label>
						<input type='number' min="1900" max="2099" step="1" name='season_year'>
					</div>
					<input class="hidden_input" type="number" name="id_series_add" value="<?php echo $id; ?>">
					<input class="submit" type='submit' name='add' value='Add'>
				</form>
			</details>
			<?php }} ?>
		</div>
		<div class="row">
			<?php }
				if(is_array($season_list)){
					foreach ($season_list as $season) {
						$id_season=$season['id_season'];
						$series2 = new Series;
						$rate_season = $series2->fetch_rate_season($id_season);
						$episode_list = $series2->fetch_episode($id_season);

			?>
			<section class="lg100 season">
				<h2>Season <?php echo $season['season_name']?> (<?php echo $season['season_year'] ?>)</h2>
				<span class="rate"><b>Season rate:</b> <?php
				$rate_nr = floor($rate_season['average_rate']);

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
				<?php if(isset($_SESSION['logged_in'])) { ?>
					<span onclick="showAddrateSeason(<?php echo $id_season; ?>)" class="add_rate">Add your rate</span>
					<form class="add_rate_form" id="form_rate_season<?php echo $id_season; ?>" action="" method="get">
						<input class="hidden_input" type="number" name="id" value="<?php echo $id; ?>">
						<select name='rate1'>
							<option value='1'>★</option>
							<option value='2'>★★</option>
							<option value='3'>★★★</option>
							<option value='4'>★★★★</option>
							<option value='5'>★★★★★</option>
						</select>
						<input class="hidden_input" type="number" name="id_season" value="<?php echo $id_season; ?>">
						<input class="submit" type='submit' name='add' value='Add' onclick="setCookie('id_rate_season:<?php echo $id_season; ?>', 1)">
					</form>
					<?php if(isset($_SESSION['id_role'])) { if($_SESSION['id_role'] != 2) { ?>
					<form action='' method='post'>
						<input class="hidden_input" type="text" name="id_season" value="<?php echo $id_season; ?>">
						<input class="delete_input" type="submit" value="Delete" name="del_season">
					</form>

					<?php }} } ?>

					<details class="episode">
						<summary>Show episodes</summary>
						<?php
						foreach ($episode_list as $episode){

							$id_episode=$episode['id_episode'];

							$rate_episode = $series2->fetch_rate_episode($id_episode);
							?>
							<div class="episode_header">
								<h3>Episode <?php echo $episode['episode_name']?> (<?php echo $episode['episode_aired'] ?>)</h3>
								<span class="rate"><b>Episode rate: </b><?php
								$rate_nr = floor($rate_episode['average_rate']);

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
								<?php if(isset($_SESSION['logged_in'])) { ?>
									<div class="add_rate_episode">
										<span onclick="showAddrateEpisode(<?php echo $id_episode; ?>)" class="add_rate">Add your rate</span>
										<form class="add_rate_form" id="form_rate_episode<?php echo $id_episode; ?>" action="" method="get">
											<input class="hidden_input" type="number" name="id" value="<?php echo $id; ?>">
											<select name='rate2'>
												<option value='1'>★</option>
												<option value='2'>★★</option>
												<option value='3'>★★★</option>
												<option value='4'>★★★★</option>
												<option value='5'>★★★★★</option>
											</select>
											<input class="hidden_input" type="number" name="id_episode" value="<?php echo $id_episode; ?>">
											<input class="submit" type='submit' name='add' value='Add'  onclick="setCookie('id_rate_episode:<?php echo $id_episode; ?>', 1)">
										</form>
									</div>
									<?php }?>

							</div>
							<div class="episode_body">
								<p><?php echo $episode['episode_description']?></p>
								<?php if(isset($_SESSION['id_role'])) { if($_SESSION['id_role'] != 2) { ?>
									<form action='' method='post'>
										<input class="hidden_input" type="text" name="id_episode" value="<?php echo $id_episode; ?>">
										<input class="delete_input" type="submit" value="Delete" name="del_episode">
									</form>
								<?php }} ?>
							</div>
						<?php } ?>

					</details>
					<div class="row episode_add">
							<?php if(isset($_SESSION['logged_in'])) { ?>
							<?php if(isset($_SESSION['id_role'])) { if($_SESSION['id_role'] != 2) { ?>
								<details>
									<summary>Add new episode</summary>
									<form class="add_episode" id="add_episode<?php echo $id_season; ?>" action="" method="get">
										<input class="hidden_input" type="number" name="id" value="<?php echo $id; ?>">
										<div class="lg50 xs100 padding-15">
											<label>Episode title</label>
											<input type='text' name='title_episode'>
										</div>
										<div class="lg50 xs100 padding-15">
											<label>Episode aired date</label>
											<input type='date' name='date_episode'>
										</div>
										<div class="lg100 xs100 padding-15">
											<label>Episode description</label>
											<textarea type='text' name='description_episode'></textarea>
										</div>
										<input class="hidden_input" type="number" name="id_season_add" value="<?php echo $id_season; ?>">
										<input class="submit" type='submit' name='add' value='Add'>
									</form>
								</details>
							<?php } }}
							echo "</div></section>";

						}

					}
					?>

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
	    function showAddrateSeason(id) {
	    	var rateForm = document.getElementById("form_rate_season"+id);
	    	if(getCookie('id_rate_season:' + id)){
	    		alert("You could add rate only one time!");
	    	}else{
		    	if(rateForm.style.display === "inline-block"){
		    		rateForm.style.display = "none";
		    	}else{
		    		rateForm.style.display = "inline-block";
		    	}
		    }
	    }
	    function showAddrateEpisode(id) {
	    	var rateForm = document.getElementById("form_rate_episode"+id);
	    	if(getCookie('id_rate_episode:' + id)){
	    		alert("You could add rate only one time!");
	    	}else{
		    	if(rateForm.style.display === "inline-block"){
		    		rateForm.style.display = "none";
		    	}else{
		    		rateForm.style.display = "inline-block";
		    	}
		    }
	    }
	    function showAddcomment() {
	    	var rateForm = document.getElementById("form_comment");
	    	rateForm.style.display = "inline-block";
	    }

	    // COOKIES

	    function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }

	</script>


<?php }else{
	header('Location: index.php');
	exit();
}

?>
</body>
</html>>
