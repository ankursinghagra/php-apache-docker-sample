	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Team Members</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li><a href="<?=base_url()?>admin/team"><i class="fa fa-home"></i> Team Members</a></li>
	         					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> All Team Members</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"></h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>

				<div class="col-md-12">
				<?php if(isset($all_team_member)&&!empty($all_team_member)) {  ?>
					<h2>All Members</h2>
					<h4><?=$page_str?></h4>
					<div class="table margin20">
						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th width="10%">#</th>
									<th width="20%">Title</th>
									<th width="30%">Photo</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								foreach ($all_team_member as $key => $row) {
						            echo '<tr>';
						            echo '<td>'.$row->id.'</td>';
						            echo '<td> Name: '.$row->member_name.' <br>Title: '.$row->member_title.' </td>';
						            echo '<td><img class="img-responsive" src="'.base_url().'uploads/admins/'.($row->member_photo).'"></td>';
						            echo '<td>
						                    <a href="'.base_url().'admin/team/edit_team_member/'.$row->id.'" class="btn btn-primary">Edit Member</a>
						                    <a href="javascript:delete_data(\'team_member\',\''.$row->id.'\');" class="btn btn-danger">Delete</a></td>';
						            echo '</tr>';
						          }
							?>
							</tbody>
						</table>
					</div>
					<?php }else{
				    	echo '<h4>NO MEMBERS YET</h4>';
				    } ?>
				</div>
				
			</div>
			<?php if(isset($pagination)) { ?>
					<div class="row">
						<div class="col-md-12">
							<?=$pagination?>
						</div>
					</div>
					<?php } ?>
			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



