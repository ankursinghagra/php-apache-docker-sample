	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Pages</h3>
							<ol class="breadcrumb breadcrumb-simple">
				<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/pages"><i class="fa fa-list-ul"></i> Pages</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Edit Page</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Pages</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-12">
					<form action="" method="post" class="form">
						<div class="col-md-12">
							<div class="form-group"><h6><b>Information</b></h6></div>
							<div class="form-group col-md-6">
								<label>Page Title</label>
								<input type="text" class="form-control" name="page_title" value="<?=$page_data['page_title']?>">
							</div>
							<div class="form-group col-md-6">
								<label>Page Subtitle</label>
								<input type="text" class="form-control" name="page_subtitle" value="<?=$page_data['page_subtitle']?>">
							</div>
							<?php if($page_data['fixed']=='0') { ?>
							<div class="form-group col-md-6">
								<label>Page Slug</label>
								<input type="text" class="form-control" name="page_slug" value="<?=$page_data['page_slug']?>">
								<input type="hidden" name="page_slug_initial" value="<?=$page_data['page_slug']?>">
							</div>
							<?php } ?>
						</div>
						<div class="col-md-12" style="padding: 15px;margin: 10px auto;background-color:#ececec;border-radius:1px;">
							<div class="form-group"><h6><b>Meta</b></h6></div>
							<div class="form-group col-md-6">
								<label>Page SEO Title</label>
								<textarea class="form-control" name="meta_title" rows="4"><?=$page_data['meta_title']?></textarea>
							</div>
							<div class="form-group col-md-6">
								<label>Page SEO Keywords</label>
								<textarea class="form-control" name="meta_keywords" rows="4"><?=$page_data['meta_keywords']?></textarea>
							</div>
							<div class="form-group col-md-6">
								<label>Page SEO Description</label>
								<textarea class="form-control" name="meta_description" rows="4"><?=$page_data['meta_description']?></textarea>
							</div>
						</div>
							<div class="form-group col-md-6">
								<label>Active</label>
								<select class="form-control" name="active">
									<option value="1" <?php if($page_data['active']=='1'){echo "selected";}?>>YES</option>
									<option value="0" <?php if($page_data['active']=='0'){echo "selected";}?>>NO</option>
								</select>
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



