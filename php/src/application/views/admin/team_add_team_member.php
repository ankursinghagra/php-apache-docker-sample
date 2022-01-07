	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Team Members</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
					          	<li><a href="<?=base_url()?>admin/team"><i class="fa fa-list-ul"></i> Team Members</a></li>
					          	<li class="active"><a href="#"><i class="fa fa-list-ul"></i> Add Team Member</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Member Photo</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="<?=base_url()?>admin/dashboard/ajax_img_save">
		                    <div class="form-group">
		                        <p>Please Choose Image: </p>
		                        <input class='file' type="file" class="form-control" name="images" id="images" placeholder="Please choose your image">
		                        <span class="help-block"></span>
		                    </div>
		                    <div class="form-group">
			                    <div id="loader" style="display: none;">
			                        Please wait image uploading to server....
			                    </div>
			                </div>
			                <div class="form-group">
	                    		<input type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
	                    	</div>
	                	</form>
					</div>
					<div class="col-md-12">
	            		<div id="uploaded_images" class="uploaded-images">
			                <div id="error_div">
			                </div>
			                <div id="success_div" class="col-lg-12">
			                    <img id="cropbox" class="img-responsive" src="">
			                    <br><br>
			                    
			                </div>
			            </div>
			        </div>
				</div>

			</div><!--.box-typical-->

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Member Info</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<form action="" method="post"class="form">

							<div class="form-group col-md-12">
								<label>Member Name</label>
								<input type="text" class="form-control" name="member_name">
							</div>
							<div class="form-group col-md-12">
								<label>Member Title</label>
								<input type="text" class="form-control" name="member_title">
							</div>
							<div class="form-group col-md-12">
								<label>Member Short Description</label>
								<textarea class="editor form-control" name="member_description" rows="5"></textarea>
							</div>

							<div class="form-group col-md-12">
								<label>Facebook Link</label>
								<input type="text" class="form-control" name="member_facebook_link">
							</div>
							<div class="form-group col-md-12">
								<label>Twitter Link</label>
								<input type="text" class="form-control" name="member_twitter_link">
							</div>

							<input type="hidden" name="x" id="x" >
	                        <input type="hidden" name="y" id="y" >
	                        <input type="hidden" name="w" id="w" >
	                        <input type="hidden" name="h" id="h" >
	                        <input type="hidden" name="orignal_path" id="orignal_path">
	                        <input type="hidden" name="file_name" id="file_name">
							<div class="form-group col-md-8 col-md-offset-2">
								<input type="submit" class="btn btn-primary" value="Save">
							</div>
						</form>
					</div>
				</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

