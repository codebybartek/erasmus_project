<?php
	
	include_once('includes/connection.php');
	include_once('header.php');

	if(isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$date = date('Y-m-d H:i:s');

		$error = null;
		$errorEmail = null;

		if(empty($username) or empty($password)) {
			$error = 'All fields are required!';
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !$error){
			$errorEmail = 'Invalid email';
		}
		if(!$error && !$errorEmail){
			$query = $pdo->prepare("INSERT INTO users (name_user, password_user, email_user, id_role, created_data) VALUES (:name, :password, :email,2, :data)");

			$query->execute(['name' => $username, 'password' => $password, 'email' => $email, 'data' => $date]); 

			$_SESSION['logged_in'] = true;
			$_SESSION['name'] = $username;
			header('Location:login.php');
		}
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
									<input type="text" name="password" placeholder="Enter your password" />
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
