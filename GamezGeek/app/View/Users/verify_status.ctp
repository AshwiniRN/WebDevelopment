<section id="team" class="section gray-bg">
		<div class="container">
			<div class="row title text-center">
				<h2 class="margin-top"><?php echo $email_verify_info;?></h2>
				<h4 class="light muted"><a href="<?php echo SITENAME;?>"gamezgeek>Click here to home </a> or it automatically redirects after 5 seconds... </h4>
			</div>
		</div>
	</section>
<script>
	setTimeout(function(){ 
		window.location="<?php echo SITENAME?>home";
	}, 5000);
</script>