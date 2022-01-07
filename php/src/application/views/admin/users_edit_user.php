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
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Edit User</a></li>

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
					<form method="post" action="">
			            <div class="form-group col-md-6">
			                <label>Email</label>
			                <input class="form-control" name="email" value="<?=$page_data['email']?>">
			            </div>
			            <div class="form-group col-md-6">
			                <label>Name</label>
			                <input class="form-control" name="name" value="<?=$page_data['name']?>">
			            </div>
			            <div class="form-group col-md-6">
			                <label>Password <small>(Leave blank for no change)</small></label>
			                <input class="form-control" name="password">
			            </div>
			            <div class="form-group col-md-6">
			                <label>Group</label>
			                <select class="form-control" name="group" >
			                	<option value="0">SELECT GROUP</option>
			                	<?php
			                	foreach ($groups as $row) {
			                		if($this->session->userdata('admin_group') <= $row['id']){
				                		if ($row['id']==$page_data['group']){
				                			echo '<option value="'.$row['id'].'" selected>'.$row['group_name'].'</option>';
				                		}else{
				                			echo '<option value="'.$row['id'].'">'.$row['group_name'].'</option>';
				                		}
			                		}
			                	}
			                	?>
			                </select>
			            </div>
			            <div class="form-group col-md-12">
			                <input class="btn btn-primary" type="submit" value="Save" />
			            </div>
			        </form>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

