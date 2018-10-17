
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gamezgeek</title>
	<meta name="description" content="Online game center is web center where we can play games online itself. it provides all games for free of cost." />
	<meta name="keywords" content="online game center,game,games,game center,online game" />
	<meta name="author" content="Ashwini R Goud, Raweeteja B" />
	
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
	
	
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>

</body>
</html>
