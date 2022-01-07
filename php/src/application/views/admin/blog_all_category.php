	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Blog</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          					<li><a href="<?=base_url()?>admin/blog"><i class="fa fa-home"></i> Blog</a></li>
	         					<li class="active"><a href="#"><i class="fa fa-list-ul"></i> All Blog Categories</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border"></h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>

				<div class="col-md-12">
					<h2>All Blogs</h2>
					<div class="table margin20">
						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th width="10%">#</th>
									<th width="30%">Title</th>
									<th width="30%">Photo</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if(isset($all_blogs) && (($all_blogs))) { 

									foreach ($all_blogs as $key => $row) {
						            echo '<tr>';
						            echo '<td>'.$row->id.'</td>';
						            echo '<td> Title: '.$row->blog_category_title.' </td>';
						            echo '<td><img class="img-responsive" src="'.base_url().'uploads/blog/'.thumb_str($row->blog_category_image).'"></td>';
						            echo '<td>
						                    <a href="'.base_url().'admin/blog/edit_blog_category/'.$row->id.'" class="btn btn-primary">Edit Blog Category</a>
						                    <a href="javascript:delete_data(\'blog_category\',\''.$row->id.'\');" class="btn btn-danger">Delete</a></td>';
						            echo '</tr>';
						          }
						          }else{ 
							?>
								<tr>
									<td colspan="4">Sorry No Blog Category Entry</td>
								</tr>
							<?php 

							    }
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->



