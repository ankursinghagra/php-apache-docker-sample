	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Site Settings</h3>
							<ol class="breadcrumb breadcrumb-simple">

<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/site_settings"><i class="fa fa-list-ul"></i> Site Settings</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Email</a></li>

							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"></h5>

<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-8 col-md-offset-2">
					<form action="" method="post" accept="utf-8">
						
						<div class="form-group">
							<label>Email For Sending emails</label>
							<input class="form-control" type="text" name="email_for_sendmail" value="<?=$site_data['email_for_sendmail']?>"  placeholder="no-reply@yourdomain.com">
						</div>
						<div class="form-group">
							<label>SMTP HOSTNAME</label>
							<input class="form-control" type="text" name="smtp_hostname" value="<?=$site_data['smtp_hostname']?>" placeholder="">
						</div>
						<div class="form-group">
							<label>SMTP Port</label>
							<input class="form-control" type="text" name="smtp_port" value="<?=$site_data['smtp_port']?>" placeholder="">
						</div>
						<div class="form-group">
							<label>SMTP Username</label>
							<input class="form-control" type="text" name="smtp_username" value="<?=$site_data['smtp_username']?>" placeholder="">
						</div>
						<div class="form-group">
							<label>SMTP Password</label>
							<input class="form-control" type="text" name="smtp_password" value="<?=$site_data['smtp_password']?>" placeholder="">
						</div>
						<div class="form-group">
							<input type="submit" value="Update" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->


