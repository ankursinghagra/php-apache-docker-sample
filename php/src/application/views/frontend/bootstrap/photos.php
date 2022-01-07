<div class="header-filter">
	<div class="page-header" style="background-image: url('<?=base_url()?>assets/front/material/img/bg5.jpg');">
	</div>
</div>
<div class="page-header-brand container">
	<div class="row">
		<div class="col-md-12">
			<h1><?=$page_title?></h1>
			<h2><?=$page_subtitle?></h2>
		</div>
	</div>
</div>
<div class="main main-raised">
	<div class="container">	
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<?=$page_content?>
				</div>
			</div>
		</div>
		<?php if(isset($all_photos) && ($all_photos)) { ?>
		<div class="row">
			<div class="col-md-12">
				<?php if(isset($page_str)) { ?>
				<h3><?=$page_str?></h3>
				<?php } ?>
				<?php foreach ($all_photos as $photo) {?>
	                <!--Image Box-->
	                <div class="col-lg-4 col-md-4 col-xs-12">
	                	<div class="card photo-block">

							<a href="<?=base_url()?>uploads/photos/<?=$photo['photo_filename']?>" data-lity>
								<div class="card-image photo-image">
									<img class="img-responsive img-thumbnail" src="<?=base_url()?>uploads/photos/<?=thumb_str($photo['photo_filename'])?>">
								</div>
							</a>

							<div class="content photo-information">
								<h4><?=$photo['photo_title']?></h4>
								<p><?=$photo['photo_description']?></p>
							</div>
						</div>
	                </div>
	            <?php } ?>
	            <div class="clearfix"></div>
	        </div>
		</div>
		<?php }else{ ?>
		<div class="row">
			<div class="col-md-12">
				<h3>No Photos Yet</h3>
			</div>
		</div>
		<?php } ?>	

		<?php if(isset($pagination)) { ?>
		<div class="row">
			<div class="col-md-12">
				<?=$pagination?>
			</div>
		</div>
		<?php } ?>
		<div style="margin-top: 70px;"></div>
	</div>
</div>


