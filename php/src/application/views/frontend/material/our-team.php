<div class="page-header header-filter" data-parallax="active" style="background-image: url('<?=base_url()?>assets/front/material/img/bg5.jpg');">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="brand">
					<h1><?=$page_title?>
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class=" main main-raised">
	<div class="container">	
		
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<?=$page_content?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 team_member">
				<?php if(isset($team_members)){ ?>
					<?php foreach ($team_members as $key => $row) { ?>
						<div class="col-sm-6 col-md-3">
							<div class="card card-product">
								<div class="card-image">
									<a href="#pablo">
										<img class="img" src="<?=base_url()?>uploads/admins/<?=$row['member_photo']?>" />
									</a>
								</div>

								<div class="content">
									<h6 class="category text-rose"><?=$row['member_title']?></h6>
									<h4 class="card-title">
										<a href="#pablo"><?=$row['member_name']?></a>
									</h4>
									<div class="card-description">
										<?=$row['member_description']?>
									</div>
									<div class="footer text-center">
										<?php if(!empty($row['member_facebook_link'])){ ?>
		                                	<a href="<?=$row['member_facebook_link']?>" class="btn btn-just-icon btn-simple btn-facebook"><i class="fa fa-facebook"></i></a>
		                                <?php } ?>		                                
										<?php if(!empty($row['member_twitter_link'])){ ?>
		                                	<a href="<?=$row['member_facebook_link']?>" class="btn btn-just-icon btn-simple btn-twitter"><i class="fa fa-twitter"></i></a>
		                                <?php } ?>
		                            </div>
								</div>
							</div>
						</div>
					<?php }?>
						<div class="clearfix"></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>