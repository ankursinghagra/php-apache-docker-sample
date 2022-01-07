<div class="header-filter">
	<div class="page-header" style="background-image: url('<?=base_url()?>uploads/blog/<?=$blog['blog_photo']?>');">
	</div>
</div>
<div class="page-header-brand container">
	<div class="row">
		<div class="col-md-12">
			<h1><?=$blog['blog_title']?></h1>
		</div>
	</div>
</div>
<div class="main main-raised">
	<div class="container">	
		<div class="section section-text">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="content">
						<p><?=$blog['blog_content']?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="section section-blog-info">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">

					<!-- <div class="row">
						<div class="col-md-6">
							<div class="blog-tags">
								Tags:
								<span class="label label-primary">Photography</span>
								<span class="label label-primary">Stories</span>
								<span class="label label-primary">Castle</span>
							</div>
						</div>
						<div class="col-md-6">
							<a href="#pablo" class="btn btn-google btn-round pull-right">
								<i class="fa fa-google"></i> 232
							</a>
							<a href="#pablo" class="btn btn-twitter btn-round pull-right">
								<i class="fa fa-twitter"></i> 910
							</a>
							<a href="#pablo" class="btn btn-facebook btn-round pull-right">
								<i class="fa fa-facebook-square"></i> 872
							</a>

						</div>
					</div> -->

					<hr />

					<?php if( isset($blog_author) &&($blog_author) ){ ?>

					<div class="card card-profile card-plain">
						<div class="row">
							<div class="col-md-2">
								<div class="card-avatar">
									<img class="img-responsive img-circle" src="<?=base_url()?>uploads/admins/<?=$blog_author['photo']?>">
								</div>
							</div>
							<div class="col-md-8 text-left">
								<h4 class="card-title"><?=$blog_author['author_name']?></h4>
								<p class="description"><?=$blog_author['author_short_description']?></p>
								<p><?php if($blog_author['author_facebook_link']){ ?>
									<a href="<?=$blog_author['author_facebook_link']?>" class="btn btn-just-icon btn-simple"><i class="fa fa-facebook-square"></i></a>
									<?php } ?>
									<?php if($blog_author['author_twitter_link']){ ?>
									<a href="<?=$blog_author['author_twitter_link']?>" class="btn btn-just-icon btn-simple"><i class="fa fa-twitter"></i></a>
									<?php } ?></p>
							</div>
							<!-- <div class="col-md-2">
								<button type="button" class="btn btn-default pull-right btn-round">Follow</button>
							</div> -->
						</div>
					</div>

					<?php } ?>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h4 class="title">Recent Articles</h4>
					<?php 
					if(isset($recent_blogs) && ($recent_blogs)){
					foreach ($recent_blogs as $key => $blog) { ?>
					<?php 
						foreach ($all_blog_category as $key => $row_cat) {
							if ($row_cat['blog_category_slug'] == $blog['blog_category_slug'] ){
								$blog['blog_category_title'] = $row_cat['blog_category_title'];
							}
						}
						?>
		                <!--Image Box-->
		                <div class="col-md-6">
							<div class="card card-raised tiny-blog">
								<div class="col-md-4">
									<img src="<?=base_url()?>uploads/blog/<?=thumb_str($blog['blog_photo'])?>" class="img-responsive">
								</div>
								<div class="col-md-8">
									<h6 class="category text-info"><?=$blog['blog_category_title']?></h6>
									<a href="<?=base_url()?>blog/<?=$blog['blog_category_slug']?>/<?=$blog['blog_slug']?>">
										<h6 class="card-title"><?=$blog['blog_title']?></h6>
									</a>
								</div>
							</div>

		                </div>
					<?php }}?>
					<div class="clearfix"></div>
				</div>
			</div>
	</div>
</div>

