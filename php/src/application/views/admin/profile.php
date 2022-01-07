	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Edit Profile</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
		          				<li class="active"><a href="#"><i class="fa fa-list-ul"></i> My Profile</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<p>
					You can edit your <code>name</code>, <code>email</code>, <code>password</code>, <code>Profile Photo</code> from this page. And if you are a blogger for this website, Please fill the <code>For Authors Only</code> form below, if not leave it blank.
				</p>

				<h5 class="m-t-lg with-border">Your Profile</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-8">
						<form action="<?=base_url()?>admin/profile/save_profile" method="post" accept="utf-8">
							<div class="form-group">
								<label>Your Name</label>
								<input class="form-control border-input" type="text" name="name" value="<?=$user_data['name']?>">
							</div>
							<div class="form-group">
								<label>Your Email</label>
								<input class="form-control border-input" type="text" name="email" value="<?=$user_data['email']?>">
							</div>
							<div class="form-group">
								<label>Change Password <small>(Leave blank if you don't wish to change)</small></label>
								<input class="form-control border-input" type="text" name="password">
							</div>
							<div class="well" style="padding: 15px;margin: 10px;background-color:#ececec;border-radius:1px;">
								<label><b>For Authors Only (Rest leave it blank)</b></label>
								<div class="form-group">
									<label>Author Name</label>
									<input class="form-control border-input" type="text" name="author_name" value="<?=$user_data['author_name']?>">
								</div>
								<div class="form-group">
									<label>Author Description</label>
									<textarea class="form-control border-input" name="author_short_description" ><?=$user_data['author_short_description']?></textarea>
								</div>
								<div class="form-group">
									<label>Author <span class="label label-primary">Facebook</span> Link</label>
									<input class="form-control border-input" type="text" name="author_facebook_link" value="<?=$user_data['author_facebook_link']?>">
								</div>
								<div class="form-group">
									<label>Author <span class="label label-info">Twitter</span> Link</label>
									<input class="form-control border-input" type="text" name="author_twitter_link" value="<?=$user_data['author_twitter_link']?>">
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Update" class="btn btn-info btn-fill btn-wd">
							</div>
						</form>
					</div>
					<div class="col-md-4">
						<img src="<?=base_url()?>uploads/admins/<?=$user_data['photo']?>" class="img-responsive center-block" style="max-width: 300px"><br><br>
						<a href="<?=base_url()?>admin/profile/change_photo" class="btn btn-primary">CHANGE PHOTO</a>
					</div>
				</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->
