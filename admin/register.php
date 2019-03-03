<?php
	
	include_once('includes/connection.php');
	include_once('header.php');
	session_start();
	if(isset($_SESSION['logged_in'])) {
		echo '<h1>You are successfull logeed!</h1>';
	} else {
		if(isset($_POST['username'], $_POST['password'])) {
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      			$error = "Invalid email format"; 
    		}

			if(empty($username) or empty($password)) {
				$error = 'All fields are required!';
			}else{
				$query = $pdo->prepare("INSERT INTO users WHERE ('name_user', 'password_user', 'email_user', 'id_role', 'created_data') VALUES (:name,:password, :email,2)");

				$query->execute(['name' => $username, 'password' => $password, 'email' => $email]); 

				$num = $query->rowCount();

				if($num == 1) {
					$_SESSION['logged_in'] = 1;
					header('Location:login.php');
				} else {
					$error = "User doesn't exist!";
				}
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
					<div class="lg100 login_content">
						<?php if(isset($error)){ ?>
							<span class="error"><?php echo $error; ?></span>
						<?php } ?>
						<form class="login_form" action="register.php" method="post">
							<div class="row row-margin">
								<div class="lg100 xs100 padding-15">
									<label>Username</label>
									<input type="text" name="username" placeholder="Enter your username" />
								</div>
								<div class="lg100 xs100 padding-15">
									<label>Email</label>
									<input type="text" name="email" placeholder="Enter your email" />
								</div>
								<div class="lg100 xs100 padding-15">
									<label>Password</label>
									<input type="password" name="password" placeholder="Enter your password" />
								</div>
								<input class="submit" type="submit" name="submit" value="Register">
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

<?php } ?>