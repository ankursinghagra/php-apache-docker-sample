	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">
								 <li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/slider"><i class="fa fa-list-ul"></i> Slider</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Edit Photos</a></li>


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
					<form action="" method="post">
						<div class="form-group col-md-6">
							<label>Photo Title</label>
							<input type="text" class="form-control" name="photo_title" value="<?=$page_data['photo_title']?>">
						</div>
						<div class="form-group col-md-6">
							<label>Photo Description</label>
							<input type="text" class="form-control" name="photo_description" value="<?=$page_data['photo_description']?>">
						</div>
						
						<div class="form-group col-md-12">
							<input type="submit" class="btn btn-primary" value="Save">
						</div>
					</form>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->





