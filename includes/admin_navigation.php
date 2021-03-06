<?php if(isset($_SESSION['id_role'])) { if($_SESSION['id_role'] != 2) {  ?>
	<div class="lg100 banner display_flex">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<section class="lg100 slide_content">
			<div class="filter_banner"></div>
			<div class="container">
				<div class="row">
					<div class="lg100 login_content">
						<h3>Hello: <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?></h3>
						<h1>What you would like to do?</h1>
						<div class="nav_admin">
							<ul>
								<li><a href="admin/admin.php?mod=add">Add new film</a></li>
								<li><a href="admin/admin.php?mod=addSeries">Add new series</a></li>
								<li><a href="admin/admin.php?mod=edit">Edit film</a></li>
								<li><a href="admin/admin.php?mod=editSeries">Edit series</a></li>
								<?php if(isset($_SESSION['id_role'])) { if($_SESSION['id_role'] == 1) { ?>
									<li><a href="admin/users.php">Users</a></li>
                                    <li><a href="admin/articles.php">Articles</a></li>
								<?php }} ?>
							</ul>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php }else{ header('Location:film.php'); }} ?>
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
