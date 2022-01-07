
	<?php 
	// OWLCAROUSEL 
	
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