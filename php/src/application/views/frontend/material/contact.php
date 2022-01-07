<div id="contactUsMap" class="big-map" style="height: 300px;"></div>
<div class="main main-raised">
	<div class="contact-content">
		<div class="container">
        	<h2 class="title">Send us a message</h2>
			<div class="row">
				<div class="col-md-6">
					<p class="description">You can contact us with anything related to our Products. We'll get in touch with you as soon as possible.<br><br>
					</p>
					<?php if(isset($message) && ($message=='success')) {
					?>
					<div class="alert alert-success text-center">
						<h2>Thank You for Sending this message. We'll get back to you shortly.</h2>
					</div>
					<?php }else{ ?>

					<?php if(isset($message)){echo $message;}?>
					<form role="form" id="contact-form" method="post">
						<div class="form-group label-floating">
							<label class="control-label">Your name</label>
							<input type="text" class="form-control" name="name" value="<?=set_value('name')?>">
						</div>
						<div class="form-group label-floating">
							<label class="control-label">Email address</label>
							<input type="text" class="form-control" name="email" value="<?=set_value('email')?>">
						</div>
						<div class="form-group label-floating">
							<label class="control-label">Phone</label>
							<input type="text" class="form-control" name="phone" value="<?=set_value('phone')?>">
						</div>
						<div class="form-group label-floating">
							<label class="control-label">Your message</label>
							<input type="text" class="form-control" name="message" value="<?=set_value('message')?>">
						</div>
						<div class="submit text-center">
							<input type="submit" class="btn btn-primary btn-raised btn-round" value="Contact Us" />
						</div>
					</form>
					<?php } ?>
				</div>
            	<div class="col-md-4 col-md-offset-2">
		        	<div class="info info-horizontal">
						<div class="icon icon-primary">
							<i class="material-icons">pin_drop</i>
						</div>
						<div class="description">
							<h4 class="info-title">Find us at the office</h4>
							<address>
							  	<strong><?=$site_options['site_name']?></strong><br>
							  		<?php if(!empty($site_options['address1'])) :?>
							  		<?=$site_options['address1']?><br>
							  		<?php endif;?>
							  		<?php if(!empty($site_options['address2'])) :?>
							  		<?=$site_options['address2']?><br>
							  		<?php endif;?>
							  		<br>
							  		<?php if(!empty($site_options['email1'])) :?>
							  		<a href="mailto:<?=$site_options['email1']?>"><?=$site_options['email1']?></a><br>
							  		<?php endif;?>
							  		<?php if(!empty($site_options['email2'])) :?>
							  		<a href="mailto:<?=$site_options['email2']?>"><?=$site_options['email2']?></a>
							  		<?php endif;?>
							</address>
						</div>
		        	</div>
                    <div class="info info-horizontal">
						<div class="icon icon-primary">
							<i class="material-icons">phone</i>
						</div>
						<div class="description">
							<h4 class="info-title">Give us a ring</h4>
							<p>		<?php if(!empty($site_options['phone1'])) :?>
							  		<abbr title="Phone">P:</abbr> <?=$site_options['phone1']?> <br>
							  		<?php endif;?>
							  		<?php if(!empty($site_options['phone2'])) :?>
							  		<abbr title="Phone">P:</abbr> <?=$site_options['phone2']?> <br>
							  		<?php endif;?>
							</p>
						</div>
		        	</div>
			    </div>
           </div>
        </div>
	</div>
</div>

