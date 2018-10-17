<head>
  <meta charset="utf-8">
  <title>Tic-Tac-Toe</title>
  <?php
		
		echo $this->Html->css('ttt/style');		
		echo $this->Html->script('ttt/jquery');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
</head>
<body data-type='test'>

<div class="tic-tac-toe clearfix">
  <div class="grid" data-row="0" data-column="0"></div>
  <div class="grid" data-row="0" data-column="1"></div>
  <div class="grid" data-row="0" data-column="2"></div>

  <div class="grid" data-row="1" data-column="0"></div>
  <div class="grid" data-row="1" data-column="1"></div>
  <div class="grid" data-row="1" data-column="2"></div>

  <div class="grid" data-row="2" data-column="0"></div>
  <div class="grid" data-row="2" data-column="1"></div>
  <div class="grid" data-row="2" data-column="2"></div>
</div>


<div class="warning fixedToTop">Player 1's turn</div>

<!-- overlay message - win/lose/draw -->
<div class="overlay">
    <div class="message">
      <h2>Game Over</h2>
      <span class="theMessage">
        Well done Player 1, You've won the game!
      </span>
      <a href="#" class="play-again">Play another round&nbsp; &#8250;</a>
    </div>
</div>

<!-- Start overlay -->
<div class="start-overlay">
  <div class="start-message">
    <span class="theMessage">
      Welcome to tic-tac-toe
    </span>
    <a href="#" class="lets-play">Ready to play!</a>
  </div>
	
</div>


<script>
(function(){

  // INITIALIZE /\/\/\/\/\/\/\/\-------------------------------

  // Set Global Variables
  var hasWonRow       = false;
      hasWonColumn    = false,
      hasWonDiagonal1 = false,
      hasWonDiagonal2 = false,
      winnerFound     = false,
      boardDimesion   = 3,

      currentPlayer   = 1,  // player 1 = O, player 2 = X
      currentMoves    = 1,

      movesBeforeWin  = (2 * boardDimesion) - 1,
      totalMoves      = boardDimesion*boardDimesion;


  // Set Array globally and randomize values
  var items = [
    [   0,    0,    0   ],
    [   0,    0,    0   ],
    [   0,    0,    0   ]
  ];

  randomizeArray();


  // ACTIONS UPON CLICKED /\/\/\/\/\/\/\/\-------------------------------

  $('.grid').click(function(e){
    var $this = $(this);

    // Prevent user from clicking a marked grid
    if($this.attr("data-select")) { 
      $('.warning').html("Player " + currentPlayer + "'s turn - <strong>You cannot click on a marked spot</strong>"); 
      return; 
    };

    // Set appropriate attributes/values to grid clicked
    if(currentPlayer == 1) {
      $this.addClass('marked-o').attr({
        'data-select' : "selected",
        'data-marked' : "o"
      });
    } else {
      $this.addClass('marked-x').attr({
        'data-select' : "selected",
        'data-marked' : "x"
      });
    }

    // Change the value of the 2-D array (game logic)
    var currentRow    = $this.data('row'),
        currentColumn = $this.data('column');

    items[currentRow][currentColumn] = currentPlayer;
    if(currentMoves >= movesBeforeWin) {
      gameLogic();
    }

    // Conditions for end of game without winner (Draw)
    if(currentMoves >= totalMoves && winnerFound == false) {
      $('.overlay .theMessage').text("It's a draw!");
      showMainMessage();
    }

    // Change warning message
    if(currentPlayer == 1) {
      $('.warning').text("Player 2's turn");
    } else {
      $('.warning').text("Player 1's turn");
    }

    // Swapping players and increasing moves counter
    switchPlayer();
    currentMoves++;
    
  });

  $('.lets-play').click(function(e){
    e.preventDefault();
    $('.start-message').addClass('hide');
    $('.start-overlay').fadeOut('1000');
  });

  $('.message').on('click', '.play-again', function(e){
  	 e.preventDefault();
  	 location.reload();
  });


  // FUNCTIONS /\/\/\/\/\/\/\/\-------------------------------

  function showMainMessage() {
    $('.warning').addClass('hide'); $('.overlay').fadeIn('1000'); $('.message').addClass('show');
  }

  function randomizeArray() {
    // Randomize the values in array
    for( i = 0; i < items.length ; i++) {
      var item = items[i];
      for( j = 0; j < item.length; j++ ) {
        item[j] = Math.random();
      }
    }  
  }

  function gameLogic() {
    for( i = 0; i < items[0].length; i++) {
      if(hasWonRow == false) {
        winCondRow(i);
      } 
    }
    for( i = 0; i < items[0].length; i++) { 
      if(hasWonColumn == false) {
        winCondColumn(i);
      } 
    }
    winCondDiagonalLeftRight();
    winCondDiagonalRightLeft();


    if(hasWonRow == true || hasWonColumn == true || hasWonDiagonal1 == true || hasWonDiagonal2 == true) {
      console.log("SOMEBODY WONNN !!!")
      var x = $('.marked-x').length, 
          o = $('.marked-o').length;

      winnerFound = true;
      if( x >= o) {
        $('.overlay .theMessage').text("Well done Player 2, You've won the game!");
      } 
      showMainMessage();

    } else {
      console.log("Still a drawww");
    }
  }

  function switchPlayer() {
    currentPlayer = (currentPlayer == 1) ? 2 : 1;
  }

  function winCondRow(row) {
    hasWonRow = true;
    for( j = 0; j < items[row].length; j++) {
      console.log(items[row][j]);
      if(items[row][j] != items[row][0]) {
        hasWonRow = false;
      } 
    }    
  } 

  function winCondColumn(column) {
    hasWonColumn = true;
    for( j = 0; j < items[column].length; j++) {
      console.log(items[j][column]);
      if(items[j][column] != items[0][column]) {
        hasWonColumn = false;
      }
    }    
  } 
  function winCondDiagonalLeftRight() {
    hasWonDiagonal1 = true;
    for( i = 0; i < boardDimesion; i++) {
      console.log(items[i][i]);
      if(items[i][i] != items[0][0]) {
        hasWonDiagonal1 = false;
      }
    }
  }

  function winCondDiagonalRightLeft() {
    hasWonDiagonal2 = true;
    var squareSize = boardDimesion - 1;
    for( i = 0; i < boardDimesion ; i++) {
      console.log(items[i][squareSize - i]);
      if(items[i][squareSize - i] != items[0][squareSize - 0]) {
        hasWonDiagonal2 = false;
      }
    }
  }

})();
</script>

</body>