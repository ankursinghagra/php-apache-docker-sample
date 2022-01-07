<div class="header-filter">
	<div class="page-header" style="background-image: url('<?=base_url()?>assets/front/material/img/bg5.jpg');">
	</div>
</div>
<div class="page-header-brand container">
	<div class="row">
		<div class="col-md-12">
			<h1><?=$page_title?></h1>
			<h2>Portfolio</h2>
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
		<?php if(isset($all_project_images) && ($all_project_images)) { ?>
		<div class="row">
			<div class="col-md-12">
				<?php foreach ($all_project_images as $photo) {?>
	                <!--Image Box-->
	                <div class="col-lg-4 col-md-4 col-xs-12">
	                	<div class="card card-plain card-blog">

							<a href="<?=base_url()?>uploads/photos/<?=$photo['photo_filename']?>" data-lity>
								<div class="card-image">
									<img class="img img-raised" src="<?=base_url()?>uploads/photos/<?=thumb_str($photo['photo_filename'])?>">
								<div class="ripple-container"></div>
								</div>
							</a>
						</div>
	                </div>
	            <?php } ?>
	            <div class="clearfix"></div>
	        </div>
		</div>
		<?php } ?>

		<div style="margin-top: 70px;"></div>
	</div>
</div>


