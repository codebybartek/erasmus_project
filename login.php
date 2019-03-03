<?php
	
	include_once('includes/connection.php');
	include_once('header.php');
	if(isset($_SESSION['logged_in'])) {
		include_once('includes/admin_navigation.php');
	} else {
		if(isset($_POST['username'], $_POST['password'])) {
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			if(empty($username) or empty($password)) {
				$error = 'All fields are required!';
			}else{
				$query = $pdo->prepare("SELECT * FROM users WHERE name_user= :name AND password_user= :password");

				$query->execute(['name' => $username, 'password' => $password]); 

				$num = $query->rowCount();

				if($num == 1) {
					$_SESSION['logged_in'] = true;
					$_SESSION['name'] = $username;
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
						<form class="user_acces_form" action="login.php" method="post">
							<div class="row row-margin">
								<div class="lg100 xs100 padding-15">
									<?php if(isset($error)){ ?>
										<span class="error"><?php echo $error; ?></span>
									<?php } ?>
									<label>Username</label>
									<input type="text" name="username" placeholder="Enter your username" />
								</div>
								<div class="lg100 xs100 padding-15">
									<label>Password</label>
									<input type="password" name="password" placeholder="Enter your password" />
								</div>
								<input class="submit" type="submit" name="submit" value="Login">
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