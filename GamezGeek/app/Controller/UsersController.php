<?php
class UsersController extends AppController{
	public $uses = array('Onlinegames','User');
    public $helpers = array('Js');
    public $components = array('RequestHandler');
	
	public function index(){
		
	$this->layout = 'default';
	if($this->Session->read("username")==""){
		$this->redirect(array('controller' => 'home', 'action' => 'index'));
	}
	
	}
	public function login(){
	
		
	if ($this->request->is('ajax')) {
        // Configure::write('debug', 0);
         $this->autoRender = false;
         $this->layout = 'ajax';
			 
		$username = $_POST["username"];
		$password = $_POST["password"];
		$passworddecode = md5($_POST["password"]);
		$remember_me = @$_POST["remember_me"];
		if($username!="" && $password != "" ){
			
			$login = $this->User->login($username,$passworddecode);
			
			if($login != 0){
				
				$this->Session->write('user_info', $login);
				$this->Session->write('username', $login[0]['login']['username']);
				$this->Session->write('fullname', $login[0]['login']['fullname']);
				$this->Session->write('membership', $login[0]['login']['membership']);
				$this->Session->write('register_date', $login[0]['login']['register_date']);
				$this->Session->write('emailid', $login[0]['login']['emailid']);
				$this->Session->write('status', $login[0]['login']['status']);
				//if($remember_me=='1')
                  //  {
                  //  $hour = time() + 3600 * 24 * 30;
                  //  setcookie('username', $username, $hour);
                  //  setcookie('password', $password, $hour);
                  //  }
					
				echo $login;
			}else{
				
				echo 0;
			}
		}
    }
        


   } 
   public function register(){
	   if ($this->request->is('ajax')) {
        // Configure::write('debug', 0);
         $this->autoRender = false;
         $this->layout = 'ajax';
			 
		$username = $_POST["username"];
		$fullname = $_POST["fullname"];
		$emailid = $_POST["emailid"];
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		$pricing_plan = $_POST["pricing_plan"];
		$passworddecode = md5($_POST["password"]);
		$mailverify1 =  base64_encode($emailid);
		$mailverify =  base64_encode($mailverify1);
		
		if($password == $cpassword ){
			
			$register = $this->User->register($username,$fullname,$emailid,$password,$passworddecode,$pricing_plan);
			if($register == FALSE){
				echo 0;
				
			}else{
				//mail try
		$to = $emailid;
         $subject = "verify account";
         
      
        $message = "<b> Dear  ".$fullname.",</b>";        
		 
		 $message .= "<h1>Please verify your gamezgeek account.</h1><br/><br/><br/><b>this is a url to verify your mail account:<br/><a href='http://gamezgeek.com/users/verify?id=".$mailverify."' target='_blank'>Click here to verify account</a></b><br/><br/><br/><b>Thanks,<br/>Gamezgeek</b>";
      
         $header = "From:ashwini.r.nadagoud@gmail.com  \r\n";
         $header .= "Cc:ashwini.r.nadagoud@gmail.com  \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
				 
				//ajax response on success
				echo 1;
			}
		}
    }
   }
   public function verify(){
	   $verifycode = $_GET["id"];
	   if($verifycode==""){
		   $this->redirect(array('controller' => 'home', 'action' => 'index'));
	   }else{
		$codedecode1 = base64_decode($verifycode);
		$codedecode = base64_decode($codedecode1);
	   
		$check_status = $this->User->check_status($codedecode);
		//echo "<pre>";
		//print_r($check_status);
		//exit;
		if($check_status==1){
		//	echo "Already verified account";
			$this->redirect(array('controller' => 'users', 'action' => 'verify_status?status=error'));
		}else{
			$this->redirect(array('controller' => 'users', 'action' => 'verify_status?status=success'));
		}
		
	   
	   }
	
   }
   public function verify_status(){
		$ver_status="";
		$ver_status = @$_GET['status'];
	  
	     $this->layout="verify";
		 if($ver_status==""){
			  $this->redirect(array('controller' => 'home', 'action' => 'index'));
		 }else if($ver_status=="error"){
		   $email_verify_info ="Already verified.";
		   $this->set('email_verify_info',"Already verified.");		  
		   
	   }else if($ver_status=="success"){
		   $email_verify_info = "Successfully verified.";
		    $this->set('email_verify_info',"Successfully verified.");
			 
	   }
   }
   public function premium(){
	   $this->layout = "default";
   }
    public function profile(){
	   $this->layout = "default";
	   if($this->Session->read("username")==""){
		   $this->redirect(array('controller' => 'home', 'action' => 'index'));
	   }
	   
   } 
   public function save_profile(){
	 
	   	if ($this->request->is('ajax')) {
        // Configure::write('debug', 0);
         $this->autoRender = false;
         $this->layout = 'ajax';
		$username  = $this->Session->read("username");
		$fullname = $_POST["fullname"];
		$emailid = $_POST["emailid"];
		$emailid_session = $this->Session->read("emailid");
		if($emailid == $emailid_session){
			$save_profile = $this->User->save_profile($username,$fullname);
			
			
			if($save_profile==true){
				$this->Session->write('fullname', $fullname);
				echo "1";
			}else{
				echo "0";
			}
		}else{
			$save_email = $this->User->save_email($username,$fullname,$emailid);
			$this->Session->write('fullname', $fullname);
			$this->Session->write('emailid', $emailid);
			$mailverify1 =  base64_encode($emailid);
		$mailverify =  base64_encode($mailverify1);
			if($save_email == true){
				$to = $emailid;
         $subject = "verify account";
         
      
        $message = "<b> Dear  ".$fullname.",</b>";        
		 
		 $message .= "<h1>Please verify your gamezgeek account.</h1><br/><br/><br/><b>this is a url to verify your mail account:<br/><a href='http://gamezgeek.com/users/verify?id=".$mailverify."' target='_blank'>Click here to verify account</a></b><br/><br/><br/><b>Thanks,<br/>Gamezgeek</b>";
       
         $header = "From:ashwini.r.nadagoud@gmail.com \r\n";
         $header .= "Cc:ashwini.r.nadagoud@gmail.com  \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
		 echo "1";
				 
			}else{
				echo "0";
			}
		}
		}
   }
   public function update_password(){
	   	
	if ($this->request->is('ajax')) {
        // Configure::write('debug', 0);
         $this->autoRender = false;
         $this->layout = 'ajax';
			 
		$username = $this->Session->read("username");
		$password = $_POST["password"];
		$passworddecode = md5($_POST["password"]);
		$cpassword = $_POST["cpassword"];
		$cpassworddecode =  md5($_POST["cpassword"]);
		if($username!="" && $password != "" ){
			
			$login = $this->User->login($username,$passworddecode);
			
			if($login != 0){
				$login = $this->User->password_change($username,$cpassworddecode,$cpassword);
				if($login == 1){
						
				echo "1";
				}else {
					
					echo "0";
				}
			}else{
				
				echo 0;
			}
		}
    }
	   
   }
   public function payment(){
	   $this->layout = "games";
   }
   public function verify_mail(){
	   if ($this->request->is('ajax')) {
        // Configure::write('debug', 0);
         $this->autoRender = false;
         $this->layout = 'ajax';
			 $emailid = $this->Session->read("emailid");
	   $mailverify1 =  base64_encode($emailid);
		$mailverify =  base64_encode($mailverify1);
		$fullname = $this->Session->read("fullname");
		$to = $emailid;
        $subject = "verify account";        
      
        $message = "<b> Dear  ".$fullname.",</b>";        
		 
		 $message .= "<h1>Please verify your gamezgeek account.</h1><br/><br/><br/><b>this is a url to verify your mail account:<br/><a href='http://gamezgeek.com/users/verify?id=".$mailverify."' target='_blank'>Click here to verify account</a></b><br/><br/><br/><b>Thanks,<br/>Gamezgeek</b>";
       
         $header = "From:ashwini.r.nadagoud@gmail.com\r\n";
         $header .= "Cc:ashwini.r.nadagoud@gmail.com  \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "1";
         }else {
            echo "0";
         }
			
		}
  
	  
   }
   public function logout(){
	   $this->Session->destroy();

	   $this->redirect(array('controller' => 'home', 'action' => 'index'));
   }
		
}
?>