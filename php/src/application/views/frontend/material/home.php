	<?php if(isset($all_slider) && ($all_slider)) { ?>
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<div class="carousel slide" data-ride="carousel">

				<!-- Indicators -->
				<ol class="carousel-indicators">
				<?php foreach ($all_slider as $key => $value) { ?>
					<li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" <?php if($key==0){echo ' class="active"';}?>></li>
				<?php } ?>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
				<?php foreach ($all_slider as $key => $value) { ?>
					<div class="item <?php if($key==0){echo ' active';}?>">
						<div class="page-header header-filter" style="background-image: url('<?=base_url()?>uploads/photos/<?php echo $value['photo_filename']?>');">

							<div class="container">
								<div class="row">
									<div class="col-md-7 col-md-offset-5 text-right">
										<h1 class="title"><?=$value['photo_title']?></h1>
										<h4><?=$value['photo_description']?></h4>
										<br />

										<div class="buttons">
											<a href="<?=base_url()?>about-us" class="btn btn-danger btn-lg">
											 About Us
											</a>
											<a href="<?=base_url()?>contact" class="btn btn-info btn-lg">
											 Contact Us
											</a>
										</div>

									</div>
								</div>
							</div>

				        </div>

					</div>
				<?php } ?>

				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<i class="material-icons">keyboard_arrow_left</i>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<i class="material-icons">keyboard_arrow_right</i>
				</a>
			</div>
		</div>
	<?php } ?>


	<?php 
	// OWLCAROUSEL 
	/*
	if(isset($all_slider) && ($all_slider)) { ?>
	<div class="slider-container">
		  <!-- Wrapper for slides -->
		  <div id="slider" class="owl-carousel owl-theme slider">
		  	<?php foreach ($all_slider as $key => $value) { ?>
		  	<div class="item <?php if($key==0){?>active<?php }?>" style="background-image: url();">
		  	<img src="<?=base_url()?>uploads/photos/<?php echo $value['photo_filename']?>">
		      <div class="item-caption">
		      	<h3><?=$value['photo_title']?></h3>
		      	<p><?=$value['photo_description']?></p>
		      </div>
		    </div>
		  	<?php } ?>
		  </div>
			
	</div>
	<?php } 
	*/
	?>
<div class=" main main-raised">
	<div class="container">	
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<?=$page_content?>
				</div>
			</div>
		</div>
	</div>
</div>