<?php
	
	include_once('includes/connection.php');
	include_once('header.php');

	if(isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$date = date('Y-m-d H:i:s');

		$query = $pdo->prepare("UPDATE `users` SET name_user= :name, password_user= :password, email_user= :email, id_role=2 ,created_data= :data WHERE id_user = :id_user");

		$query->execute(['name' => $username, 'password' => $password, 'email' => $email, 'data' => $date, 'id_user' => $id_user]); 

		$_SESSION['logged_in'] = true;
		$_SESSION['name'] = $username;
		header('Location: admin/admin.php');
	}
?>

	<div class="lg100 banner display_flex">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<img class="slide_banner" src="assets/images/banner2.jpg">
		<section class="lg100 slide_content">
			<div class="filter_banner"></div>
			<div class="container">
				<div class="row">
					<div class="lg100 user_acces_content">
						<form class="user_acces_form" action="register.php" method="post">
							<div class="row row-margin">
								<div class="lg100 xs100 padding-15">
									<label>Username</label>
									<input type="text" name="username" placeholder="Enter your username" />
								</div>
								<div class="lg100 xs100 padding-15">
									<label>Email</label>
									<input type="text" name="email" placeholder="Enter your email" />
									<?php if(isset($errorEmail)){ ?>
										<span class="error"><?php echo $errorEmail; ?></span>
									<?php } ?>
								</div>
								<div class="lg100 xs100 padding-15">
									<label>Password</label>
									<input type="password" name="password" placeholder="Enter your password" />
								</div>
								<input class="submit" type="submit" name="submit" value="Login">
								<?php if(isset($error)){ ?>
										<span class="error"><?php echo $error; ?></span>
								<?php } ?>
							</div>
						</form>						
					</div>
				</div>
			</div>
		</section>
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
	</body>
</html>
