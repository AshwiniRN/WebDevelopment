
<head>
    <meta charset="UTF-8">
    <title>Ludo</title>
   
	
	<?php
		

		echo $this->Html->css('ludo/normalize');
		echo $this->Html->css('ludo/style');		
		echo $this->Html->script('ludo/zepto');
		echo $this->Html->script('ludo/log');
		echo $this->Html->script('ludo/sfx');
		echo $this->Html->script('ludo/player');
		echo $this->Html->script('ludo/board');
		echo $this->Html->script('ludo/field');
		echo $this->Html->script('ludo/pawn');
		echo $this->Html->script('ludo/base');
		echo $this->Html->script('ludo/dice');
		echo $this->Html->script('ludo/game');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
	
</head>
<body>

    <div class="shadow"></div>
    <div id="content">
        <div id="board"></div>
        <div id="sidebar">
            <div class="arrow"></div>
            <ul id="players-list"></ul>
        </div>
    </div>
    
</body>