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
							<div class="card card-member">
								<div class="card-image member-image">
									<img src="<?=base_url()?>uploads/admins/<?=$row['member_photo']?>" class="img-responsive center-block"/>
								</div>

								<div class="card-content member-info">
									<h6 class="member-designation"><?=$row['member_title']?></h6>
									<h4 class="member-name"><?=$row['member_name']?></h4>
									<div class="member-description"><?=$row['member_description']?></div>
									<div class="member-links">
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