<?php if ( (isset($page_slug)) && ($page_slug=='404') ) {?>
<?php header("HTTP/1.1 404 Not Found"); ?>    
<?php } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$page_seo_title?></title>
    <meta name="description" content="<?=$page_description?>">
    <meta name="keywords" content="<?=$meta_keywords?>">
    <?php if( (isset($site_options['indexing']) && ($site_options['indexing']=='ON') ) ){?><meta name="robots" content="index,follow"><?php }else{ ?><meta name="robots" content="noindex,nofollow"><?php } ?>
    <?php if(isset($opengraph)) {echo $opengraph;} ?>
    
    <!-- StyleSheets -->
    <link rel="stylesheet" href="<?=base_url()?>assets/front/bootstrap/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="<?=base_url()?>assets/front/bootstrap/css/custom.min.css" media="screen">

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <?php if ( (isset($page_slug)) && ($page_slug=='home') ) {?>

    <!-- OwlCarousel -->
    <link rel="stylesheet" href="<?=base_url()?>assets/third_party/owl/owl.carousel.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/third_party/owl/owl.theme.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/third_party/owl/owl.transitions.css">
    <?php } ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <?php if ( (isset($page_slug)) && (in_array($page_slug, array('photos','videos','projects')) )) {?>
    <link rel="stylesheet" href="<?=base_url()?>assets/third_party/lity-2.2.0/lity.min.css">
    <?php } ?>
  </head>
  <body >  

    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?=base_url()?>" class="navbar-brand"><?php if($site_options['logo_or_text']=='LOGO'){echo '<img id="logo" class="img-responsive" src="'.base_url().'uploads/logo/'.$site_options['logo_file'].'" alt="'.$site_options['site_name'].'">';}else{echo $site_options['site_name'];}?></a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <?=$MENU?>
        </div>
      </div>
    </div>

<!-- YOUR CODE HERE -->