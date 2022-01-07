	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Videos</h3>
							<ol class="breadcrumb breadcrumb-simple">

<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li><a href="<?=base_url()?>admin/videos"><i class="fa fa-list-ul"></i> Videos</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Add Video</a></li>

							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Add Videos</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-8">
					<div class="col-md-8 col-md-offset-2">
						<form method="post" id="videos_form" class="form">
							<div class="form-group">
								<label>Video Link</label>
								<input type="text" name="video_link" id="video_link" class="form-control" value="<?=$page_data['video_link']?>">
							</div>
							<div class="form-group">
								<label>Video Hash</label>
								<input type="text" name="video_hash" id="video_hash" class="form-control" value="<?=$page_data['video_hash']?>">
							</div>
							<div class="form-group">
								<label>Video Title</label>
								<input type="text" name="video_title" id="video_title" class="form-control" value="<?=$page_data['video_title']?>">
							</div>
							<div class="form-group">
								<label>Video Description</label>
								<textarea name="video_description" id="video_description" class="form-control" rows="5"><?=$page_data['video_description']?></textarea>
							</div>
							<div class="form-group">
								<input type="submit" value="SAVE" class="btn btn-primary disabled" id="form_submit">
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-4">
					<div class="">
						<img src="<?=base_url()?>assets/admin/img/300x200.png" class="img-responsive" id="img_preview" style="max-width: 300px;">
					</div>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



