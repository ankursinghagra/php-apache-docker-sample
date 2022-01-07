
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/seo"><i class="fa fa-list-ul"></i> SEO</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Settings</a></li>


							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Seo Settings</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-8 col-md-offset-2">
					<form action="" method="post" accept="utf-8">
											
						<div class="form-group">
							<label>OpenGraph APP ID</label>
							<input class="form-control" name="seo_og_appid" value="<?=$important_info['seo_og_appid']?>">
						</div>
						<div class="form-group">
							<label>OpenGraph STATUS</label>
							<select class="form-control" name="og_status">
								<option <?php if($important_info['og_status']=='OFF'){echo 'selected';}?> value="OFF">OFF</option>
								<option <?php if($important_info['og_status']=='ON'){echo 'selected';}?> value="ON">ON</option>
							</select>
						</div>
						<div class="form-group">
							<label>TwitterCard STATUS</label>
							<select class="form-control" name="tc_status">
								<option <?php if($important_info['tc_status']=='OFF'){echo 'selected';}?> value="OFF">OFF</option>
								<option <?php if($important_info['tc_status']=='ON'){echo 'selected';}?> value="ON">ON</option>
							</select>
						</div>


						<div class="form-group">
							<input type="submit" value="Update" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



