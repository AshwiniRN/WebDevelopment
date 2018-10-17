<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gamezgeek</title>
	<meta name="description" content="Online game center is web center where we can play games online itself. it provides all games for free of cost." />
	<meta name="keywords" content="online game center,game,games,game center,online game" />
	<meta name="author" content="Ashwini" />
	
	<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-touch-icon-60x60.png">
	<link rel="icon" type="image/png" href="img/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="img/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="img/favicons/manifest.json">
	<link rel="shortcut icon" href="img/favicons/favicon.ico">
	<meta name="msapplication-TileColor" content="#00a8ff">
	
	<meta name="theme-color" content="#ffffff">
	
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		

		echo $this->Html->css('normalize');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('owl');
		echo $this->Html->css('animate');
		echo $this->Html->css('fonts/font-awesome/css/font-awesome.min');
		echo $this->Html->css('fonts/eleganticons/et-icons');
		echo $this->Html->css('game');
		echo $this->Html->css('custom');
		
		echo $this->Html->script('jquery-1.11.1.min');
		echo $this->Html->script('owl.carousel.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('wow.min');
		echo $this->Html->script('typewriter');
		echo $this->Html->script('jquery.onepagenav');
		echo $this->Html->script('main');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
	
</head>
<body>
	<div class="preloader">
		<img src="<?php echo SITENAME ?>img/loader.gif" alt="Preloader image">
	</div>
	<nav class="navbar">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo SITENAME ?>home"><img src="<?php echo SITENAME ?>img/logo.png" data-active-url="<?php echo SITENAME ?>img/logo-active.png" alt=""></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right main-nav">
					<!-- <li><a href="<?php echo SITENAME?>home/">Home</a></li> -->
					<?php if($this->request->params['controller'] == "home" && $this->request->params['action']=="index"){ ?>
					<li><a href="<?php echo SITENAME ?>home/#games">Games</a></li>
					<li><a href="<?php echo SITENAME ?>home/#hrc">Higest rated games</a></li>
					<li><a href="<?php echo SITENAME; ?>users/premium">Pricing</a></li>
					<?php } else {?>
					<li><a href="<?php echo SITENAME ?>home/#games">Games</a></li>
					<li><a href="<?php echo SITENAME ?>home/#hrc">Higest rated games</a></li>
					<?php } ?>
					
					<li><a href="<?php echo SITENAME ?>home/#team">Team</a></li>
					<!-- <li><a href="#pricing">About us</a></li> -->
					<?php if($this->Session->read("username")=="" ) { ?>
					<li><a href="#" data-toggle="modal" data-target="#signin" class="btn btn-blue">Sign In</a></li>
					<li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue">Sign Up</a></li>
					<?php } ?>
					<?php if($this->Session->read("username")!="" ) { ?>
					<li><a href=""><b>Hello, <?php echo $this->Session->read("username");  ?></b></a></li>
					<li><a href="<?php echo SITENAME ?>users/profile"  class="btn btn-blue ">My profile</a></li>
					<li><a href="<?php echo SITENAME ?>users/logout"  class="btn btn-blue btn_logout">Logout</a></li>
					<?php } ?>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<header id="intro">
		<div class="container">
			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
							<h3 class="light white">Concentrate, Play your game, and </h3>
							<h1 class="white typed">Don't be afraid to win the game. </h1>
							<span class="typed-cursor">|</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	<footer>
		<div class="container">
			<div class="bottom-footer text-center-mobile row">
				<div class="col-sm-12">
					<ul class="social-footer short-footer">
						<li><a href="mailto:support@gamezgeek.com"><i class="fa fa-phone"></i> Contact</a> </li>
						<li><a href=""><i class="fa fa-file-text"></i> Policy</a></li>
						<li><a href=""><i class="fa fa-sitemap"> Sitemap</i></a></li>
						<li><a href=""><i class="fa fa-star"> Terms and Conditions</i></a></li>
					</ul>
				</div>
			</div>
			<div class="row bottom-footer text-center-mobile">
				<div class="col-sm-8">
					<p>&copy; 2017 All Rights Reserved. Powered by <a href="">EMU CAS</a> exclusively for <a href="">COSC 631</a></p>
				</div>
				<div class="col-sm-4 text-right text-center-mobile">
					<ul class="social-footer">
						<li><a href=""><i class="fa fa-facebook"></i></a></li>
						<li><a href=""><i class="fa fa-twitter"></i></a></li>
						<li><a href=""><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<div class="mobile-nav">
		<ul>
		</ul>
		<a href="#" class="close-link"><i class="arrow_up"></i></a>
	</div>
<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link " data-dismiss="modal"><i class="icon_close_alt2"></i></a>
				<h3 class="white">Sign In</h3>
				
				<form action="" class="popup-form">
				<div class="login_error" style="display:none;">Incorrect username or password</div>
				<div class="login_success" style="display:none;">Login Success</div>
				<input type="text" class="form-control form-white login_username" placeholder="Username or email address" name="username">
						<input type="password" class="form-control form-white login_password" placeholder="Passsword" name="password">
						<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="None" id="rememberme" name="rememberme" /> 
							<label for="rememberme"><span>Remember me</strong></span></label>
						</div>
						</div>
				<!-- <php
					
					if(@$_COOKIE['username']!="" && @$_COOKIE['password']!=""){ ?>
						<input type="text" class="form-control form-white login_username" value="<?php echo $_COOKIE['username'] ?>" placeholder="Username or email address" name="username">
						<input type="password" class="form-control form-white login_password" value="<?php echo $_COOKIE['password'] ?>" placeholder="Passsword" name="password">
						<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="None" id="rememberme" name="rememberme" checked="checked" /> 
							<label for="rememberme"><span>Remember me</strong></span></label>
						</div>
					</div>
				<php	} else { ?>
						<input type="text" class="form-control form-white login_username" placeholder="Username or email address" name="username">
						<input type="password" class="form-control form-white login_password" placeholder="Passsword" name="password">
						<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="None" id="rememberme" name="rememberme" /> 
							<label for="rememberme"><span>Remember me</strong></span></label>
						</div>
						</div>
				<php } ?>-->
					
					
					<button type="button" class="btn btn-submit btn_loginsubmit">Sign In</button>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<h3 class="white">Sign Up</h3>
				<form action="" class="popup-form">
				<div class="register_fillall reg_error" style="display:none;">Please fill all below fields</div>
				<div class="register_email reg_error" style="display:none;">Please enter valid email</div>
				<div class="register_user reg_error" style="display:none;">username shoule be minimum 6 characters</div>
				<div class="register_pass reg_error" style="display:none;">mismatch password and confirm password (or) <br/> password length should be min 6 and max 8</div>
				<div class="register_tick reg_error" style="display:none;">Please read and  accept terms and conditions</div>
				<div class="duplicate_msg reg_error" style="display:none;">username or emailid already exists.</div>
				<div class="register_success " style="display:none;">Registration successfull. verification mail sent to mail. Please Sign In.</div>
					<input type="text" class="form-control form-white r_username" placeholder="Username">
					<input type="text" class="form-control form-white r_fullname" placeholder="Full Name">
					<input type="text" class="form-control form-white r_email" placeholder="Email Address">
					<input type="password" class="form-control form-white r_password" placeholder="Password">
					<input type="password" class="form-control form-white r_cpassword" placeholder="Confirm password">
					<div class="dropdown">
						<button id="dLabel" class="form-control form-white dropdown pricing_plan" type="button" value="null" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pricing Plan
						</button>
						<ul class="dropdown-menu animated fadeIn pricing_select" role="menu" aria-labelledby="dLabel">
							<li class="animated lightSpeedIn"><a href="#" class="1" >1 month membership ($1.99)</a></li>
							<li class="animated lightSpeedIn"><a href="#" class="3">3 month membership ($3.99)</a></li>
							<li class="animated lightSpeedIn"><a href="#"  class="12" >1 year membership ($9)</a></li>
							<li class="animated lightSpeedIn"><a href="#" class="0">Free membership</a></li>
						</ul>

					</div>
					<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="None" id="squaredOne" class="i_agree" name="check" />
							<label for="squaredOne"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
						</div>
					</div>
					<button type="button" class="btn btn-submit btn_register">Submit</button>
				</form>
			</div>
		</div>
	</div>
<?php 
	echo $this->Html->script('custom'); 
?>
</body>
</html>
