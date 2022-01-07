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
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> All Users</a></li>

							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">All Users</h5>

			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-hover">
					<thead>
		              	<tr>
			                <th width="10%">#</th>
			                <th width="20%">Email</th>
			                <th width="20%">Name</th>
			                <th width="10%">Group</th>
			                <th width="20%">Action</th>
		              	</tr>
		             </thead>
		             <tbody>
		          	<?php foreach ($users as $key => $row) {
		            	echo '	
	            		<tr>
	            			<td>'.$row['id'].'</td>
	            			<td>'.$row['email'].'</td>
	            			<td>'.$row['name'].'</td>
	            			<td> <label class="label label-'.$row['group_color'].'">'.$row['group_name'].'</label></td>
	            			<td>';
	            		if($this->session->userdata('admin_group') <= $row['group']) {
	            		echo '<!--<a href="'.base_url().'admin/users/edit_user/'.$row['id'].'" class="btn btn-primary">Edit</a>--><a href="javascript:delete_data(\'admins\','.$row['id'].');" class="btn btn-danger">Delete</a> ' ;
	            		}
	            		echo '
	            			</td>
	            		</tr>';
		          	}?>
		          	</tbody>
		          	</table>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->




