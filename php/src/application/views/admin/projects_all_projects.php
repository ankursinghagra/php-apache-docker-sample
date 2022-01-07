	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>All Projects</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li><a href="<?=base_url()?>admin/projects"><i class="fa fa-home"></i> Projects</a></li>
	         					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> All Projects</a></li>
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
					<h2></h2>
					<div class="table margin20">
						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th width="30%">Project Title</th>
									<th width="30%">Project Slug</th>
									<th >Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if(!isset($all_projects) OR (!count($all_projects))) { 
							?>
								<tr>
									<td colspan="4">Sorry No Entry</td>
								</tr>
							<?php 

								}else{ 
								
								foreach ($all_projects as $key => $row) {
						            echo '<tr>';
						            echo '<td>'.$row->id.'</td>';
						            echo '<td> Title: '.$row->project_title.' </td>';
						            echo '<td> '.$row->project_slug.' <a href="'.base_url().'our-work/'.$row->project_slug.'" target="_blank"><i class="fa fa-external-link"></i></a></td>';
						            echo '<td>
						                    <a href="'.base_url().'admin/projects/edit_project/'.$row->project_slug.'" class="btn btn-primary">Edit Project</a>
						                    <a href="'.base_url().'admin/projects/photos/'.$row->id.'" class="btn btn-success">Photos</a>
						                    <a href="javascript:delete_data(\'projects\',\''.$row->id.'\');" class="btn btn-danger">Delete</a></td>';
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



