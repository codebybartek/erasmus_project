<?php
	
	include_once('includes/connection.php');
	include_once('header.php');
	include_once('includes/user.php');

	$user = new User;
	$user_data = $user->fetch_data($_SESSION['name']);

	$change = false;
	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
		if($_POST['username']!="") {
			$username = $_POST['username'];
			$change = true;
		}else{
			$username= $user_data['name_user'];
		}
		if($_POST['email']!="") {
			$email = $_POST['email'];
			$change = true;
		}else{
			$email= $user_data['email_user'];
		}
		if($_POST['password']!="") {
			$password = md5($_POST['password']);
			$change = true;
		}else{
			$password= $user_data['password_user'];
		}
	}
	if($change === true) {
		$date = date('Y-m-d H:i:s');
		$id_user = $user_data['id_user'];

		$query = $pdo->prepare("UPDATE `users` SET name_user= :name, password_user= :password, email_user= :email, id_role=2 ,created_data= :data WHERE id_user = :id_user");

		$query->execute(['name' => $username, 'password' => $password, 'email' => $email, 'data' => $date, 'id_user' => $id_user]); 

		$_SESSION['logged_in'] = true;
		$_SESSION['name'] = $username;
		header('Location: login.php');
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
						<h1>Edit account:</h1>
						<form class="user_acces_form" action="edit_account.php" method="post">
							<div class="row row-margin">
								<div class="lg100 xs100 padding-15">
									<label>Username</label>
									<input type="text" name="username" placeholder="Enter your username" value="<?php echo $user_data['name_user']; ?>"/>
								</div>
								<div class="lg100 xs100 padding-15">
									<label>Email</label>
									<input type="text" name="email" placeholder="Enter your email" value="<?php echo $user_data['email_user']; ?>" />
								</div>
								<div class="lg100 xs100 padding-15">
									<label>Password</label>
									<input type="password" name="password" placeholder="Enter your new password"/>
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
