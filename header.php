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
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
	<div class="lg100 top border_bottom">
		<div class="container">
			<div class="row display_flex">
				<header class="lg30 xs30 logo">
					<a href="<?php echo $path; ?>index.php"><img src="<?php echo $path; ?>assets/images/logo.png" alt="THE BEST FILM"></a>
				</header>	
				<button onclick="menu()" class="burger_btn">&equiv;</button>	
				<nav class="lg70 xs100 navbar display_flex" id="navbar">
					<ul>
						<li><a href="<?php echo $path; ?>index.php">Films</a></li>
						<li><a href="<?php echo $path; ?>serials.php">Series</a></li>
						<li><a href="<?php echo $path; ?>top-3.php">Top 3</a></li>
						<?php if(isset($_SESSION['logged_in']) && isset($_SESSION['id_role']))  { if($_SESSION['id_role'] != 2) { ?>
							<li><a href="<?php echo $path; ?>login.php">admin</a></li>
						<?php }} ?>
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
	<script type="text/javascript">
	  	function menu() {
	  		if(document.getElementById("navbar").style.display != "block"){
	    		document.getElementById("navbar").style.display = "block";	
	    	}else{
	    		document.getElementById("navbar").style.display = "none";	
	    	}
	    }


	</script>