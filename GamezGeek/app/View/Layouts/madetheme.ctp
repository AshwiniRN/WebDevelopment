<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="MadebyStudios is your web development supporter to learn in passion, simple and easy way. We provide you with the Process of learning , Complete guide with examples, Tips and Tricks, References of Top Most Highest Quality Tutors in Pdfs(text format) and Videos.">
        
        <meta name="author" content="Raweeteja Bhonagiri">
		
        <title>Made by Studios</title>
		
		<!-- Mobile Specific Meta
		================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />
		
		<!-- CSS
		================================================== -->

		<?php echo $this->Html->css('font-awesome.min'); ?>
		<?php echo $this->Html->css('bootstrap.min'); ?>
		
		<?php echo $this->Html->css('animate'); ?>
		<?php echo $this->Html->css('owl.carousel'); ?>
		<?php echo $this->Html->css('component'); ?>
		<?php echo $this->Html->css('slit-slider'); ?>
		<?php echo $this->Html->css('main'); ?>
		<?php echo $this->Html->css('media-queries'); ?>

		<!--
		Google Font
		=========================== -->                    
		
		<!-- Oswald / Title Font -->
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
		<!-- Ubuntu / Body Font -->
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>
		
		<?php echo $this->Html->script('modernizr-2.6.2.min'); ?>

		
	
    </head>
	
    <body id="body">
	    <!--
	    Start Preloader
	    ==================================== -->
		<div id="loading-mask">
			<div class="loading-img">
				<img alt=" Preloader" src="<?php echo sitename;?>img/preloader.gif"  />
			</div>
		</div>
        <!--
        End Preloader
        ==================================== -->
		
        <!--
        Welcome Slider
        ==================================== -->
		<section id="home">	    
		
            		</section>
		<!--/#home section-->
		
        <!-- 
        Fixed Navigation
        ==================================== -->
        <header id="navigation" class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
					<!-- /responsive nav button -->
					
					<!-- logo -->
                    <a class="navbar-brand" href="<?php echo sitename;?>">
						<h1 id="logo">
							<img src="<?php echo sitename;?>img/logo-main.png" alt="MadebyStudios" />
						</h1>
					</a>
					<!-- /logo -->
                </div>

				<!-- main nav -->
                <nav class="collapse navbar-collapse navbar-right" role="Navigation">
                    <ul id="nav" class="nav navbar-nav">
                        <li class="current"><a href="<?php echo sitename;?>"><font color="#c34b4b">HOME</font></a></li>
                        
                         <li class="dropdown">
					        <a href="#" data-toggle="dropdown" class="dropdown-toggle">HTML <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					            <li><a href="<?php echo sitename;?>html/process_of_learning_html">Process Of Learning</a></li>
					            <li><a href="<?php echo sitename;?>html/complete_html">Complete HTML & HTML5</a></li>
					            <li><a href="<?php echo sitename;?>html/references_html">References - Text/Videos</a></li>
					            <li><a href="#">Tips & Tricks</a></li>
					            <li><a href="#">Blog</a></li>
					        </ul>
					    </li>
					    <li class="dropdown">
					        <a href="#" data-toggle="dropdown" class="dropdown-toggle">CSS <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					            <li><a href="<?php echo sitename;?>css/process_of_learning_css">Process Of Learning</a></li>
					            <li><a href="<?php echo sitename;?>css/complete_css">Complete CSS & CSS3</a></li>
					            <li><a href="<?php echo sitename;?>css/references_css">References - Text/Videos</a></li>
					            <li><a href="#">Tips & Tricks</a></li>
					            <li><a href="#">Blog</a></li>
					        </ul>
					    </li>
					    <li class="dropdown">
					        <a href="#" data-toggle="dropdown" class="dropdown-toggle">BOOTSTRAP <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					            <li><a href="<?php echo sitename;?>bootstrap/process_of_learning_bootstrap">Process Of Learning</a></li>
					            <li><a href="<?php echo sitename;?>bootstrap/complete_bootstrap">Complete Bootstrap</a></li>
					            <li><a href="<?php echo sitename;?>bootstrap/references_bootstrap">References - Text/Videos</a></li>
					            <li><a href="#">Tips & Tricks</a></li>
					            <li><a href="#">Blog</a></li>
					        </ul>
					    </li>
					    <li class="dropdown">
					        <a href="#" data-toggle="dropdown" class="dropdown-toggle">WORDPRESS <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					            <li><a href="<?php echo sitename;?>wordpress/process_of_learning_wordpress">Process Of Learning</a></li>
					            <li><a href="<?php echo sitename;?>wordpress/complete_wordpress">Complete Wordpress</a></li>
					            <li><a href="<?php echo sitename;?>wordpress/references_wordpress">References - Text/Videos</a></li>
					            <li><a href="#">Tips & Tricks</a></li>
					            <li><a href="#">Blog</a></li>
					        </ul>
					    </li>
					    <li class="dropdown">
					        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Send Us <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					            <li><a href="<?php echo sitename;?>sendus/suggestions">Give a Suggestion</a></li>
					            <li><a href="<?php echo sitename;?>sendus/topic">Request a Topic</a></li>
					            <li><a href="#">Support Us</a></li>
					            <li><a href="<?php echo sitename;?>#footer">Contact Us</a></li>
					            
					        </ul>
					    </li>
                      
                    </ul>
                </nav>
				<!-- /main nav -->
				
            </div>
        </header>
        <!--
        End Fixed Navigation
        ==================================== -->
		
		<?php echo $this->fetch('content'); ?>
		
		<!-- end Contact Area
		========================================== -->
		
		<footer id="footer" class="bg-one">
			<div class="container">
			    <div class="row wow fadeInUp" data-wow-duration="500ms">
					<div class="col-lg-12">
						
						<!-- Footer Social Links -->
						<div class="social-icon">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								
							</ul>
						</div>
						<!--/. End Footer Social Links -->

						<!-- copyright -->
						<div class="copyright text-center">
							<a href="index.html">
								<img src="<?php echo sitename;?>img/logo-main.png" alt="MadebyStudios" /> 
							</a>
							<br />
							
							<p>Made with &hearts; by <a href="http://www.madebystudios.com"> MadebyStudios</a>. Copyright &copy; 2016. All Rights Reserved.</p>
						</div>
						<!-- /copyright -->
						
					</div> <!-- end col lg 12 -->
				</div> <!-- end row -->
			</div> <!-- end container -->
		</footer> <!-- end footer -->
		
		<!-- Back to Top
		============================== -->
		<a href="javascript:;" id="scrollUp">
			<i class="fa fa-angle-up fa-2x"></i>
		</a>
		
		<!-- end Footer Area
		========================================== -->
		
		<!-- 
		Essential Scripts
		=====================================-->
		
		<!-- Main jQuery -->
		<?php echo $this->Html->script('jquery-1.11.0.min'); ?>
		<?php echo $this->Html->script('bootstrap.min'); ?>
		<?php echo $this->Html->script('jquery.slitslider'); ?>
		<?php echo $this->Html->script('jquery.ba-cond.min'); ?>
		<?php echo $this->Html->script('jquery.parallax-1.1.3'); ?>
		<?php echo $this->Html->script('owl.carousel.min'); ?>
		<?php echo $this->Html->script('jquery.mixitup.min'); ?>
		<?php echo $this->Html->script('jquery.nicescroll.min'); ?>
		<?php echo $this->Html->script('jquery.appear'); ?>
		<?php echo $this->Html->script('jquery.easing-1.3.pack'); ?>
		<?php echo $this->Html->script('jquery.nav'); ?>
		<?php echo $this->Html->script('jquery.sticky'); ?>
		<?php echo $this->Html->script('jquery.countTo'); ?>
		<?php echo $this->Html->script('wow.min'); ?>
		<?php echo $this->Html->script('jquery.fitvids'); ?>
		<?php echo $this->Html->script('grid'); ?>
		<?php echo $this->Html->script('custom'); ?>
		
	<script type="text/javascript">
			$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
	
	</script>
    </body>
</html>