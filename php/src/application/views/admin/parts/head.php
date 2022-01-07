<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <meta name="robots" content="noindex,nofollow">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/lib/lobipanel/lobipanel.min.css">
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/separate/vendor/lobipanel.min.css">
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/lib/jqueryui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/separate/pages/widgets.min.css">
    <!-- Include Font Awesome. -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/main.css">


    <?php if (isset($datepicker) && ($datepicker)) { ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style type="text/css">
        .ui-draggable, .ui-droppable { background-position: top;  }
        #ui-datepicker-div{z-index: 10;}
    </style>
    <?php } ?>
    <?php if (isset($datepicker) && ($datepicker)) { ?>
    <link rel="stylesheet" href="<?=site_url().'assets/admin/'?>css/separate/vendor/tags_editor.min.css">
    <?php } ?>
    <?php if (isset($editor) && ($editor)) { ?>
    <!-- Sirtrevor -->
    <link href="<?=site_url().'assets/third_party/'?>trevor/sir-trevor.css" rel="stylesheet">
	<link href="<?=site_url().'assets/third_party/'?>trevor/sir-trevor-bootstrap.css" rel="stylesheet">
	<link href="<?=site_url().'assets/third_party/'?>trevor/sir-trevor-icons.css" rel="stylesheet">
    <!-- /Sirtrevor -->
    <?php } ?>

    <?php if (isset($summernote_editor) && ($summernote_editor)) { ?>
    <link href="<?=site_url().'assets/third_party/'?>summernote/summernote.css" rel="stylesheet">
    <link href="<?=site_url().'assets/third_party/'?>summernote/summernote-bs3.css" rel="stylesheet">
    <?php } ?>
    <?php if (isset($froala_editor) && ($froala_editor)) { ?>
      <!-- Include Editor style. -->
      <link href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
      <link href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/froala_style.min.css" rel="stylesheet" type="text/css" />

      <!-- Include Code Mirror style -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

      <!-- Include Editor Plugins style. -->
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/char_counter.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/code_view.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/colors.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/emoticons.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/file.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/fullscreen.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/image.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/image_manager.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/line_breaker.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/quick_insert.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/table.css">
      <link rel="stylesheet" href="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/css/plugins/video.css">
    <?php } ?>
    <link href="<?=site_url().'assets/third_party/'?>cropper/cropper.min.css" rel="stylesheet">

    <?php if(isset($jqv_slug) && ($jqv_slug=='add_blog')){ ?>
    <link href="<?=site_url().'assets/third_party/'?>summernote/summernote.css" rel="stylesheet">
    <link href="<?=site_url().'assets/third_party/'?>summernote/summernote-bs3.css" rel="stylesheet">
    <?php } ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="with-side-menu dark-theme">

    <header class="site-header">
        <div class="container-fluid">
            <a href="#" class="site-logo-text">Sapricami CMS</a>
            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
            <div class="site-header-content">
                <div class="site-header-content-in">
                    <div class="site-header-shown">
                        <?php /* ?>
                        <div class="dropdown dropdown-notification notif">
                            <a href="#"
                               class="header-alarm dropdown-toggle active"
                               id="dd-notification"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                <i class="font-icon-alarm"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
                                <div class="dropdown-menu-notif-header">
                                    Notifications
                                    <span class="label label-pill label-danger">4</span>
                                </div>
                                <div class="dropdown-menu-notif-list">
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-1.jpg" alt="">
                                        </div>
                                        <div class="dot"></div>
                                        <a href="#">Morgan</a> was bothering about something
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-2.jpg" alt="">
                                        </div>
                                        <div class="dot"></div>
                                        <a href="#">Lioneli</a> had commented on this <a href="#">Super Important Thing</a>
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-3.jpg" alt="">
                                        </div>
                                        <div class="dot"></div>
                                        <a href="#">Xavier</a> had commented on the <a href="#">Movie title</a>
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-4.jpg" alt="">
                                        </div>
                                        <a href="#">Lionely</a> wants to go to <a href="#">Cinema</a> with you to see <a href="#">This Movie</a>
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                </div>
                                <div class="dropdown-menu-notif-more">
                                    <a href="#">See more</a>
                                </div>
                            </div>
                        </div>
                        <?php */ ?>
    
                        <div class="dropdown user-menu">
                            <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?=site_url()?>uploads/admins/<?=$user_data['photo']?>" alt="">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                                <a class="dropdown-item" href="<?=base_url()?>admin/profile"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?=base_url()?>admin/login/logout"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
                            </div>
                        </div>
                        
                        <?php /* ?>
                        <button type="button" class="burger-right">
                            <i class="font-icon-menu-addl"></i>
                        </button>
                        <?php */ ?>

                    </div><!--.site-header-shown-->
    
                    <div class="mobile-menu-right-overlay"></div>
                    <div class="site-header-collapsed">
                        <div class="site-header-collapsed-in">
                            <div class="dropdown dropdown-typical">
                                <a class="external-link" href="<?=base_url()?>" target="_blank">Site Preview <i class="fa fa-external-link"></i></a>
                            </div>
                            <?php /* ?>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-sales" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-wallet"></span>
                                    <span class="lbl">Sales</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-sales">
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                </div>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-marketing" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-cogwheel"></span>
                                    <span class="lbl">Marketing automation</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-marketing">
                                    <a class="dropdown-item" href="#">Current Search</a>
                                    <a class="dropdown-item" href="#">Search for Issues</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header">Recent issues</div>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                    <div class="dropdown-more">
                                        <div class="dropdown-more-caption padding">more...</div>
                                        <div class="dropdown-more-sub">
                                            <div class="dropdown-more-sub-in">
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Import Issues from CSV</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header">Filters</div>
                                    <a class="dropdown-item" href="#">My Open Issues</a>
                                    <a class="dropdown-item" href="#">Reported by Me</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Manage filters</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header">Timesheet</div>
                                    <a class="dropdown-item" href="#">Subscribtions</a>
                                </div>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-social" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-share"></span>
                                    <span class="lbl">Social media</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-social">
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                </div>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a href="#" class="dropdown-toggle no-arr">
                                    <span class="font-icon font-icon-page"></span>
                                    <span class="lbl">Projects</span>
                                </a>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-form-builder" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-pencil"></span>
                                    <span class="lbl">Form builder</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-form-builder">
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Add
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dd-header-add">
                                    <a class="dropdown-item" href="#">Quant and Verbal</a>
                                    <a class="dropdown-item" href="#">Real Gmat Test</a>
                                    <a class="dropdown-item" href="#">Prep Official App</a>
                                    <a class="dropdown-item" href="#">CATprer Test</a>
                                    <a class="dropdown-item" href="#">Third Party Test</a>
                                </div>
                            </div>
                            <div class="site-header-search-container">
                                <form class="site-header-search closed">
                                    <input type="text" placeholder="Search"/>
                                    <button type="submit">
                                        <span class="font-icon-search"></span>
                                    </button>
                                    <div class="overlay"></div>
                                </form>
                            </div>
                            <?php */ ?>
                        </div><!--.site-header-collapsed-in-->
                    </div><!--.site-header-collapsed-->
                </div><!--site-header-content-in-->
            </div><!--.site-header-content-->
        </div><!--.container-fluid-->
    </header><!--.site-header-->

    <div class="mobile-menu-left-overlay"></div>
    <nav class="side-menu">
        <div class="side-menu-avatar">
            <div class="avatar-preview avatar-preview-100">
                <a href="<?=base_url()?>admin/profile"><img src="<?=site_url()?>uploads/admins/<?=$user_data['photo']?>" alt=""></a>
            </div>
            <div class="avatar-info text-center">
                <h4 class="lbl"><?=$user_data['name']?></h4>
                <p class="small"><?=$user_data['email']?></p>
            </div>
        </div>
        <ul class="side-menu-list">
            <li class="blue">
                <a href="<?=base_url()?>admin/dashboard">
                    <i class="font-icon font-icon-dashboard"></i>
                    <span class="lbl">Dashboard</span>
                </a>
            </li>
            <?php if($current_permissions['edit_site_options']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>site_settings">
                    <i class="font-icon font-icon-cogwheel"></i>
                    <span class="lbl">Site Settings</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['add_users']||$current_permissions['edit_users']||$current_permissions['edit_permissions']) {?>
            <li class="blue">
                <a href="<?=base_url()?>admin/users">
                    <i class="font-icon font-icon-users"></i>
                    <span class="lbl">Users</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_seo']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>seo">
                    <i class="font-icon font-icon-cogwheel"></i>
                    <span class="lbl">SEO</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_pages']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>pages">
                    <i class="glyphicon glyphicon-duplicate"></i>
                    <span class="lbl">Pages</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_menu']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>menu">
                    <i class="font-icon font-icon-burger"></i>
                    <span class="lbl">Menu</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_slider']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>slider">
                    <i class="font-icon font-icon-picture-2"></i>
                    <span class="lbl">Slider</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_blog']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>blog">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <span class="lbl">Blog</span>
                </a>
            </li>
            <?php } ?>

            <?php if($current_permissions['edit_projects']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>projects">
                    <i class="font-icon font-icon-picture-2"></i>
                    <span class="lbl">Projects (our-work)</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_footer']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>footer">
                    <i class="font-icon font-icon-burger"></i>
                    <span class="lbl">Footer</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_photos']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>photos">
                    <i class="font-icon font-icon-picture-2"></i>
                    <span class="lbl">Photos</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_videos']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>videos">
                    <i class="fa fa-youtube"></i>
                    <span class="lbl">Videos</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['edit_team']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>team">
                    <i class="font-icon font-icon-users"></i>
                    <span class="lbl">Team Members</span>
                </a>
            </li>
            <?php } ?>
            <?php if($current_permissions['see_visitors_msgs']) {?>
            <li class="blue">
                <a href="<?=base_url().'admin/'?>contact">
                    <i class="fa fa-envelope"></i>
                    <span class="lbl">Visitor Messages</span>
                </a>
            </li>
            <?php } ?>
            <?php /* ?>
            <li class="purple with-sub">
                <span>
                    <i class="font-icon font-icon-comments active"></i>
                    <span class="lbl">Messages</span>
                </span>
                <ul>
                    <li><a href="#"><span class="lbl">Inbox</span><span class="label label-custom label-pill label-danger">4</span></a></li>
                    <li><a href="#"><span class="lbl">Sent mail</span></a></li>
                    <li><a href="#"><span class="lbl">Bin</span></a></li>
                </ul>
            </li>
            <?php */ ?>
        </ul>
    </nav><!--.side-menu-->





