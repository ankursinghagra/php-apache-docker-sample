	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li><a href="<?=base_url()?>admin/slider"><i class="fa fa-home"></i> Slider</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> All Sliders</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Slider Photos</h5>
				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<div class="row grid-menu">
							<!-- grid item -->
							<a href="<?=base_url()?>admin/slider/add">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-plus fa-5x"></i></div>
									<div class="caption">Add Photos</div>
								</div>
							</a>

						</div>
					</div>
				</div>
			</div><!--.box-typical-->
			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"></h5>
				<div class="row">
					<div class="col-md-12">
						<h2>All Photos</h2>
						<div class="table margin20">
							<table class="table table-responsive table-hover table-bordered">
								<thead>
									<tr>
										<th width="10%">#</th>
										<th width="30%">Info</th>
										<th width="30%">Photo</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									if(!isset($all_photos)) { 
								?>
									<tr>
										<td colspan="4">Sorry No Photos</td>
									</tr>
								<?php 

									}else{ 
									
									foreach ($all_photos as $key => $row) {
							            echo '<tr>';
							            echo '<td>'.$row->id.'</td>';
							            echo '<td> Title: '.$row->photo_title.' <br> Description: '.$row->photo_description.' </td>';
							            echo '<td><img class="img-responsive" src="'.base_url().'uploads/photos/'.($row->photo_filename).'" style="max-width:300px;"></td>';
							            echo '<td>
							                    <a href="'.base_url().'admin/slider/edit_photo/'.$row->id.'" class="btn btn-primary">Edit Info</a>
							                    <a href="javascript:delete_data(\'slider\',\''.$row->id.'\');" class="btn btn-danger">Delete</a></td>';
							            echo '</tr>';
							          }
								    }
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

