	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Pages</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> Pages</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Fixed Pages</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12 text-right"><a class="btn btn-primary" href="<?=base_url()?>admin/pages/add_page">Add Page</a></div>
					<div class="col-md-12">
						<h2></h2>
						<div class="table">
							<table class="table table-responsive table-hover table-bordered">
								<thead>
									<tr>
										<th width="5%">#</th>
										<th width="20%">Title</th>
										<th width="20%">slug</th>
										<th width="10%">Active</th>
										<th >Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									if(isset($pages_array_fixed) && ($pages_array_fixed)) { 

										foreach ($pages_array_fixed as $row) {
								            echo '<tr>';
								            echo '<td>'.$row->id.'</td>';
								            echo '<td>'.$row->page_title.'</td>';
								            echo '<td>'.$row->page_slug.'</td>';
								            echo '<td>';
								            if($row->active){echo '<span class="label label-success">ENABLED</span>';}else{echo '<span class="label label-danger">DISABLED</span>';}
								            echo '</td>';
								            echo '<td>
								                    <a href="'.base_url().'admin/pages/edit_page/'.$row->id.'" class="btn btn-primary">Edit Meta</a>
							                    	<a href="'.base_url().'admin/pages/edit_opengraph/'.$row->id.'" class="btn btn-primary">OpenGraph</a>
							                    	<a href="'.base_url().'admin/pages/edit_page_content/'.$row->id.'" class="btn btn-primary">Edit Content</a>
								                  </td>';
								            echo '</tr>';
								        }
								    }else{ 
								?>
									<tr>
										<td colspan="5">Sorry No Pages</td>
									</tr>
								<?php 								
								    }
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div><!--.box-typical-->
			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Non-Fixed Pages</h5>

			<div class="row">
				
				<div class="col-md-12">
					<h2></h2>
					<div class="table margin20">
						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th width="10%">Title</th>
									<th width="15%">slug</th>
									<th width="10%">Active</th>
									<th >Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if(!isset($pages_array_fixed)) { 
							?>
								<tr>
									<td colspan="4">Sorry No Pages</td>
								</tr>
							<?php 

								}else{ 
								
								foreach ($pages_array_nonfixed as $key => $row) {
						            echo '<tr>';
						            echo '<td>'.$row->id.'</td>';
						            echo '<td>'.$row->page_title.'</td>';
						            echo '<td>'.$row->page_slug.'</td>';
						            echo '<td>';
						            if($row->active){echo '<span class="label label-success">ENABLED</span>';}else{echo '<span class="label label-danger">DISABLED</span>';}
						            echo '</td>';
						            echo '<td>
						                    <a href="'.base_url().'admin/pages/edit_page/'.$row->id.'" class="btn btn-primary">Edit Meta</a>
						                    <a href="'.base_url().'admin/pages/edit_opengraph/'.$row->id.'" class="btn btn-primary">OpenGraph</a>
						                    <a href="'.base_url().'admin/pages/edit_page_content/'.$row->id.'" class="btn btn-primary">Edit Content</a>
						                    <a href="javascript:delete_data(\'pages\',\''.$row->id.'\');" class="btn btn-danger">Delete</a></td>';
						            echo '</tr>';
						          }
							    }
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			</div>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

