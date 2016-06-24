<?php
set_title('Manage User Roles');
set_layout("dt-layout.php");
?>
<div class="page-title">
  <div class="title_left">
    <h3>
        Manage User Roles
        <small>
            Access Levels
        </small>
    </h3>
  </div>

    <?php include('src/search_box.php'); ?>
</div>

<div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Add & View User Roles</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#add_user_role" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Add User Role</a>
              </li>
              <li role="presentation" class=""><a href="#all_user_roles" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">All User Roles</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="add_user_role" aria-labelledby="home-tab">
                <?php include "add_role_form.php"; ?>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="all_user_roles" aria-labelledby="profile-tab">
                <?php include "all_roles.php"; ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>              
  </div> 