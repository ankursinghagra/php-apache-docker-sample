	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>SEO</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> SEO</a></li>
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
							<a href="<?=base_url()?>admin/seo/settings">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-cog fa-5x"></i></div>
									<div class="caption">Settings</div>
								</div>
							</a>
							<!-- grid item -->
							<a href="<?=base_url()?>admin/seo/seo_image">
								<div class="col-md-3 grid-menu-item text-center">
									<div class="icon"><i class="fa fa-image fa-5x"></i></div>
									<div class="caption">Default Seo Image</div>
								</div>
							</a>

						</div>
					</div>
				</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

