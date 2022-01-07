	
<!DOCTYPE html>
<html>
<head>
	<title>Admin | Edit Page Content</title>
	<link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/lib/font-awesome/font-awesome.min.css">

	<!-- Sirtrevor -->
    <link href="<?=site_url().'assets/third_party/'?>trevor/sir-trevor.css" rel="stylesheet">
	<link href="<?=site_url().'assets/third_party/'?>trevor/sir-trevor-bootstrap.css" rel="stylesheet">
	<link href="<?=site_url().'assets/third_party/'?>trevor/sir-trevor-icons.css" rel="stylesheet">
    <!-- /Sirtrevor -->

</head>
<body>

<div class="container">

<div class="col-md-12">
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
							<h3></h3>
							<ul class="breadcrumb">
								<li><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a>  >  <a href="<?=base_url()?>admin/pages"><i class="fa fa-list-ul"></i> Pages</a>  >  <i class="fa fa-list-ul"></i> Edit Page Content</li>
							</ul>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">	</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-12 edit_pane">
					<div class="well"><h3>Page Title: <?=$page_data['page_title']?></h3></div>
					<form action="" method="post" id="contentForm">
						<textarea class="form-control" id="page_content" name="page_content" rows="25"><?=$page_data['page_content']?></textarea>
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
</div>
</div>


    <script src="<?=site_url().'assets/admin/'?>js/lib/jquery/jquery.min.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>jQueryvalidate/jquery.validate.min.js"></script>
    <script src="<?=site_url().'assets/admin/'?>js/lib/bootstrap/bootstrap.min.js"></script>
    <!-- Sirtrevor -->
    <script src="<?=site_url().'assets/third_party/'?>trevor/underscore.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/eventable.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/sortable.min.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/sir-trevor.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/sir-trevor-bootstrap.js"></script>
    <script type="text/javascript">
        
        new SirTrevor.Editor({ 
        	el: $('#page_content'),
        	blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Accordion", "Button", "List", "Iframe"]
        });
        SirTrevor.onBeforeSubmit();
    </script>
    <script type="text/javascript">
    function formSubmit(){
        SirTrevor.onBeforeSubmit();
        document.getElementById("contentForm").submit();
    }
    </script>
    <!-- /Sirtrevor -->

</body>
</html>