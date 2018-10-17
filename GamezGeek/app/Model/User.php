<?php
App::uses('AppModel', 'Model');
class User extends AppModel {
public $useTable = 'login';
	public function login($username,$password){
		
		
		$login = $this->query("select * from login where (username='$username'  or emailid='$username') and password='$password' ");
		
		
		if(count($login)==0){
					
			return 0;
			
		}else{
			
			return $login;
		}
	}
	
	public function register($username,$fullname,$emailid,$password,$passworddecode,$pricing_plan){
		
		$duplicate_check = $this->query("select * from login where username='$username' or emailid='$emailid'");
		if(count($duplicate_check)>0){		
			
			return false;
			exit;
		}else{
			$register = $this->query("insert into login value(NULL,'$username','$passworddecode','$password','$emailid','$fullname','$pricing_plan',now(),'0')");
			
			return true;
			
		}	
		
	}
	public function check_status($codedecode){
		$check_status = $this->query("select * from login where emailid = '$codedecode' and status='1' ");
		//echo "<pre>";
		//print_r(count($check_status));
		
		if(count($check_status)>0){
			return 1;
			exit;
		}else{
			$check_status = $this->query("update login set status='1' where emailid = '$codedecode' ");
			return 0;
		}
	}
	public function save_profile($username,$fullname){
		$save_profile = $this->query("update login set fullname = '$fullname'  where username = '$username'");
		return true;
		
	}
	public function save_email($username,$fullname,$emailid){
		$save_email = $this->query("update login set fullname = '$fullname',emailid='$emailid',status='0' where username = '$username'");
		
		return true;
		
	}
	public function password_change($username,$passworddecode,$password){
		$password_change = $this->query("update login set password='$passworddecode',password_original = '$password' where username = '$username' ");
		return 1 ;
	}

}
