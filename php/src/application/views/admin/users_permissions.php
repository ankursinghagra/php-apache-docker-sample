	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">

								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/users"><i class="fa fa-home"></i> Users</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Permissions</a></li>

							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"></h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				
						<?php 
						foreach ($groups as $key => $row) {
							if( ($key) AND ($this->session->userdata('admin_group') < $row['id']) ){
						?>
						<div class="col-md-6">
						<form method="post" action="">
							<div class="form-group col-md-12">
			                <label>Permissions for <?=$row['group_name']?></label>
				                <div class="col-md-12">
				                	<input type="hidden" name="id" value="<?=$row['id']?>">

					                <input type="checkbox" name="edit_site_options" value="1" <?php if($row['edit_site_options']){echo'checked';}?>> <span> Edit Site Options</span><br>

					                <input type="checkbox" name="edit_users" value="1" <?php if($row['edit_users']){echo'checked';}?>> <span> Add Users</span><br>

					                <input type="checkbox" name="add_users" value="1" <?php if($row['add_users']){echo'checked';}?>> <span> Edit Users</span><br>
					                
					                <input type="checkbox" name="edit_permissions" value="1" <?php if($row['edit_permissions']){echo'checked';}?>> <span> Edit Permissions</span><br>

					                <input type="checkbox" name="edit_seo" value="1" <?php if($row['edit_seo']){echo'checked';}?>> <span> Edit SEO</span><br>

					                <input type="checkbox" name="edit_pages" value="1" <?php if($row['edit_pages']){echo'checked';}?>> <span> Edit Pages</span><br>

					                <input type="checkbox" name="edit_menu" value="1" <?php if($row['edit_menu']){echo'checked';}?>> <span> Edit Menu</span><br>

					                <input type="checkbox" name="edit_slider" value="1" <?php if($row['edit_slider']){echo'checked';}?>> <span> Edit Slider</span><br>

					                <input type="checkbox" name="edit_blog" value="1" <?php if($row['edit_blog']){echo'checked';}?>> <span> Edit Blog</span><br>

					                <!-- <input type="checkbox" name="edit_assets" value="1" <?php if($row['edit_assets']){echo'checked';}?>> <span> Edit Assets</span><br> -->

					                <input type="checkbox" name="edit_projects" value="1" <?php if($row['edit_projects']){echo'checked';}?>> <span> Edit Projects (OurWork)</span><br>
					                <input type="checkbox" name="edit_footer" value="1" <?php if($row['edit_footer']){echo'checked';}?>> <span> Edit Footer</span><br>
					                <input type="checkbox" name="edit_photos" value="1" <?php if($row['edit_photos']){echo'checked';}?>> <span> Edit Photos</span><br>
					                <input type="checkbox" name="edit_videos" value="1" <?php if($row['edit_videos']){echo'checked';}?>> <span> Edit Videos</span><br>
					                <input type="checkbox" name="edit_team" value="1" <?php if($row['edit_team']){echo'checked';}?>> <span> Edit Team</span><br>
					                <input type="checkbox" name="see_visitors_msgs" value="1" <?php if($row['see_visitors_msgs']){echo'checked';}?>> <span> See Visitor Messages</span><br>


				                </div>
			            	</div>
				            <div class="form-group col-md-12">
				                <input class="btn btn-primary" type="submit" value="Save" />
				            </div>
			        	</form>
			        	</div>
						<?php
							}
						}
						?>
			            
				
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->


