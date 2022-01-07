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
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Information</a></li>

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
							<label>Site Name</label>
							<input class="form-control" type="text" name="site_name" value="<?=$site_data['site_name']?>" placeholder="Title of your company">
						</div>
						<div class="form-group">
							<label>Site Description</label>
						<textarea class="form-control" id="site_description" name="site_description" rows="5" placeholder="A brief introduction of your company"><?=$site_data['site_description']?></textarea>
						</div>
						<div class="form-group">
							<label>Email (to show)</label>
							<input class="form-control" type="text" name="email1" value="<?=$site_data['email1']?>" placeholder="email@yourdomain.com">
						</div>
						<div class="form-group">
							<label>Email (to show)</label>
							<input class="form-control" type="text" name="email2" value="<?=$site_data['email2']?>" placeholder="email@yourdomain.com">
						</div>

						<div class="form-group">
							<label>Phone Number (to show)</label>
							<input class="form-control" type="text" name="phone1" value="<?=$site_data['phone1']?>" placeholder="+91XXXXXXXXXX">
						</div>
						<div class="form-group">
							<label>Phone Number (to show)</label>
							<input class="form-control" type="text" name="phone2" value="<?=$site_data['phone2']?>" placeholder="+91XXXXXXXXXX">
						</div>
						<div class="form-group">
							<label>Address (to show)</label>
							<input class="form-control" type="text" name="address1" value="<?=$site_data['address1']?>" placeholder="address line 1">
							<input class="form-control" type="text" name="address2" value="<?=$site_data['address2']?>" placeholder="address line 2">
						</div>

						<div class="form-group">
							<label>Facebook Link ( <i class="fa fa-facebook"></i> )</label>
							<input class="form-control" type="text" name="facebook_link" value="<?=$site_data['facebook_link']?>" placeholder="http://facebook.com/yourcompany">
						</div>
						<div class="form-group">
							<label>Google Link ( <i class="fa fa-google-plus"></i> )</label>
							<input class="form-control" type="text" name="google_link" value="<?=$site_data['google_link']?>" placeholder="http://plus.google.com/yourcompany">
						</div>
						<div class="form-group">
							<label>Twitter Link ( <i class="fa fa-twitter"></i> )</label>
							<input class="form-control" type="text" name="twitter_link" value="<?=$site_data['twitter_link']?>" placeholder="http://twitter.com/yourcompany">
						</div>
						<div class="form-group">
							<label>Linkedin Link ( <i class="fa fa-linkedin"></i> )</label>
							<input class="form-control" type="text" name="linkedin_link" value="<?=$site_data['linkedin_link']?>" placeholder="http://linkedin.com/in/yourcompany">
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


