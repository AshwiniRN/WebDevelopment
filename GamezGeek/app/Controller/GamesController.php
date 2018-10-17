<?php
class GamesController extends AppController{
	public $uses = array('Onlinegames','User');
    public $helpers = array('Js');
    public $components = array('RequestHandler');
	
	public function index(){
		
	$this->layout = 'default';
	if($this->Session->read("username")==""){
		$this->redirect(array('controller' => 'home', 'action' => 'index'));
	}
	
	}
	public function ludo(){
		$this->layout = "games";
		
	}
	public function triangular_peg_game(){
		$this->layout = "games";
		
	}
	public function tic_tac_toe(){
		$this->layout = "games";
		
	}
	public function crossword(){
		$this->layout = "default";
		
	}
	public function snake(){
		$this->layout = "games";
		//echo $this->Session->read('membership');
		if($this->Session->read('membership')==0){
			$this->redirect(array('controller' => 'users', 'action' => 'premium#pricing'));
		}
		
	}
	public function chess(){
		$this->layout = "games";
		if($this->Session->read('membership')==0){
			$this->redirect(array('controller' => 'users', 'action' => 'premium#pricing'));
		}
		
	}
	public function coppit(){
		$this->layout = "default";
		if($this->Session->read('membership')==0){
			$this->redirect(array('controller' => 'users', 'action' => 'premium#pricing'));
		}
		
	}
	
	public function sudoku(){
		$this->layout = "default";
		if($this->Session->read('membership')==0){
			$this->redirect(array('controller' => 'users', 'action' => 'premium#pricing'));
		}
		
	}
   public function logout(){
	   $this->Session->destroy();
	   $this->redirect(array('controller' => 'home', 'action' => 'index'));
   }
		
}
?>