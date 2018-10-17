<script>

function figure(type,color,lpos) {
    this.type = type;
    this.color = color;
    this.lpos = lpos;
}

function tile(name,selected,possible) {
    this.name = name;
    this.selected = selected;
    this.possible = possible;
}

function Game() {
    this.turn = "White";
    this.figures;
    this.tiles = [];
    this.fposx = ["A","B","C","D","E","F","G","H"];
    this.fposy = ["1","2","3","4","5","6","7","8"];
    this.imgFig = [];
    for(var i = 0; i < 12; i++) { 
        this.imgFig[i] = new Image(); 
        this.imgFig[i].src = '/img/chess/images/' + i + '.png'; 
    }
}
Game.prototype = {
    constructor:Game,
    initializeGame : function() {
        this.magic = false;
        this.rock = [0,0,0,0,0,0];
        for (var i = 0 ; i < 8 ; i++) {
            for (var j = 0 ; j < 8 ; j++) {
                tmp = this.fposx[i] + " " + this.fposy[j];
                this.tiles.push(new tile(tmp , "No" , "No"));
            }
        }
        this.figures = [
            new figure("Tower","White","A 1"),
            new figure("Officer","White","C 1"),
            new figure("Horse","White","B 1"),
            new figure("Queen","White","D 1"),
            new figure("King","White","E 1"),
            new figure("Horse","White","G 1"),
            new figure("Officer","White","F 1"),
            new figure("Tower","White","H 1"),
            new figure("Pawn","White","A 2"),
            new figure("Pawn","White","B 2"),
            new figure("Pawn","White","C 2"),
            new figure("Pawn","White","D 2"),
            new figure("Pawn","White","E 2"),
            new figure("Pawn","White","F 2"),
            new figure("Pawn","White","G 2"),
            new figure("Pawn","White","H 2"),
            new figure("Tower","Black","A 8"),
            new figure("Officer","Black","C 8"),
            new figure("Horse","Black","B 8"),
            new figure("Queen","Black","D 8"),
            new figure("King","Black","E 8"),
            new figure("Horse","Black","G 8"),
            new figure("Officer","Black","F 8"),
            new figure("Tower","Black","H 8"),
            new figure("Pawn","Black","A 7"),
            new figure("Pawn","Black","B 7"),
            new figure("Pawn","Black","C 7"),
            new figure("Pawn","Black","D 7"),
            new figure("Pawn","Black","E 7"),
            new figure("Pawn","Black","F 7"),
            new figure("Pawn","Black","G 7"),
            new figure("Pawn","Black","H 7")];
        this.drawField();
    },
    getAllposs : function (color, sim) {
        var allpos = [];
        for (var x in this.figures) {
            if (this.figures[x].color == color && this.showPossible(x, sim)) {
                allpos = allpos.concat(this.showPossible(x, sim));
            }
        }
        if (allpos.length < 1) {
            return false;
        } else {
            return allpos;
        }
    },
    endCheck : function () {
        if (!this.getAllposs(this.turn, false)) {
            if (this.magic) {
                alert("Checkmate. " + this.turn + " lose");
            } else {
                alert("Pat");
            }
            this.endGame();
        } 
    },
    endGame : function () {
        this.turn = "White"; 
        this.tiles = [];
        this.ctx.clearRect(0,0,this.cw,this.cw);
       // alert(this.isSelected());
        var restart = confirm("Start new game?");
        if (restart) {
            newGame.initializeGame();
        } else {
            this.endGame();
        }
    },
    checkSit : function() {
        var posfield = this.getAllposs(this.turn, true);
        if (posfield) {
            if (this.kingCheck(posfield)) {
                this.magic = true;
                return true;
            }
        }
        this.magic = false;
        return false;
    },
    kingCheck : function(enemypos) {
        
        for (i = 0; i < enemypos.length; i++) {
            if (this.getFigure(enemypos[i])) {
                if (this.figures[this.getFigure(enemypos[i])].type == "King" && this.figures[this.getFigure(enemypos[i])].color !== this.turn ) {
                    return true;
                }
            }
        }
        return false;
    },
    pawnZ : function(pos) {
        var figlist = ["Horse", "Officer", "Tower", "Queen"];
        var sel = parseInt(prompt("Turn pawn into : \n 0 - Horse\n 1 - Officer\n 2 - Tower\n 3 - Queen"));
        if (sel < 0 || sel > 3 || isNaN(sel) || sel == null || sel == "") {
            alert("Wrong selection");
            this.pawnZ(pos);
        } else {
            this.figures[this.getFigure(pos)].type = figlist[sel];
        }
    },
    moveDirection : function(dir, coords) {
        var x = coords[0];
        var y = coords[1];
        var t = this.tilesize;
        switch (dir) {
            case "l":
                x-=t;
                break;
            case "r":
                x+=t;
                break;
            case "u":
                y-=t;
                break;
            case "d":
                y+=t;
                break; 
            case "ul":
                x-=t;
                y-=t;
                break;
            case "ur":
                x+=t;
                y-=t;
                break;
            case "dl":
                x-=t;
                y+=t;
                break;
            case "dr":
                x+=t;
                y+=t;
                break;
            case "ull":
                x-=2 * t;
                y-=t;
                break;
            case "urr":
                x+=2 * t;
                y-=t;
                break;
            case "dll":
                x-=2 * t;
                y+=t;
                break;
            case "drr":
                x+=2 * t;
                y+=t;
                break;
            case "uul":
                x-=t;
                y-=2 * t;
                break;
            case "uur":
                x+=t;
                y-=2 * t;
                break;
            case "ddl":
                x-=t;
                y+=2 * t;
                break;
            case "ddr":
                x+=t;
                y+=2 * t;
                break;    
        }
        return [x, y];
    },
    checkRock : function(rocknroll, color) {
        var mleft, mright;
        switch (color) {
            case "White":
                if (rocknroll[0] == 0 && (rocknroll[1] == 0 || rocknroll[2] == 0)) {
                    if (!this.getFigure("B 1") && !this.getFigure("C 1") && !this.getFigure("D 1") && rocknroll[1] == 0) {
                        mleft = true;
                    }
                    if (!this.getFigure("F 1") && !this.getFigure("G 1") && rocknroll[2] == 0) {
                        mright = true;
                    }
                }
                break;
            case "Black":
                if (rocknroll[3] == 0 && (rocknroll[4] == 0 || rocknroll[5] == 0)) {
                    if (!this.getFigure("B 8") && !this.getFigure("C 8") && !this.getFigure("D 8") && rocknroll[4] == 0) {
                        mleft = true;
                    }
                    if (!this.getFigure("F 8") && !this.getFigure("G 8") && rocknroll[5] == 0) {
                        mright = true;
                    }
                }
                break;
        }
        if (mright || mleft) {
            return [true, mleft, mright]
        } else {
            return [false]
        }
        
    },
    moveFigure : function(oldlpos, newlpos) {
        if ((this.figures[this.getFigure(oldlpos)].type == "King") && (oldlpos == "E 1" || oldlpos == "E 8") && (newlpos == "C 1" || newlpos == "C 8" || newlpos == "G 1" || newlpos == "G 8")) {
            //alert("Balboa?");
            this.letsRock(oldlpos,newlpos);
            //alert("Rocky");
        } else {
            if (this.figures[this.getFigure(oldlpos)].type == "Tower") {
                if (oldlpos == "A 1") {
                   this.rock[1] = 1; 
                }
                if (oldlpos == "A 8") {
                    this.rock[2] = 1; 
                }
                if (oldlpos == "H 1") {
                    this.rock[4] = 1; 
                }
                if (oldlpos == "H 1") {
                    this.rock[5] = 1; 
                }
            }
            if (this.figures[this.getFigure(oldlpos)].type == "King") {
                if (oldlpos == "E 1") {
                   this.rock[0] = 1; 
                }
                if (oldlpos == "E 8") {
                    this.rock[3] = 1; 
                }
            }
            if  (this.getFigure(newlpos)) {
                this.figures.splice(this.getFigure(newlpos), 1);
            }
            this.figures[this.getFigure(oldlpos)].lpos = newlpos;
            if (this.figures[this.getFigure(newlpos)].type == "Pawn") {
                switch (this.figures[this.getFigure(newlpos)].color) {
                    case "White":
                        if (newlpos.substring(2) == "8") {
                            this.pawnZ(newlpos);
                        }
                        break;
                    case "Black":
                        if (newlpos.substring(2) == "1") {
                            this.pawnZ(newlpos);
                        }
                        break;
                }   
            }
        }
        
        if (this.checkSit()) {
            alert("Check (" + this.turn +")");
            
        }  
        this.chTurn();
        this.endCheck();
        this.drawField();
    },
    letsRock : function (oldlpos, newlpos) {
        this.figures[this.getFigure(oldlpos)].lpos = newlpos;
        switch (newlpos) {
            case "C 1":
                this.figures[this.getFigure("A 1")].lpos = "D 1";
                this.rock[0] = 1;
                break;
            case "C 8":
                this.figures[this.getFigure("A 8")].lpos = "D 8";
                this.rock[4] = 1;
                break;
            case "G 1":
                this.figures[this.getFigure("H 1")].lpos = "F 1";
                this.rock[0] = 1;
                break;
            case "G 8":
                this.figures[this.getFigure("H 8")].lpos = "F 8";
                this.rock[4] = 1;
                break;
        }
    }, 
    unRock : function (oldlpos,newlpos) {
       this.figures[this.getFigure(newlpos)].lpos = oldlpos;
        switch (newlpos) {
            case "C 1":
                this.figures[this.getFigure("D 1")].lpos = "A 1";
                this.rock[0] = 0;
                break;
            case "C 8":
                this.figures[this.getFigure("D 8")].lpos = "A 8";
                this.rock[4] = 0;
                break;
            case "G 1":
                this.figures[this.getFigure("F 1")].lpos = "H 1";
                this.rock[0] = 0;
                break;
            case "G 8":
                this.figures[this.getFigure("F 8")].lpos = "H 8";
                this.rock[4] = 0;
                break;
        } 
    },
    simulateMove : function (oldlpos, newlpos) {
        var result = true;    
        var tmptype = "None";
        var rocky = false;
        if ((this.figures[this.getFigure(oldlpos)].type == "King") && (oldlpos == "E 1" || oldlpos == "E 8") && (newlpos == "C 1" || newlpos == "C 8" || newlpos == "F 1" || newlpos == "F 8")) {
            this.letsRock(oldlpos,newlpos);
            rocky = true;
        } else {
            if  (this.getFigure(newlpos)) {
                tmptype = this.figures[this.getFigure(newlpos)].type;
                var savefig = this.getFigure(newlpos);
                var tmpcolor = this.figures[this.getFigure(newlpos)].color;
                this.figures.splice(this.getFigure(newlpos), 1);
            }
            this.figures[this.getFigure(oldlpos)].lpos = newlpos;
            
        }
            if (this.checkSit()) {
                result = false;
            } 
            if (rocky) {
                this.unRock(oldlpos,newlpos);
            } else {
                this.figures[this.getFigure(newlpos)].lpos = oldlpos;
            }
            if (tmptype !== "None") {
                this.figures.splice(savefig, 0, new figure(tmptype, tmpcolor, newlpos));    
            }
        return result;
    },
    chTurn : function () {
        if (this.turn == "White") {
            this.turn = "Black";
        } else {
            this.turn = "White";
        }
    },
    refreshPossibility : function(tile) {
        tile.possible = "No";
    },
    getfCoords : function(literal) {
        var lit = literal.substring(0,1);
        var num = literal.substring(2);
        var numeral = [];
        for (var i = 0; i < 8; i++) {
            if (lit === this.fposx[i]) {
                numeral[0] = parseInt((2 * i + 1) * this.tilesize / 2);
            }
            if (num === this.fposy[i]) {
                numeral[1] = parseInt((2 * i + 1) * this.tilesize / 2);
            }
        }
        //alert(numeral);
        return numeral;
    },
    getTile : function(lpos) {
        //alert(lpos);
        for (var k = 0 ; k < 64 ; k++) {
            if ( this.tiles[k].name === lpos ) {
                //alert(k);
                return k;
            }
        }
    },
    getFigure : function (pos) {
        for (var x in this.figures) {
            if (this.figures[x].lpos === pos) {
                return x;
            }
        }
        return false;
    },
    showPossible : function(fig, sim) {
        var figcoords = this.getfCoords(this.figures[fig].lpos);
        var fpos = this.figures[fig].lpos;
        var posscoords = [];
        var checkcoords = figcoords;
        var lit;
        switch (this.figures[fig].type) {
            case "Pawn":
                switch (this.figures[fig].color) {
                    case "Black":
                        var dir = ["u", "ul", "ur"];
                        var def = "7";
                        break;
                    case "White":
                        var dir = ["d", "dl", "dr"];
                        var def = "2";
                        break;
                }
                for (var i = 0; i < dir.length; i++) {
                    checkcoords = figcoords;
                    checkcoords = this.moveDirection(dir[i], checkcoords);
                    if (checkcoords[0] >= 0 && checkcoords[1] >= 0 && checkcoords[0] <= this.cw && checkcoords[1] <= this.cw) {
                        lit = this.getFieldPos(checkcoords[0], checkcoords[1]);
                        if (this.getFigure(lit) && i > 0 ) {
                            if (this.figures[this.getFigure(lit)].color !== this.figures[fig].color) {
                                if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }
                            }
                        }
                        if (!this.getFigure(lit) && i == 0) {
                            if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }    
                            
                            checkcoords = this.moveDirection(dir[i], checkcoords);
                            lit = this.getFieldPos(checkcoords[0], checkcoords[1]);
                            if (this.figures[fig].lpos.substring(2) === def && !this.getFigure(lit)) {
                                if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }  
                                
                            }
                        } 
                    }
                }
            break;
            case "Tower":
            case "Officer":
            case "Queen":
                switch (this.figures[fig].type) {
                    case "Tower":
                        var dir = ["u", "d", "l", "r"];
                        break;
                    case "Officer":
                        var dir = ["ul", "ur", "dl", "dr"];
                        break;
                    case "Queen":
                        var dir = ["u", "d", "l", "r", "ul", "ur", "dl", "dr"];
                        break;
                }
                for (var i = 0; i < dir.length; i++) {
                    checkcoords = figcoords;
                    checkcoords = this.moveDirection(dir[i], checkcoords);
                    while (checkcoords[0] >= 0 && checkcoords[1] >= 0 && checkcoords[0] <= this.cw && checkcoords[1] <= this.cw) {
                        lit = this.getFieldPos(checkcoords[0], checkcoords[1]);
                        checkcoords = this.moveDirection(dir[i], checkcoords);
                        if (!this.getFigure(lit)) {
                            if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }    
                            
                        } else if (this.getFigure(lit)) {
                            if (this.figures[this.getFigure(lit)].color !== this.figures[fig].color) {
                                if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }  
                                
                                break;
                            }
                            break;                        
                        }
                    }
                }
                break;
            case "King":
                var dir = ["u", "d", "l", "r", "ul", "ur", "dl", "dr"];
                if (this.checkRock(this.rock,this.turn)[0]) {
                    checkcoords = figcoords;
                    if (this.checkRock(this.rock,this.turn)[1]) {
                        checkcoords = this.moveDirection(dir[2],checkcoords);
                        checkcoords = this.moveDirection(dir[2],checkcoords);
                        lit = this.getFieldPos(checkcoords[0], checkcoords[1]);
                        if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }
                    }
                    checkcoords = figcoords;
                    if (this.checkRock(this.rock,this.turn)[2]) {
                        checkcoords = this.moveDirection(dir[3],checkcoords);
                        checkcoords = this.moveDirection(dir[3],checkcoords);
                        lit = this.getFieldPos(checkcoords[0], checkcoords[1]);
                        if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }
                    }
                }
                for (var i = 0; i < dir.length; i++) {
                    checkcoords = figcoords;
                    checkcoords = this.moveDirection(dir[i], checkcoords);
                    if (checkcoords[0] >= 0 && checkcoords[1] >= 0 && checkcoords[0] <= this.cw && checkcoords[1] <= this.cw) {
                        lit = this.getFieldPos(checkcoords[0], checkcoords[1]);
                        if (!this.getFigure(lit)) {
                            if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }   
                            
                        } else if (this.getFigure(lit)) {
                            if (this.figures[this.getFigure(lit)].color !== this.figures[fig].color) {
                                if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }  
                                
                            }
                        }
                    }
                    if (this.checkRock(this.rock, this.turn) ) {
                        switch (this.turn) {
                            case "White":
                                break;
                            case "Black":
                                break;
                        }
                    }
                }
                break;
            case "Horse":
                var dir = ["ull", "drr", "dll", "urr", "uul", "uur", "ddl", "ddr"];
                for (var i = 0; i < dir.length; i++) {
                    checkcoords = figcoords;
                    checkcoords = this.moveDirection(dir[i], checkcoords);
                    if (checkcoords[0] >= 0 && checkcoords[1] >= 0 && checkcoords[0] <= this.cw && checkcoords[1] <= this.cw) {
                        lit = this.getFieldPos(checkcoords[0], checkcoords[1]);
                        if (!this.getFigure(lit)) {
                            if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                }   
                            
                        } else if (this.getFigure(lit)) {
                            if (this.figures[this.getFigure(lit)].color !== this.figures[fig].color) {
                                if (!sim) {
                                    this.chTurn();
                                    if (this.simulateMove(fpos, lit)) {
                                        posscoords.push(lit);  
                                    }
                                    this.chTurn();
                                } else if (sim) {
                                    posscoords.push(lit);
                                } 
                                
                            }
                        }
                    }
                }
                break;
        }
        if (posscoords.length > 0) {
            return posscoords;
        } else {
            return false;
        }
    },
    chtoPossible : function(posarr) {
        if (posarr) {
            for (var i = 0; i < posarr.length; i++) {
                
                this.tiles[this.getTile(posarr[i])].possible = "Yes";
            }
        }
    },
    tileSelect : function(event) {
        //var event = event;
        var ressel = this.showCoords(event);
        var seltile = this.getTile(this.showCoords(event));
        //alert(seltile);
        //alert(this.isSelected());
        if (this.isSelected()[0]) {
            //alert("tyt vse ok");
            if (seltile == this.isSelected()[1]) {
                this.tiles[seltile].selected = "No";
                this.tiles.forEach(this.refreshPossibility);
            }
            if (this.isPossible(seltile)) {
                this.moveFigure(this.tiles[this.isSelected()[1]].name, this.tiles[seltile].name);
                this.tiles.forEach(this.refreshPossibility);
                this.tiles[this.isSelected()[1]].selected = "No";
            }
                
        } else {
                this.tiles[seltile].selected = "Yes";
                if (this.getFigure(this.tiles[seltile].name)) {
                    if (this.figures[this.getFigure(this.tiles[seltile].name)].color !== this.turn) {
                        alert ("It's not your turn");    
                        this.tiles[seltile].selected = "No";
                    } else {
                        this.chtoPossible(this.showPossible(this.getFigure(this.tiles[seltile].name), false));
                    }
                }
                
        }
        //this.isSelected();
        //alert(this.tiles[seltile].selected);
        //this.ctx.clearRect(0,0,this.cw,this.cw);
        this.drawField();
    },
    isSelected : function() {
        for (var i = 0; i < 64; i++) {
            if (this.tiles[i].selected == "Yes") {
                return [true,i];
            }
        }
        return [false];
    },
    isPossible : function(i) {
            if (this.tiles[i].possible == "Yes") {
                return true;
            }
        return false;
    },
    renderTile : function(ftile) {
        var sel = ftile.selected;
        var pos = ftile.possible;
        var txcor = this.fposx.indexOf(ftile.name.substring(0, 1));
        var tycor = this.fposy.indexOf(ftile.name.substring(2));
        var colors = [ "#000", "#FFF", "#03F", "#FE0"];
        if (sel === "Yes") {
            this.ctx.fillStyle = colors[2];    
        } else if (pos === "Yes") {
            this.ctx.fillStyle = colors[3];
        } else {
            this.ctx.fillStyle = colors[(txcor + tycor) % 2];
        }
        this.ctx.fillRect(txcor * this.tilesize , tycor * this.tilesize , (txcor + 1) * this.tilesize , (tycor + 1) * this.tilesize);
    },
    drawField : function() {
    this.canvas = document.getElementById('field');
    this.cw = parseInt(Math.min(window.innerWidth,window.innerHeight) / 1.3)
    || parseInt(Math.min(document.documentElement.clientWidth,document.documentElement.clientHeight) / 1.3)
    || parseInt(Math.min(document.body.clientWidth,document.body.clientHeight) / 1.3);
    this.tilesize = parseInt(this.cw / 8);
    var lambda = parseInt(0.4 * this.tilesize);
    this.canvas.width = this.cw;
    this.canvas.height = this.cw;
    this.ctx = this.canvas.getContext('2d');
    this.ctx.clearRect(0,0,this.cw,this.cw);
    this.tiles.forEach(this.renderTile.bind(this));
    this.figures.forEach(this.drawFigure.bind(this));
    },
    getFieldPos : function(x,y) {
        return this.fposx[parseInt(8 * x / this.cw)] + " " + this.fposy[parseInt(8 * y / this.cw)]
    },
    showCoords : function(event) {
        var rect = this.canvas.getBoundingClientRect();   
        var x = event.clientX - parseInt(rect.left);
        var y = event.clientY - parseInt(rect.top);
        var coords = this.getFieldPos(x , y);
        return coords;
    },
    clearLabel : function() {
        if (!this.isSelected()[0]) {
            document.getElementById("mousepos").innerHTML="Select field";
        }
    },
    chLabel : function(event) {
        if (!this.isSelected()[0]) {
            document.getElementById("mousepos").innerHTML = this.showCoords(event);
            if (this.getFigure(this.showCoords(event))) {
                document.getElementById("mousepos").innerHTML += " " + this.figures[this.getFigure(this.showCoords(event))].color + " " + this.figures[this.getFigure(this.showCoords(event))].type;
            }
        }
    },
    drawFigure : function(fig) {
        var flit = fig.lpos;
        var fshift = parseInt(this.tilesize/2);
        var fcoords = this.getfCoords(flit);
        switch (fig.color) {
            case "White":
                switch (fig.type) {
                    case "Queen":
                        this.ctx.drawImage(this.imgFig[0], fcoords[0] - fshift, fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "King":
                        this.ctx.drawImage(this.imgFig[1], fcoords[0] - fshift, fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Pawn":
                        this.ctx.drawImage(this.imgFig[2] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Tower":
                        this.ctx.drawImage(this.imgFig[3] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Horse":
                        this.ctx.drawImage(this.imgFig[4] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Officer":
                        this.ctx.drawImage(this.imgFig[5] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                }
                break;
            case "Black":
                switch (fig.type) {
                    case "Queen":
                        this.ctx.drawImage(this.imgFig[6] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "King":
                        this.ctx.drawImage(this.imgFig[7] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Pawn":
                        this.ctx.drawImage(this.imgFig[8] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Tower":
                        this.ctx.drawImage(this.imgFig[9] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Horse":
                        this.ctx.drawImage(this.imgFig[10] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);
                        break;
                    case "Officer":
                        this.ctx.drawImage(this.imgFig[11] , fcoords[0] - fshift , fcoords[1] - fshift, this.tilesize, this.tilesize);   
                        break;
                }
                break;
        }
    }
}
var newGame = new Game();
</script>
<body background = "/img/chess/bg.jpg" onload = "newGame.initializeGame()" onresize = "newGame.drawField()" style = "background-color:red">
<center><h3 id="mousepos">Select field</h3>
</center>
<br>
<center><canvas id="field" touchstart="newGame.tileSelect(event)" ontouch="newGame.tileSelect(event)"  onmousedown="newGame.tileSelect(event)" touchend="newGame.tileSelect(event)"  onmouseover='newGame.chLabel(event)' onmousemove='newGame.chLabel(event)' onmouseout='newGame.clearLabel()'>
</canvas></center>
</body>