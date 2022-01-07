	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Blog</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li><a href="<?=base_url()?>admin/blog"><i class="fa fa-list-ul"></i> Blog</a></li>
	          					<li><a href="<?=base_url()?>admin/blog/all_blogs"><i class="fa fa-list-ul"></i> All Blogs</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> Edit Blog</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Blog Photo</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<?php if(isset($blog_photo_uploaded)){ ?>
						<img src="<?=base_url()?>uploads/blog/<?=$blog_photo_uploaded?>" style="max-width:200px;" class="img-responsive">
						<br><h3 class="label label-primary">Photo Selected</h3>
						<?php }else{ ?>
						<img src="<?=base_url()?>uploads/blog/<?=$page_data['blog_photo']?>" style="max-width:200px;" class="img-responsive">
						<br><h3 class="label label-primary">Photo Selected</h3>
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
				<h5 class="m-t-lg with-border">Blog Details</h5>

				<div class="row">
					<div class="col-md-12">
						<form action="" method="post" class="form">
							
							<div class="form-group col-md-6">
								<label>Blog Category</label>
								<select class="form-control" name="blog_category_slug">
									<?php foreach ($blog_all_category as $key => $row) { ?>
									<option value="<?=$row['blog_category_slug']?>" <?php if($page_data['blog_category_slug']==$row['blog_category_slug']){echo 'selected';}?>><?=$row['blog_category_title']?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Time Stamp</label>
								<input type="text" class="form-control datepicker" name="date" value="<?=$page_data['date']?>">
							</div>
							<div class="form-group col-md-12">
								<label>Blog Title</label>
								<input type="text" class="form-control maxlength" name="blog_title" value="<?=$page_data['blog_title']?>" maxlength="60">
							</div>
							<div class="form-group col-md-12">
								<label>Blog Slug (Recommended not to change)</label>
								<input type="text" class="form-control maxlength" name="blog_slug" value="<?=$page_data['blog_slug']?>" maxlength="60">
								<input type="hidden" name="blog_slug_initial" value="<?=$page_data['blog_slug']?>" maxlength="60">
							</div>
							
							<div class="col-md-12"><hr></div>

							<div class="col-md-12" style="padding: 15px;margin: 10px auto;background-color:#ececec;border-radius:1px;">
								<label><b>Meta Data</b></label>
								<div class="form-group col-md-12">
									<label>Blog SEO Title</label>
									<input type="text" class="form-control maxlength" name="blog_seo_title" value="<?=$page_data['blog_seo_title']?>" maxlength="60">
								</div>
								<div class="form-group col-md-12">
									<label>Blog SEO Keywords</label>
									<input type="text" class="form-control maxlength" name="blog_seo_keywords" value="<?=$page_data['blog_seo_keywords']?>" maxlength="60">
								</div>
								<div class="form-group col-md-12">
									<label>Blog SEO Description</label>
									<textarea class="form-control maxlength" name="blog_seo_description" maxlength="160"><?=$page_data['blog_seo_description']?></textarea>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="col-md-12"><hr></div>
							<div class="form-group col-md-12">
								<label>Blog Content</label>
								<textarea class="editor" name="blog_content" rows="30"><?=$page_data['blog_content']?></textarea>
							</div>
							<div class="form-group col-md-6">
								<label>Active</label>
								<select class="form-control" name="active">
									<option value="1" <?php if($page_data['active']==1){echo 'selected';}?>>YES</option>
									<option value="0" <?php if($page_data['active']==0){echo 'selected';}?>>NO</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label>Tags</label>
								<textarea class="tag_editor" name="tags"><?=$page_data['tags']?></textarea>
							</div>

							<?php if(isset($blog_photo_uploaded)) { ?>
							<input type="hidden" name="blog_photo_uploaded" value="<?=$blog_photo_uploaded?>">
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


