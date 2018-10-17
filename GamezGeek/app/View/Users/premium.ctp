<section id="pricing" class="section gray-bg">
		<div class="container">
			<div class="row title text-center">
				<h2 class="margin-top">Pricing</h2>
				<h4 class=" muted">as low as</h4>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="team text-center">
						<div class="cover" style="background:url('<?php echo SITENAME; ?>img/pricing.png'); background-size:cover;">
							<div class="overlay text-center">
								
								<h5 class="light light-white">A complete games for one month</h5>
							</div>
						</div>
						
						<div class="title">
							<h4>$1.99</h4>
							<h5 class="muted regular">1 Month subscrition</h5>
						</div>
						<?php if($this->Session->read("username") != "") { ?>
							<a href="#" class="btn btn-blue-fill ripple">Buy Now</a>
						<?php } else {?>
							<a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple">Signup Now</a>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="team text-center">
						<div class="cover" style="background:url('<?php echo SITENAME; ?>img/pricing.png'); background-size:cover;">
							<div class="overlay text-center">
								
								<h5 class="light light-white">A complete games for three months</h5>
							</div>
						</div>
						
						<div class="title">
							<h4>$3.99</h4>
							<h5 class="muted regular">3 Months subscrition</h5>
						</div>
						<?php if($this->Session->read("username") != "") { ?>
							<a href="#" class="btn btn-blue-fill ripple">Buy Now</a>
						<?php } else {?>
							<a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple">Signup Now</a>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="team text-center">
						<div class="cover" style="background:url('<?php echo SITENAME; ?>img/pricing.png'); background-size:cover;">
							<div class="overlay text-center">
							
								<h5 class="light light-white">A complete games for one year</h5>
							</div>
						</div>
						
						<div class="title">
							<h4>$9.99</h4>
							<h5 class="muted regular">1 Year subscrition</h5>
						</div>
						<?php if($this->Session->read("username") != "") { ?>
							<a href="#" class="btn btn-blue-fill ripple">Buy Now</a>
						<?php } else {?>
							<a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple">Signup Now</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>