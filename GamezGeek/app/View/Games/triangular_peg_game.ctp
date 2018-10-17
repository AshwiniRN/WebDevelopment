<head>
    <title>The Peg Game</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, 
                user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<?php
		

		//echo $this->Html->css('ludo/normalize');
		//echo $this->Html->css('ludo/style');		
		echo $this->Html->script('peg/kinetic');
		echo $this->Html->script('peg/move-table');
		echo $this->Html->script('peg/game');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
 

  </head>
  <body style="overflow: hidden; margin: 0px; padding: 0px;">
    <div id='container'></div>
  </body>