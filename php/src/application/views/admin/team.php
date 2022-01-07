	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Team Members</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> Team Members</a></li>
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
						<div class="row grid-menu">
							<!-- grid item -->
							<a href="<?=base_url()?>admin/team/add_team_member">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-plus fa-5x"></i></div>
									<div class="caption">Add Team Member</div>
								</div>
							</a>
							<!-- grid item -->
							<a href="<?=base_url()?>admin/team/all_team_member">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-edit fa-5x"></i></div>
									<div class="caption">All Team Member</div>
								</div>
							</a>

						</div>
					</div>
				</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

