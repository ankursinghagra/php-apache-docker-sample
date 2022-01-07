	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Footer</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Footer</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"></h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-12 edit_pane">
					
					<form action="" method="post" id="contentForm">
						<label>Footer Block 1</label>
						<textarea class="form-control editor" id="footer_1" name="footer_1" rows="5"><?=$footer_blocks[0]['content_html']?></textarea>
						<label>Footer Block 2</label>
						<textarea class="form-control editor" id="footer_2" name="footer_2" rows="5"><?=$footer_blocks[1]['content_html']?></textarea>
						<label>Footer Block 3</label>
						<textarea class="form-control editor" id="footer_3" name="footer_3" rows="5"><?=$footer_blocks[2]['content_html']?></textarea>
						<br>
						<br>	
						<br>
						<input type="submit" id="save_button" class="btn btn-primary" value="Save">
					</form>
					<br><br>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



