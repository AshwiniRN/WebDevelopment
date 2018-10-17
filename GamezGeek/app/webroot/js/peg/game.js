
(function () {

    var boardTexture = new Image();
    boardTexture.onload = function () { init(); };
      boardTexture.src = '/img/bg.jpg';
    var stageWidth = 800;
    var stageHeight = 600;
    var pegColor = '#dcdcdc';
    var pegRadius = 15;
    var holeColor = '#3E0906';
    var holeRadius = 9;
    var boardStrokeColor = '#4E1207';
    var holeStrokeColor = '#090909';
    var pegStrokeColor = 'white';
    var activeStrokeColor = 'yellow';
    var jumpStrokeColor = 'red';
    var landStrokeColor = 'blue';
    var gameLayer, hudLayer;
    var hole, holeCount, peg, pegCount;
    var validMoves, boardPos;
    var pegsRemaining, pegsRemainingText;

    function init() {
        var containerElement = document.getElementById('container');
        containerElement.style.width = stageWidth + 'px';
        containerElement.style.height = stageHeight + 'px';

        var stage = new Kinetic.Stage({
            container: 'container',
            width: stageWidth,
            height: stageHeight
        });

        var boardCenter = {
            x: stage.getWidth() / 2 - 110,
            y: stage.getHeight() / 2 + 110
        };

        var bgLayer = new Kinetic.Layer();
        var background = new Kinetic.Rect({
            width: 800, height: 600, fill: 'white'
        });
        bgLayer.add(background);

        gameLayer = new Kinetic.Layer();
        hudLayer = new Kinetic.Layer();
        
        var wood = new Kinetic.RegularPolygon({
            x: boardCenter.x,
            y: boardCenter.y,
            sides: 3,
            shadow: { color: 'black', blur: 10, offset: [0, -7], opacity: 0.6 },
            radius: 250,
            fillPatternImage: boardTexture,
            fillPatternOffset: [800, 0],
            stroke: boardStrokeColor,
            strokeWidth: 3
        });
        bgLayer.add(wood);

        hole = [];
        peg = [];

        holeCount = 0;
        pegCount = 0;
        pegsRemaining = 14;

        validMoves = [];
        for (var i = 0; i < 15; i++) {
            validMoves[i] = [];
        }

        boardPos = [];

        for (var i = 0; i < 5; i++) {

            var numHoles = 5 - i;
            for (var j = 0; j < numHoles; j++) {

                var posX = (numHoles - 1) * -30 + j * 60 + boardCenter.x;
                var posY = -60 * i + 70 + boardCenter.y;
                boardPos[holeCount] = { x: posX, y: posY };

                hole[holeCount] = createHole(posX, posY);
                gameLayer.add(hole[holeCount]);
                if (holeCount < 14) {
                    var newPeg = createPeg(posX, posY);
                    peg[pegCount] = newPeg;

                    peg[pegCount].attrs.active = false;
                    peg[pegCount].attrs.pegIndex = pegCount;
                    peg[pegCount].attrs.boardPos = pegCount;
                    peg[pegCount].attrs.enabled = true;

                    hole[holeCount].attrs.occupied = true;
                    gameLayer.add(peg[pegCount]);
                    pegCount++;
                }
                else {
                    hole[holeCount].attrs.occupied = false;
                }

                holeCount++; 
            }
        }

        var hud = createHUD(hudLayer);
        hudLayer.add(hud);

        stage.add(bgLayer);
        stage.add(gameLayer);
        stage.add(hudLayer);

        buildMoveList();
    }

    function createHole (posX, posY) {
        return new Kinetic.Circle({
            x: posX,
            y: posY,
            radius: holeRadius,
            fill: holeColor,
            stroke: holeStrokeColor,
            strokeWidth: 2
        });
    }

    function createPeg (posX, posY) {
        return new Kinetic.Circle({
            x: posX,
            y: posY,
            radius: pegRadius,
            fill: pegColor,
            shadow: { color: 'black', blur: 10, offset: [0, -5], opacity: 0.7 },
            stroke: pegStrokeColor,
            strokeWidth: 2
        });
    }

    function createHUD() {
        var hud = new Kinetic.Group({
            x: 125, y: 30
        });

        var main = new Kinetic.Group();

        var hudRect = new Kinetic.Rect({
            width: 340, height: 50,
            stroke: '#4E1207', strokeWidth: 3,
            fillPatternImage: boardTexture
        });

        pegsRemainingText = new Kinetic.Text({
            fill: '#4E1207',
            text: 'Pegs Remaining: ' + pegsRemaining,
            fontSize: 20,
            fontFamily: 'Calibri',
            fontStyle: 'bold',
            width: 340,
            padding: 10,
            align: 'center',
            cornerRadius: 10
        });

        var scoringText = new Kinetic.Text({
            y: 40,
            fill: '#4E1207',
            text: '',
            fontSize: 16,
            fontStyle: 'bold',
            fontFamily: 'Calibri',
            lineHeight: 1.5,
            padding: 10,
            width: 340,
            align: 'center'
        });

        main.add(hudRect);
        main.add(pegsRemainingText);
        main.add(scoringText);

        hud.add(main);
        hud.add(createResetButton());

        return hud;
    }

    function createResetButton() {
        var resetButton = new Kinetic.Group({
            x: 88, y: 525
        });

        var resetButtonRect = new Kinetic.Rect({
            width: 170, height: 35,
            fill: '#56E4D6', stroke: '#4E1207', strokeWidth: 3
        });
        resetButton.add(resetButtonRect);

        var resetButtonText = new Kinetic.Text({
            fill: '#4E1207',
            text: 'Reset Game',
            fontSize: 18,
            fontFamily: 'Calibri',
            fontStyle: 'bold',
            width: 170,
            padding: resetButtonRect.getHeight() / 4,
            align: 'center'
        });
        resetButton.add(resetButtonText);

        resetButton.on('mouseover', function () {
            resetButtonRect.setFill('#56E4D6');
            document.body.style.cursor = 'pointer';
            hudLayer.draw();
        });

        resetButton.on('mouseleave', function () {
            resetButtonRect.setFill('#56E4D6');
            document.body.style.cursor = 'auto';
            hudLayer.draw();
        });

        resetButton.on('click tap', function () {
            if (pegsRemaining != 14) resetGame();
        });

        return resetButton;
    }

    function isPegNearHole(pegIndex, holeIndex) {

        var pegX = peg[pegIndex].getX()
        var pegY = peg[pegIndex].getY()
        var holeX = boardPos[holeIndex].x;
        var holeY = boardPos[holeIndex].y;

        var offset = 30;

        var xAligned = pegX > holeX - offset && pegX < holeX + offset;
        var yAligned = pegY > holeY - offset && pegY < holeY + offset;

        return xAligned && yAligned;
    }

    function removePeg(index) {
        peg[index].setVisible(false);
        peg[index].attrs.enabled = false;
        peg[index].attrs.active = false;
        hole[peg[index].attrs.boardPos].attrs.occupied = false;
        gameLayer.draw();
        pegsRemaining--;
        pegsRemainingText.setText('Pegs Remaining: ' + pegsRemaining);
        hudLayer.draw();
    }

    function buildMoveList() {
        var numValidMoves = 0;

        deactivatePegs();
        clearMoveList();

        for (var i = 0; i < pegCount; i++) {
            if (peg[i].attrs.enabled) {
                var moveCount = 0;
                var pegActivated = false;

                var pos = peg[i].attrs.boardPos;

                for (var j = 0; j < MoveTable[pos].length; j++) {

                    var jumpPos = MoveTable[pos][j].jumpPos;
                    var landPos = MoveTable[pos][j].landPos

                    if (isMoveValid(jumpPos, landPos)) {
                        validMoves[i][moveCount] = MoveTable[pos][j];
                        moveCount++;
                        if (!pegActivated) 
                            activatePeg(peg[i]);
                    }
                }
                numValidMoves += moveCount;
            }
        }
        if (numValidMoves === 0) gameOverMessage();
    }

    function isMoveValid (jumpPos, landPos) {
        return hole[jumpPos].attrs.occupied && !hole[landPos].attrs.occupied;
    }

    function gameOverMessage() {
        var msg;
        switch (pegsRemaining) {
            case 1:
                msg = 'Genius';
                break;
            case 2:
                msg = 'Smart.';
                break;
            case 3:
                msg = 'Average.';
                break;
            default:
                msg = 'Try again';
                break;
        }
        alert(msg);
    }

    function resetGame() {
        deactivatePegs();
        for (var i = 0; i < holeCount; i++) {

            if (i != holeCount - 1) {
                peg[i].attrs.boardPos = i;
                peg[i].setX(boardPos[i].x);
                peg[i].setY(boardPos[i].y);
                peg[i].setVisible(true);
                peg[i].attrs.enabled = true;
                hole[i].attrs.occupied = true;
            }
            else {
                hole[i].attrs.occupied = false;
            }
        }

        gameLayer.draw();
        
        pegsRemaining = 14;
        pegsRemainingText.setText('Pegs Remaining: ' + pegsRemaining);
        hudLayer.draw();

        buildMoveList();
    }

    function getPegAtPosition(pos) {
        for (var i = 0; i < pegCount; i++)
            if (peg[i].attrs.boardPos === pos && peg[i].attrs.enabled)
                return peg[i];
        return null;
    }

    function activatePeg(peg) {
        peg.on('dragstart', onActivePegDragStart);
        peg.on('dragend', onActivePegDragEnd);
        peg.on('mouseover', onActivePegMouseOver);
        peg.on('mouseout', onActivePegMouseOut);
        peg.setDraggable(true);
        peg.attrs.active = true;
    }

    function movePeg(peg, move) {
        var jumpPeg = getPegAtPosition(move.jumpPos);
        var pIndex = peg.attrs.pegIndex;
        peg.setX(boardPos[move.landPos].x);
        peg.setY(boardPos[move.landPos].y);
        removePeg(jumpPeg.attrs.pegIndex);
        hole[peg.attrs.boardPos].attrs.occupied = false;
        hole[move.landPos].attrs.occupied = true;
        peg.attrs.boardPos = move.landPos;
        buildMoveList();
    }

    function deactivatePegs() {
        for (var i = 0; i < hole.length; i++) {
            if (i != hole.length - 1) {
                peg[i].setDraggable(false);
                peg[i].off('dragstart');
                peg[i].off('dragend');
                peg[i].off('mouseover');
                peg[i].off('mouseout');
                peg[i].attrs.active = false;
                peg[i].setStroke('white');
            }
            hole[i].setStroke('black');
        }
    }

    function clearMoveList() {
        for (var i = 0; i < validMoves.length; i++) {
            validMoves[i].length = 0;
        }
    }

    function onActivePegDragStart() {
        var moveList = validMoves[this.attrs.pegIndex];

        for (var i = 0; i < moveList.length; i++) {
            var move = moveList[i];
            var jumpPeg = getPegAtPosition(move.jumpPos);

            jumpPeg.setStroke(jumpStrokeColor);
            hole[move.landPos].setStroke(landStrokeColor);
        }
        this.moveToTop();
    }

    function onActivePegDragEnd() {
        var pIndex = this.attrs.pegIndex;
        var pegPosition = this.attrs.boardPos;
        var moveList = validMoves[pIndex];

        for (var i = 0; i < moveList.length; i++) {
            var move = moveList[i];
            var jumpPeg = getPegAtPosition(move.jumpPos);

            hole[move.landPos].setStroke('black');
            jumpPeg.setStroke('white');

            if (isPegNearHole(pIndex, move.landPos)) {
                movePeg(this, move);
            } else if (i == moveList.length - 1) {
                this.setX(boardPos[pegPosition].x);
                this.setY(boardPos[pegPosition].y);
            }
        }
        gameLayer.draw();
    }

    function onActivePegMouseOver() {
        this.setStroke(activeStrokeColor);
        gameLayer.draw();
    }

    function onActivePegMouseOut () {
        this.setStroke('white');
        gameLayer.draw();
    }

})();