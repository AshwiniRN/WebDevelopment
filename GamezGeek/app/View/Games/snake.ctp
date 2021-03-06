<head>
		<title>Snakes and Ladders</title>
	 <?php
			
		echo $this->Html->script('snake/jquery.min');
		echo $this->Html->script('snake/jquery.easing.1.3');
		echo $this->Html->script('snake/Animations');
		echo $this->Html->script('snake/knockout-2.0.0');
		echo $this->Html->script('snake/SnakesAndLaddersLogic');
		echo $this->Html->script('snake/ViewModelSnakeAndLadders');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
		<style>
			#wrapper {
			   margin: 0px auto;
			   padding: 0;
			   border: 2px solid black;
			   width: 1760px;
			   height: 1760px;
			}
		</style>
		
	</head>
	<body>
	<div id="preamble">
		<h1>Snakes and Ladders</h1>
		
		<h2>Players</h2>
		<table>
		<thead><tr>
			<th>Player name</th><th>Position</th><th>Dice Roll</th>
		</tr></thead>
			<tbody data-bind="foreach: players"><tr>
				<td><input data-bind="value: name" /></td>
				<td data-bind="text: position"></td>
				<td data-bind="text: diceRoll"></td>
			</tr></tbody>
		</table>
		<input type="button" value="Reset" onClick="gameVM.newGame();"></input>
		<button data-bind="click: nextTurn, enable: isGameOver() == false">Roll next turn</button>
		<button data-bind="click: addPlayer">Add Player</button>
		<input type="button" value="Game Status" onClick="game.gameState();"></input>
		<input type="button" value="Test Victory" onClick="game.testVictory();"></input>
		<input type="button" value="Reset Game" onClick="gameVM.defaultSetup()" ></input>
	</div>
		
		
	<div id="wrapper" >
		<div data-bind="foreach: players">
			<div class="tokens" data-bind="attr:{id: name}" style="position:relative;" ><img src="/img/snake/monkey_token.png" width="170" height="153" style="position: absolute;" /></div>
		</div>
		<img id="board" src="/img/snake/Game-Board-Snakes-and-Ladders-Full_no_boarder.gif" />
	</div>
	</body>
	
	