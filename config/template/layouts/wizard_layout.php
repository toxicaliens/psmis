<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
      // The page title
      $system_name = (isset($_SESSION['sys_name'])) ? $_SESSION['sys_name'] : 'SMIS';
      $templateResource = self::getResource('title');
      $templateResource = ($templateResource=="") ? "$system_name": $templateResource;
    ?>
    <title><?php echo $templateResource; ?></title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="vendors/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet">

    <?php
      // The CSS included
      if ($templateResource = self::getResource('css')) {
        foreach ($templateResource as $style) {
    ?>
      <link rel="stylesheet" href="<?php echo $style; ?>" />
    <?php
        }
      }
    ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php include('menu_profile_quick_info.php'); ?>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <?php getDbMenu(null, $_GET['num'], getAllocatedViews($_SESSION['role_id'])); ?>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php //include('menu_footer.php'); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php include('top_navigation.php'); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="">
            <?php echo $content; ?>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
    <!-- validator -->
    <script src="vendors/validator/validator.min.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- validator -->
    <script src="vendors/validator/validator.min.js"></script>

    <!-- custom js -->
    <script type="text/javascript" src="vendors/bootstrap-fileupload/bootstrap-fileupload.js"></script>

    <!-- jQuery Smart Wizard -->
    <script>
      $(document).ready(function() {
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');
      });
    </script>
    <!-- /jQuery Smart Wizard -->

    <script>
      $(document).ready(function() {
        $('#single_cal1').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_1"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal2').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_2"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal3').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_3"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal4').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select an Option",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->

    <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->

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