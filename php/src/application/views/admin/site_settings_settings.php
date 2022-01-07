
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/site_settings"><i class="fa fa-list-ul"></i> Site Settings</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Settings</a></li>


							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Site Settings</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-8 col-md-offset-2">
					<form action="" method="post" accept="utf-8">
						<div class="form-group">
							<label>Theme</label>
							<select class="form-control" name="theme">
								<?php foreach($list_dir as $dir_name) :?>
								<option <?php if($site_data['theme']==$dir_name){echo 'selected';}?> value="<?=$dir_name?>"><?=$dir_name?></option>
								<?php endforeach; ?>
							</select>
						</div>						

						<div class="form-group">
							<label>Indexing</label>
							<select class="form-control" name="indexing">
								<option <?php if($site_data['indexing']=='OFF'){echo 'selected';}?> value="OFF">OFF</option>
								<option <?php if($site_data['indexing']=='ON'){echo 'selected';}?> value="ON">ON</option>
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



