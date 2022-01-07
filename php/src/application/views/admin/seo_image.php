
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/seo"><i class="fa fa-list-ul"></i> SEO</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Seo Default Image</a></li>


							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"> Seo Default Image</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-4 col-md-offset-3">
					<img src="<?=base_url()?>uploads/pages/<?=$important_info['seo_image']?>" class="img-responsive" style="max-width:400px;">
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
				<div class="col-md-8 col-md-offset-2">
					<form action="" method="post" accept="utf-8">
						<input type="hidden" name="x" id="x" >
                        <input type="hidden" name="y" id="y" >
                        <input type="hidden" name="w" id="w" >
                        <input type="hidden" name="h" id="h" >
                        <input type="hidden" name="orignal_path" id="orignal_path">
                        <input type="hidden" name="file_name" id="file_name">
						<div class="form-group">
							<input type="submit" value="Update" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



