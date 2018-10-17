<style>
.profile-details .form-control.form-white {
    color: #ffffff;
    border: 2px solid #00a8ff;
    background: rgba(0, 0, 0, 0.55);
    -webkit-transition: background-color 0.3s;
    transition: background-color 0.3s;
}
.profile-details .btn.btn-submit {
    width: 100%;
    margin-top: 30px;
    color: #ffffff;
    border: 2px solid #737373;
    background: #00a8ff;
}
.profile-details {
    width: 100% !important;
    max-width: 100% !important;
    margin: 60px auto;
}
.clear{
	clear:both;
}
.profile-details .label{
	padding: 30px;
	text-align:left;
}
.email_verify,.mail_sent{
    padding: 10px;
    margin-top: 35px;
    text-align: center;
    background: #ddd;
    border: 2px solid red;
    font-size: 18px;
    font-weight: 500;
	
}
.email_verify a {
	cursor:pointer;
}
.btn-games{
    background: #00a8ff !important;
    color: #ffffff !important;
}
</style>

<div class="col-sm-12">
	<div class="col-sm-2">
		<button type="button" class="btn btn-submit btn-games">Delete games</button>
	</div>
	<div class="col-sm-2">
		<button type="button" class="btn btn-submit btn-games">Add games</button>
	</div>
	
</div>
<?php if($this->Session->read("status")==0){ ?>
	<div class="col-sm-12">
	<div class="email_verify">Email verification not done.<a  class="verify_now">Click to send verify mail.</a></div>
	<div class="mail_sent" style="display:none;">verification mail sent to <?php echo $this->Session->read("emailid"); ?>.<a class="verify_now"></a></div>
</div>
<?php } ?>

<div class="col-sm-12">
<form action="" class="popup-form col-sm-12 profile-details ">
	<div class="text-center"><h3>My profile</h3></div>	
				<div class="col-sm-6 col-sm-offset-4">
				<div class="incorrect_msg " style="display:none;">Some technical problem. please try again later or contact support.</div>
				<div class="pass_notmatch " style="display:none;">incorrect Current password. please try again </div>
				
				<div class="duplicate_msg reg_error" style="display:none;">passwords should be min 6 and max 8</div>
				<div class="register_success " style="display:none;">Profile updated. if updated email,check verification mail in your inbox and verify.</div>
				<div class="pass_done " style="display:none;">Password Changed. Please login again.</div>
					</div>
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5>Username</h5>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control form-white username" value="<?php echo $this->Session->read("username"); ?>" placeholder="Username" readonly>
						</div>						
					</div>
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5>Fullname</h5>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control form-white fullname" value="<?php echo $this->Session->read("fullname"); ?>" placeholder="Full Name">
						</div>						
					</div>
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5>Email address</h5>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control form-white emailid" placeholder="Email Address" value="<?php echo $this->Session->read("emailid"); ?>">
						</div>						
					</div>
					
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5>Membership:</h5>
						</div>
						<div class="col-sm-9">
						
							<?php if(@$this->Session->read("membership")==0) { ?>
								<input type="text" class="form-control form-white " placeholder="" value="Free " readonly>
							<?php } else if ($this->Session->read("membership")==1) { ?>
							<input type="text" class="form-control form-white " placeholder="" value="1 Month " readonly>
							
							<?php } else if ($this->Session->read("membership")==3) { ?>
							<input type="text" class="form-control form-white " placeholder="" value="3 Month " readonly>
							<?php } else if ($this->Session->read("membership")==12) { ?>
							<input type="text" class="form-control form-white " placeholder="" value="1 Year " readonly>
							<?php } ?>
							
						
						</div>						
					</div>				
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5></h5>
						</div>
						<div class="col-sm-9">
							<button type="button" class="btn btn-submit btn_profile">Save details</button>
						</div>						
					</div>
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5>Current password</h5>
						</div>
						<div class="col-sm-9">
							<input type="password" class="form-control form-white password" placeholder="Password">
						</div>						
					</div>
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5>New password</h5>
						</div>
						<div class="col-sm-9">
							<input type="password" class="form-control form-white cpassword" placeholder="Confirm password">
						</div>						
					</div>
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-3 label">
							<h5></h5>
						</div>
						<div class="col-sm-9">
							<button type="button" class="btn btn-submit btn_password">Change Password</button>
						</div>						
					</div>
					
				</form>
				</div>
				<div class="clear"></div>
				<script>
					$(".btn_profile").click(function(){
						var fullname  = $(".fullname").val();
						var emailid  = $(".emailid").val();
						
						
						if(fullname == ""){
							$(".fullname").css("border-color","red");
						}else if(emailid == ""){
						$(".fullname").css("border-color","#ffffff");
						$(".emailid").css("border-color","red");	
						}else if(fullname !="" && emailid !="") {		
							save_profile(fullname,emailid);
						}
					});
					function save_profile(fullname,emailid){
						var formdata = "fullname="+fullname+"&emailid="+emailid;
							//alert(formdata);					
							$.ajax({
					   url: "<?php echo SITENAME?>"+"users/save_profile",
						type: 'post',
						data: formdata,
						success: function(msg){
						  if(msg==0){	  
							$(".incorrect_msg").css("display","block");
						  }else{
							$(".incorrect_msg").css("display","none");
							$(".register_success").fadeIn('slow');		
							setTimeout(function(){ 
							$(".register_success").fadeOut('slow');	
							   location.reload();
						}, 3000);							
						  }
						},
						error: function( errorThrown ){
							console.log( errorThrown );
						}
					});
					
					}
					 
					 
	/* ############### updating password ########### */
	$(".btn_password").click(function(){
		var password = $(".password").val();
		var cpassword = $(".cpassword").val();
		if(password=="" && cpassword == ""){
			$(".password,.cpassword").css("border-color","red");
			$(".duplicate_msg").fadeOut('slow');
		}else if (password==""){
			$(".password,.cpassword").css("border-color","#ffffff");
			$(".password").css("border-color","red");
				$(".duplicate_msg").fadeOut('slow');
		}else if (cpassword==""){
			$(".password,.cpassword").css("border-color","#ffffff");
			$(".cpassword").css("border-color","red");
				$(".duplicate_msg").fadeOut('slow');
		}else if(cpassword.length<=5 || cpassword.length>=9){
	$(".duplicate_msg").fadeIn('slow');
		
	}else{
		passwordChange(password,cpassword);
	}
	});
	function passwordChange (password,cpassword){
		var formdata = "password="+password+"&cpassword="+cpassword;
							//alert(formdata);					
							$.ajax({
					   url: "<?php echo SITENAME?>"+"users/update_password",
						type: 'post',
						data: formdata,
						success: function(msg){
						  if(msg==0){	  
							$(".pass_notmatch").css("display","block");
						  }else{
							$(".pass_notmatch").css("display","none");
							$(".pass_done").fadeIn('slow');		
							setTimeout(function(){ 
							$(".pass_done").fadeOut('slow');	
							   window.location.href = "http://gamezgeek.com/users/logout";
						}, 3000);							
						  }
						},
						error: function( errorThrown ){
							console.log( errorThrown );
						}
					});
					
	}
	
	$(".verify_now").click(function(){
	
	var formdata = "mail";
	$.ajax({
   url: "<?php echo SITENAME?>"+'users/verify_mail',
    type: 'post',
    data: formdata,
    success: function(msg){
      if(msg==1){	  
		$(".email_verify").css("display","none");
		$(".mail_sent").css("display","block");
	  }else{
		$(".email_verify").css("display","block");
		$(".mail_sent").css("display","none");
    }
	},
    error: function( errorThrown ){
        console.log( errorThrown );
    }
});
	});
				</script>