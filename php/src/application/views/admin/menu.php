	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Menu</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	          <li class="active"><a href="#"><i class="fa fa-list-ul"></i> Menu</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Menu</h5>

				<div class="row">
					<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
					<div class="col-md-12">
						<form method="post" action="<?=base_url()?>admin/menu/add_menu">
				            <div class="form-group col-md-6">
				                <label>Label</label>
				                <input class="form-control" name="label">
				            </div>
				            <div class="form-group col-md-6">
				                <label>URL</label>
				                <input class="form-control" name="link">
				            </div>
				            <div class="form-group col-md-6">
				                <label>Parent Id</label>
				                <input class="form-control" name="parent">
				            </div>
				            <div class="form-group col-md-6">
				                <label>Sort Order</label>
				                <input class="form-control" name="sort">
				            </div>
				            <div class="form-group col-md-12">
				                <input class="btn btn-primary" type="submit" value="Save" />
				            </div>
				        </form>
					</div>
				</div>

			</div><!--.box-typical-->
			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Menu</h5>

				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered table-hover">
			              	<tr>
				                <th width="10%">#</th>
				                <th width="20%">Label</th>
				                <th width="20%">URL</th>
				                <th width="10%">Parent Id</th>
				                <th width="10%">Order</th>
				                <th width="20%">Action</th>
			              	</tr>
			          	<?php foreach ($menu_array_linear as $key => $row) {
			            echo '<tr>';
			            echo '<td>'.$row['id'].'</td>';
			            echo '<td>'.$row['label'].'</td>';
			            echo '<td>'.$row['link'].'</td>';
			            echo '<td>'.$row['parent'].'</td>';
			            echo '<td>'.$row['sort'].'</td>';
			            echo '<td><a href="'.base_url().'admin/menu/edit_menu/'.$row['id'].'" class="btn btn-primary">Edit</a><a href="javascript:delete_data(\'menu\','.$row['id'].');" class="btn btn-danger">Delete</a></td>';
			            echo '</tr>';
			          	}?>
			          	</table>
					</div>
				</div>

			</div><!--.box-typical-->
			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">Menu</h5>

				<div class="row">
					<div class="col-md-12 dynamic_menu">
						<?php echo ($menu_array_dynamic)?>
					</div>
				</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->


