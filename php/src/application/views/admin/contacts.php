	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Incoming Messages</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> Inbox</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"></h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<?php if(isset($contacts_array)&&!empty($contacts_array)) { ?>
				<div class="col-md-12">
					<h4><?=$page_str?></h4>
					<div class="table margin20">
						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th width="5%">#</th>
									<th width="10%">Name</th>
									<th width="10%">Email</th>
									<th width="10%">Phone</th>
									<th width="20%">Messages</th>
									<th width="15%">Time</th>
									<th width="15%">IP</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							
							<?php 

							foreach ($contacts_array as $key => $row) {
					            echo '<tr>';
					            echo '<td>'.$row->id.'</td>';
					            echo '<td>'.$row->name.'</td>';
					            echo '<td>'.$row->email.'</td>';
					            echo '<td>'.$row->phone.'</td>';
					            echo '<td>'.$row->message.'</td>';
					            echo '<td>'.$row->time_stamp.'</td>';
					            echo '<td>'.$row->ip.'</td>';
					            echo '<td>
					                    <a href="javascript:delete_data(\'contact\',\''.$row->id.'\');" class="btn btn-danger">Delete</a></td>';
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




