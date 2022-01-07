	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> Users</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Users</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<div class="row grid-menu">
							<?php if($current_permissions['add_users']) {?>
							<!-- grid item -->
							<a href="<?=base_url()?>admin/users/add_user">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-plus fa-5x"></i></div>
									<div class="caption">Add User</div>
								</div>
							</a>
							<?php } ?>
							<?php if($current_permissions['edit_users']) {?>
							<!-- grid item -->
							<a href="<?=base_url()?>admin/users/all_users">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-users fa-5x"></i></div>
									<div class="caption">All Users</div>
								</div>
							</a>
							<?php } ?>
							<!-- grid item -->
							<?php if($current_permissions['edit_permissions']) {?>
							<a href="<?=base_url()?>admin/users/permissions">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-check fa-5x"></i></div>
									<div class="caption">Permissions</div>
								</div>
							</a>
							<?php } ?>

						</div>
					</div>
				</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



