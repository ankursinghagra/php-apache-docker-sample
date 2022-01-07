	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3></h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li><a href="<?=base_url()?>admin/projects"><i class="fa fa-home"></i> Projects</a></li>
	          					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> Add Project</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Add Project</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<form method="post" action="">
				            <div class="col-md-6">
					            <div class="form-group">
					                <label>Project Title</label>
					                <?=form_input($form_data['project_title']);?>
					            </div>
					            
					            <div class="form-group">
					                <label>Project SEO Title</label>
					                <?=form_input($form_data['project_seo_title']);?>
					            </div>
					            
					            <div class="form-group">
					                <label>Project Slug</label>
					                <?=form_input($form_data['project_slug']);?>
					            </div>
				            </div>
				            <div class="col-md-6">
					            <div class="form-group">
					                <label>Project Description</label>
					                <?=form_textarea($form_data['project_description'])?>
					            </div>
					            
					            <div class="form-group">
					                <label>Project SEO Description</label>
					                <?=form_textarea($form_data['project_seo_description'])?>
					            </div>
				            </div>

				            <div class="col-md-12">
					            <div class="form-group">
					                <label>Project HTML</label>
					                <?=form_textarea($form_data['project_html'])?>
					            </div>
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



