<?php
include_once('src/models/SystemDetails.php');
$system = new SystemDetails;

set_title('System Details');
set_layout('dt-layout.php');
?>
<div class="page-title">
    <div class="title_left">
        <h3>
            System Details
            <small>
                <!-- Manage All System details. -->
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
              <h2>Manage All System details.</h2>
              <ul class="nav navbar-right panel_toolbox">
                  <li>
                    <button id="fc_create" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_setting" title="Add New Setting"><i class="fa fa-plus"></i> Add system details</button>
                  </li>
              </ul>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php
              $system->splash('done-deal');

              if(isset($_SESSION['warnings'])){
                $warnings = $_SESSION['warnings'];
                if(count($warnings)){
            ?>
            <div class="alert alert-warning">
              <button class="close" data-dismiss="alert">&times;</button>
              <?php
               foreach ($warnings as $warning) {
              ?>
              <strong>Warning!</strong> <?php echo $warning; ?><br/>
                <?php
                    }
                  }
                unset($_SESSION['warnings']);
                echo "</div>";
                }
                ?>
                <p class="text-muted font-13 m-b-30">
                    <ul>
                      <li><i>This is simply a module for managing all the system details in the system. </i></li>
                    </ul>
                </p>
              <table id="datatable-buttons" class="table jambo_table table-striped table-bordered bulk_action">
                <thead>
                  <tr class="headings">
                      <th><input type="checkbox" id="check-all" class="flat"></th>
                      <th>Seting#</th>
                      <th>Setting Name</th>
                      <th>Setting Code</th>
                      <th>Setting Value</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $rows = $system->selectQuery(
                      'system_details',
                      '*'
                    );
                    if(count($rows)){
                      foreach($rows as $row){
                    ?>
                  <tr class="pointer">
                    <td class="a-center ">
                      <input type="checkbox" class="flat inputs" value="<?php echo $row['setting_id']; ?>" name="table_records">
                    </td>
                      <td><?php echo $row['setting_id']; ?></td>
                      <td><?php echo $row['setting_name']; ?></td>
                      <td><?php echo $row['setting_code']; ?></td>
                      <td><?php echo $row['setting_value']; ?></td>
                      <td>
                      <li class="dropdown" style="list-style: none;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Action</a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a edit-id="<?php echo $row['setting_id']; ?>" data-toggle="modal" data-target="#edit_setting" class="edit_btn" style="cursor: pointer;"><i class="fa fa-edit"></i> Edit</a></li>
                          <li><a edit-id="<?php echo $row['setting_id']; ?>" data-toggle="modal" data-target="#delete_setting" class="delete_btn" style="cursor: pointer; color:red;"><i class="fa fa-remove"></i> Delete</a></li>
                        </ul>
                      </li>
                      </td>
                    </tr>
                  <?php }} ?>
                </tbody>
              </table>
              <!-- for bulk actions -->
              <div class="x_content">
                <div class="btn-group dropup">
                  <button type="button" class="btn btn-success">Bulk Actions</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#" data-toggle="modal" data-target="#delete_checked">Delete</a></li>
                  </ul>
                </div>
              </div>
              <!-- end bulk actions -->
            </div>
          </div>
      </div>
    </div>

<!-- add system setting Modals -->
<div id="add_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">New Settting Entry</h4>
        </div>
        <div class="modal-body">
          <div id="testmodal" style="padding: 5px 20px;">
            <form id="add_form" action="" method="post" class="form-horizontal" role="form">
              <div class="item form-group">
                <label class="col-sm-3 control-label">Settting Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" value="<?php echo $system->get('setting_name'); ?>" name="setting_name" required/>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-sm-3 control-label">Settting Code</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" value="<?php echo $system->get('setting_code'); ?>" name="setting_code" required/>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-sm-3 control-label">Setting Value</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" value="<?php echo $system->get('setting_value'); ?>" name="setting_value" required/>
                </div>
              </div>
              <!-- hidden fields -->
              <input type="hidden" name="action" value="add_setting"/>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <?php
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'Clo604');
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'Sav606');
          ?>
        </div>
    </div>
  </div>
</div>

<!-- edit system settings -->
<div id="edit_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Update Settings</h4>
        </div>
        <div class="modal-body">
          <div id="testmodal" style="padding: 5px 20px;">
            <form id="edit_form" action="" method="post" class="form-horizontal calender" role="form">
              <div class="item form-group">
                <label class="col-sm-3 control-label">Setting Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="setting_name" name="setting_name" required />
                </div>
              </div>
              <div class="item form-group">
                <label class="col-sm-3 control-label">Setting Code</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="setting_code" name="setting_code" required />
                </div>
              </div>
              <div class="item form-group">
                <label class="col-sm-3 control-label">Setting Value</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="setting_value" name="setting_value" required />
                </div>
              </div>
              <!-- hidden fields -->
              <input type="hidden" name="action" value="edit_setting"/>
              <input type="hidden" name="edit_id" id="edit_id" />
            </form>
          </div>
        </div>
        <div class="modal-footer">
        <?php
          createSectionButton($_SESSION['role_id'], $_GET['num'], 'Can608');
          createSectionButton($_SESSION['role_id'], $_GET['num'], 'Upd610');
        ?>
        </div>
    </div>
  </div>
</div>

<!-- delete system setting modal -->
<div id="delete_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Delete Subject</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete seleted system setting?</p>
        </div>
        <form action="" method="post">
          <!-- hidden fields -->
          <input type="hidden" name="action" value="delete_setting"/>
          <input type="hidden" name="delete_id" id="delete_id">
          <div class="modal-footer">
          <?php
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'No611');
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes612');
          ?>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- delete multiple modal -->
<div id="delete_checked" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Delete System Settings</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete seleted System setting(s)?</p>
        </div>
        <form action="" method="post">
          <!-- hidden fields -->
          <input type="hidden" name="action" value="delete_selected_setting"/>
          <input type="hidden" name="delete_ids" id="delete_ids">
          <div class="modal-footer">
          <?php
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'No611');
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes612');
          ?>
          </div>
        </form>
    </div>
  </div>
</div>
<?php
  set_js(array(
    "src/js/system_details.js",
    "vendors/validator/validator.min.js"
  ));
?>
