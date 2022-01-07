<div class="header-filter">
	<div class="page-header" style="background-image: url('<?=base_url()?>assets/front/material/img/bg5.jpg');">
	</div>
</div>
<div class="page-header-brand container">
	<div class="row">
		<div class="col-md-12">
			<h1>Blog : <?=$page_title?></h1>
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
		<?php if( isset($all_blog_category) && ($all_blog_category) ){ ?>
		<div class="row">
			<div class="col-md-3 text-center">
				<h4 class="side-bar-title">Categories</h4>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="<?=base_url()?>blog">All</a></li>
					<?php foreach ($all_blog_category as $key => $row) { ?>
						<li <?php if($blog_category_slug==$row['blog_category_slug']){echo ' class="active"';} ?>><a href="<?=base_url()?>blog/<?=$row['blog_category_slug']?>" ><?=$row['blog_category_title']?></a></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
		<?php if(isset($all_blogs) && ($all_blogs)) { ?>
			<div class="col-md-9">
				<?php if(isset($page_str)) { ?>
				<h3><?=$page_str?></h3>
				<?php } ?>
				<?php foreach ($all_blogs as $blog) {?>
					<?php 
					foreach ($all_blog_category as $key => $row_cat) {
						if ($row_cat['blog_category_slug'] == $blog['blog_category_slug'] ){
							$blog['blog_category_title'] = $row_cat['blog_category_title'];
						}
					}
					?>
	                <!--Image Box-->
	                <div class="col-lg-6 col-md-6 col-xs-12">
						<div class="card card-raised card-background" style="background-image: url('<?=base_url()?>uploads/blog/<?=$blog['blog_photo']?>')">
							<div class="content">
								<h6 class="label label-primary"><?=$blog['blog_category_title']?></h6>
								<a href="<?=base_url()?>blog/<?=$blog['blog_category_slug']?>/<?=$blog['blog_slug']?>">
									<h3 class="card-title"><?=$blog['blog_title']?></h3>
								</a>
								<p class="card-description">
									<?=strip_tags(substr($blog['blog_content'], 0, 150))?>...
								</p>
								<a href="<?=base_url()?>blog/<?=$blog['blog_category_slug']?>/<?=$blog['blog_slug']?>" class="btn btn-danger btn-round">
									 Read Article
								</a>
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
				<h3>No Posts Yet</h3>
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


