<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin</title>
    <meta name="robots" content="noindex,nofollow">
    <!-- Bootstrap -->
    <!-- <link href="<?=site_url().'assets/admin/'?>fonts/roboto/fonts.css" rel="stylesheet"> -->
    <link href="<?=site_url().'assets/admin/'?>css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="<?=site_url().'assets/admin/'?>css/lib/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="<?=site_url().'assets/admin/'?>css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <div class="container">
      <div class="row">
          <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="margin-top: 30px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <h4><a href="<?=base_url()?>admin/login" data-toggle="tooltip" data-placement="bottom" title="Back To Login"><i class="fa fa-arrow-left"></i></a> &nbsp;&nbsp;&nbsp;Set Your Password</h4>
                        </div>
                        <div class="panel-body">
                            <p></p>
                            <?php if( isset($message) && ($message=='success')){echo '<div class="alert alert-success">THANKYOU</div>';}else{ ?>
                              <?php if (isset($message)) { echo $message;}?>
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>Enter your new password</label>
                                    <input type="password" name="password1" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Repeat your new password</label>
                                    <input type="password" name="password2" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block btn-primary" value="Change Password">
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="text-right"><h6>Powered By <a href="http://sapricami.com/" target="_blank">Sapricami</a></h6></div>
                </div>
            </div>
          </div>
      </div>
  </div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=site_url().'assets/third_party/'?>jQuery/jQuery-2.2.0.min.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>jQueryvalidate/jquery.validate.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=site_url().'assets/admin/'?>js/lib/bootstrap/bootstrap.min.js"></script>

  </body>
</html>