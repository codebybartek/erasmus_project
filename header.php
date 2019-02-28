<?php

		$url = explode('/', $_SERVER["REQUEST_URI"]);
		if(count($url)===4){
			$path="../";
		}else{
			$path="";
		}	
		session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>YOUR THE BEST FILM</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>assets/css/style.css">
</head>
<body>
	<div class="lg100 top border_bottom">
		<div class="container">
			<div class="row display_flex">
				<header class="lg30 xs100 logo">
					<a href="<?php echo $path; ?>index.php"><img src="<?php echo $path; ?>assets/images/logo.png" alt="THE BEST FILM"></a>
				</header>	
				<nav class="lg70 xs100 navbar display_flex">
					<ul>
						<li><a href="<?php echo $path; ?>index.php">Films</a></li>
						<li><a href="<?php echo $path; ?>index.php">Serials</a></li>
						<li><a href="<?php echo $path; ?>index.php">Top50</a></li>
						<?php if(isset($_SESSION['logged_in'])) { ?>
							<li><a href="<?php echo $path; ?>login.php">admin</a></li>
						<?php } ?>
					</ul>
					<aside class="nav-right">
						<?php if(isset($_SESSION['logged_in'])) { ?>
							<a href="<?php echo $path; ?>logout.php" class="login_btn">Logout</a>
						<?php } else { ?>
							<a href="<?php echo $path; ?>login.php" class="login_btn">Login</a>
						<?php } ?>
						<a href="<?php echo $path; ?>register.php" class="register_btn">Register</a>
					</aside>
				</nav>
			</div>
		</div>
	</div>