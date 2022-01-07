	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Blog</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/menu"><i class="fa fa-home"></i> Menu</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Edit Menu</a></li>
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
			                <label>Label</label>
			                <input class="form-control" name="label" value="<?=$page_data['label']?>">
			            </div>
			            <div class="form-group col-md-6">
			                <label>URL</label>
			                <input class="form-control" name="link" value="<?=$page_data['link']?>">
			            </div>
			            <div class="form-group col-md-6">
			                <label>Parent Id</label>
			                <input class="form-control" name="parent" value="<?=$page_data['parent']?>">
			            </div>
			            <div class="form-group col-md-6">
			                <label>Sort Order</label>
			                <input class="form-control" name="sort" value="<?=$page_data['sort']?>">
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


