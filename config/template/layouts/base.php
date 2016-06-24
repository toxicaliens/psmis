<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$system_name = (isset($_SESSION['sys_name'])) ? $_SESSION['sys_name'] : 'SMIS';
		// The page title
		$templateResource = self::getResource('title');
		$templateResource = ($templateResource=="") ? "$system_name": $templateResource;
	?>
	<title><?php echo $templateResource; ?></title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">

    <?php
		// The CSS included
		if ($templateResource = self::getResource('')) {
	?>
	<?php
		foreach ($templateResource as $style) {
	?>
		<link rel="stylesheet" href="<?php echo $style; ?>" />
	<?php
			}
	?>
		<!-- END PAGE LEVEL PLUGINS -->
	<?php
		}
	?>
  </head>

  <body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">
        <?php echo $content; ?>

        <!-- <div id="register" class=" form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>
              <div class="clearfix"></div>
              <div class="separator">

                <p class="change_link">Already a member ?
                  <a href="#tologin" class="to_register"> Log in </a>
                </p>
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                  <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div> -->
      </div>
    </div>

    <?php
		/***
		 * Specify the scripts that are to be added.
		 */
		if ($templateResource = self::getResource('js')) {
			foreach ($templateResource as $js) {
	?>
		<script src="<?php echo $js; ?>"></script>
	<?php
			}
		}
	?>
  </body>
</html>