var SITENAME = "/";
$(".btn_loginsubmit").click(function(){
	var login_username  = $(".login_username").val();
	var login_password  = $(".login_password").val();
	if(login_username == "" && login_password ==""){
		$(".login_username").css("border-color","red");
		$(".login_password").css("border-color","red");
	}else if(login_username ==""){
		$(".login_username").css("border-color","red");
		$(".login_password").css("border-color","#ffffff");
	}else if (login_password ==""){
		$(".login_username").css("border-color","#ffffff");
		$(".login_password").css("border-color","red");
	}
	if(login_username !="" && login_password !=""){
		$(".login_username").css("border-color","#ffffff");
		$(".login_password").css("border-color","#ffffff");
		
		login(login_username,login_password);
	}
});


function login(login_username,login_password){
	if($("#rememberme").is(":checked")){
		var formdata = "username="+login_username+"&password="+login_password+"&remember_me=1";
	}else{
		var formdata = "username="+login_username+"&password="+login_password;
	}
	
	$.ajax({
    url: SITENAME+'users/login',
    type: 'post',
    data: formdata,
    success: function(msg){
      if(msg==0){
		$(".login_error").css("display","block");
	  }else{
		$(".login_error").css("display","none");
		$(".login_success").fadeIn('slow');
		setTimeout(function(){ 
			window.location.href = SITENAME;
		}, 2000);
	  }
    },
    error: function( errorThrown ){
        console.log( errorThrown );
    }
});
}
$(".pricing_select li").click(function(){
	//alert($(this).find("a").attr("class"));
	$(".pricing_plan").val($(this).find("a").attr("class"));
});
$(".btn_register").click(function(){
	var r_username = $(".r_username").val();
	var r_fullname = $(".r_fullname").val();
	var r_email = $(".r_email").val();
	var r_password = $(".r_password").val();
	var r_cpassword = $(".r_cpassword").val();
	var pricing_plan = $(".pricing_plan").val();
	var tick = $("#squaredOne").is(':checked');
	//alert(r_username.length)
	if(r_username =="" && r_fullname=="" && r_email=="" && r_password=="" && r_cpassword=="" && pricing_plan=="null"){
		$(".r_username,.r_fullname,.r_email,.r_password,.r_cpassword,.pricing_plan").css("border-color","red");
	}else if(r_username =="" || r_fullname=="" || r_email=="" || r_password=="" || r_cpassword=="" || pricing_plan=="null" ){
		$(".r_username,.r_fullname,.r_email,.r_password,.r_cpassword,.pricing_plan").css("border-color","#ffffff");
		$(".reg_error").fadeOut('slow');
		$(".register_fillall").fadeIn('slow');
	}else if(r_username.length<6  ){
		$(".reg_error").fadeOut('slow');
		$(".register_user").fadeIn('slow');
	}else if( !isValidEmailAddress( r_email ) ){
	$(".reg_error").fadeOut('slow');
		$(".register_fillall").fadeOut('slow');
		$(".register_email").fadeIn('slow');
	}	
	else if(r_password != r_cpassword ){
	$(".reg_error").fadeOut('slow');
		$(".register_email").fadeOut('slow');
		$(".register_pass").fadeIn('slow');		
	}else if(r_password.length<=5 || r_password.length>=9){
	$(".reg_error").fadeOut('slow');
		$(".register_pass").fadeIn('slow');	
	}else if(tick==false){
		$(".register_pass").fadeOut('slow');
$(".reg_error").fadeOut('slow');		
		$(".register_tick").fadeIn('slow');	
	}	
	else if(r_username !="" && r_fullname !="" && r_email !="" && r_password !="" && r_cpassword !="" && pricing_plan !="null"){
		$(".register_tick").fadeOut('slow');		
		$(".reg_error").fadeOut('slow');		
		register(r_username,r_fullname,r_email,r_password,r_cpassword,pricing_plan);
	}
	
});
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
function register(r_username,r_fullname,r_email,r_password,r_cpassword,pricing_plan){
	var formdata = "username="+r_username+"&fullname="+r_fullname+"&emailid="+r_email+"&password="+r_password+"&cpassword="+r_cpassword+"&pricing_plan="+pricing_plan;
	//alert(formdata);
		$.ajax({
   url: SITENAME+'users/register',
    type: 'post',
    data: formdata,
    success: function(msg){
      if(msg==0){	  
		$(".duplicate_msg").css("display","block");
	  }else{
		$(".duplicate_msg").css("display","none");
		$(".register_success").fadeIn('slow');		
		setTimeout(function(){ 
			$("#modal1").modal("hide");
			window.location.href = "www.gamezgeek.com/users/payment";
		}, 3000);
		
	  }
    },
    error: function( errorThrown ){
        console.log( errorThrown );
    }
});
}
