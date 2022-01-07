	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Blog</h3>
							<ol class="breadcrumb breadcrumb-simple">
				<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/pages"><i class="fa fa-list-ul"></i> Pages</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Edit OpenGraph</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Opengraph, Twittercard Photo</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<label>If you want to change default OG information <a href="<?=base_url()?>admin/seo/">Click Here</a></label>
					</div>
					<div class="col-md-12">
						<?php if(isset($photo_uploaded)){ ?>
						<img src="<?=base_url()?>uploads/blog/<?=$photo_uploaded?>" style="max-width:200px;" class="img-responsive">
						<br><h3 class="label label-primary">Photo Selected</h3>
						<?php }else{ ?>
							<?php if(!empty($page_data['og_image'])){ ?>
						<img src="<?=base_url()?>uploads/pages/<?=$page_data['og_image']?>" style="max-width:200px;" class="img-responsive">
						<br><h3 class="label label-primary">Photo Selected</h3>
							<?php }else{ ?>
						<br><h3 class="label label-primary">Using Default Photo</h3>
							<?php } ?>
						<?php } ?>
					</div>
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
				<h5 class="m-t-lg with-border">Opengraph, TwitterCard Details</h5>

				<div class="row">
					<div class="col-md-12">
						<form action="" method="post" class="form">
						<?php if(!empty($page_data['og_image'])){ ?>
							<div class="form-group col-md-12">
								<label>Remove the photo and use the default one?</label>
								<?php if($page_data['og_image']=='') { ?>
								<input type="checkbox" name="remove_photo" checked>
								<?php }else{ ?>
									<?php if(isset($remove_photo)){ ?>
								<input type="checkbox" name="remove_photo" checked>
									<?php }else{ ?>
								<input type="checkbox" name="remove_photo" >
									<?php } ?>
								<?php } ?>
							</div>
							
							<div class="col-md-12"><hr></div>
						<?php } ?>
							<div class="col-md-12" style="padding: 15px;margin: 10px auto;background-color:#ececec;border-radius:1px;">
								<label><b>OpenGraph Data</b></label>
								<div class="form-group col-md-12">
									<label>OG Title</label>
									<input type="text" class="form-control maxlength" name="og_title" value="<?=$page_data['og_title']?>" >
								</div>
								<div class="form-group col-md-12">
									<label>OG Type</label>
									<input type="text" class="form-control maxlength" name="og_type" value="<?=$page_data['og_type']?>" >
								</div>
								<div class="form-group col-md-12">
									<label>OG Description</label>
									<textarea class="form-control maxlength" name="og_description" ><?=$page_data['og_description']?></textarea>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="col-md-12" style="padding: 15px;margin: 10px auto;background-color:#d2f5ff;border-radius:1px;">
								<label><b>TwitterCard Data</b></label>
								<div class="form-group col-md-12">
									<label>TwitterCard Title</label>
									<input type="text" class="form-control maxlength" name="tw_title" value="<?=$page_data['tw_title']?>" >
								</div>
								<div class="form-group col-md-12">
									<label>TwitterCard Card</label>
									<input type="text" class="form-control maxlength" name="tw_card" value="<?=$page_data['tw_card']?>" >
								</div>
								<div class="form-group col-md-12">
									<label>TwitterCard Description</label>
									<textarea class="form-control maxlength" name="tw_description" ><?=$page_data['tw_description']?></textarea>
								</div>
								<div class="clearfix"></div>
							</div>


							<?php if(isset($photo_uploaded)) { ?>
							<input type="hidden" name="photo_uploaded" value="<?=$photo_uploaded?>">
							<?php } ?>

							<input type="hidden" name="x" id="x" >
	                        <input type="hidden" name="y" id="y" >
	                        <input type="hidden" name="w" id="w" >
	                        <input type="hidden" name="h" id="h" >
	                        <input type="hidden" name="orignal_path" id="orignal_path">
	                        <input type="hidden" name="file_name" id="file_name">
							<div class="form-group col-md-12">
								<input type="submit" class="btn btn-primary" value="Save">
							</div>
						</form>
					</div>
				</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->


