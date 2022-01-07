	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>All Projects</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li><a href="<?=base_url()?>admin/projects/all_projects"><i class="fa fa-home"></i> Projects</a></li>
	          					<li><a href="<?=base_url()?>admin/projects/edit_project/<?=$row_sql['project_slug']?>"><i class="fa fa-home"></i> <?=$row_sql['project_title']?></a></li>
	         					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> All Photos</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Add New Photo</h5>
				<div class="row">
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
				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
							<div class="form-group col-md-6">
								<label>Photo Title</label>
								<input type="text" class="form-control" name="photo_title">
							</div>
							<div class="form-group col-md-6">
								<label>Photo Description</label>
								<input type="text" class="form-control" name="photo_description">
							</div>
							
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
			</div>
			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">All Photos</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>

				<div class="col-md-12">
					<h2></h2>
					<div class="table margin20">
						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th width="30%">Photo Title</th>
									<th width="30%">Project Thumb</th>
									<th >Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if(!isset($all_photos) OR (!count($all_photos)) OR (empty($all_photos))) { 
							?>
								<tr>
									<td colspan="4">Sorry No Entry</td>
								</tr>
							<?php 

								}else{ 
								
								foreach ($all_photos as $key => $row) {
						            echo '<tr>';
						            echo '<td>'.$row->id.'</td>';
						            echo '<td> Title: '.$row->photo_title.' </td>';
						            echo '<td> <img src="'.base_url().'uploads/photos/'.thumb_str($row->photo_filename).'" class="img-responsive"> </td>';
						            echo '<td>
						                    <a href="javascript:delete_data(\'project_photos\',\''.$row->id.'\');" class="btn btn-danger">Delete</a></td>';
						            echo '</tr>';
						          }
							    }
							?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-12">
					<?php if( isset($pagination) && (!empty($pagination))) {echo $pagination;}?>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



