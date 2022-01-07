	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Videos</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
      							<li><a href="<?=base_url()?>admin/videos"><i class="fa fa-list-ul"></i> Videos</a></li>
      							<li class="active"><a href="#"><i class="fa fa-list-ul"></i> All Videos</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">All Videos</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<?php if(isset($videos_array)&&!empty($videos_array)) { ?>
				<div class="col-md-12">
					<h4><?=$page_str?></h4>
					<div class="table margin20">
						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th width="25%">Title & Description</th>
									<th width="25%">Snapshot</th>
									<th width="25%">Time</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							
							<?php 

							foreach ($videos_array as $key => $row) {
					            echo '<tr>';
					            echo '<td>'.$row->id.'</td>';
					            echo '<td> <b>'.$row->video_title.'</b> <br>';
					            echo '     '.$row->video_description.' </td>';
					            echo '<td><img src="http://img.youtube.com/vi/'.$row->video_hash.'/0.jpg" class="img-responsive"></td>';
					            echo '<td>'.$row->time_stamp.'</td>';
					            echo '<td>
					                    <a href="'.base_url().'admin/videos/edit_video/'.$row->id.' " class="btn btn-primary">Edit</a>
					                    <a href="javascript:delete_data(\'videos\',\''.$row->id.'\');" class="btn btn-danger">Delete</a>
					                  </td>';
					            echo '</tr>';
					        }
							    
							?>
							</tbody>
						</table>
					</div>
					<?php if(isset($pagination)) { ?>
					<div class="row">
						<div class="col-md-12">
							<?=$pagination?>
						</div>
					</div>
					<?php } ?>
				</div>
				<?php }else{ ?>
				<div class="col-md-12">
					<h2>No Records Yet</h2>
				</div>
				<?php } ?>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

