<?php
  include_once('src/models/Masterfile.php');
  $mf = new Masterfile();

  set_title('Manage Streams');
  set_layout('dt-layout.php');

  require_once 'src/models/Streams.php';
  $stream = new Streams();
?>

<div class="page-title">
	<div class="title_left">
    <h3>
    	Manage Streams
    	<small>
          All the streams in the school.
    	</small>
  	</h3>
	</div>
	<?php include('src/search_box.php'); ?>
</div>

<div class="row">

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
  	<div class="x_title">
      <h2>All Streams</h2>
      <ul class="nav navbar-right panel_toolbox">
      	<li><button data-toggle="modal" data-target="#CalenderModalNew" class="btn btn-primary btn-sm">Add Stream</button></li>
      </ul>
      <div class="clearfix"></div>
    </div>
      <div class="x_content">
        <?php
              $stream->splash('done-deal');

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
                <li><i>The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.</i></li>
              </ul>
          </p>
      		<table id="datatable-buttons" class="table jambo_table table-striped table-bordered bulk_action">
        		<thead>
        			<tr>
                  <th><input type="checkbox" id="check-all" class="flat"></th>
        			  	<th>Stream id</th>
        			  	<th>Stream code</th>
        			  	<th>Stream name</th>
        			  	<th>Stream status</th>
        			  	<th>Action</th>
        		  </tr>
        		</thead>
      			<tbody>
          	 	<?php              	 	
          		 	$rows= $stream->getAllStreams();
          		 		if(count($rows)){
          		 			foreach($rows as $row){
          	  ?>
              <tr>
                  <td class="a-center ">
                    <input type="checkbox" class="flat inputs" value="<?php echo $row['stream_id']; ?>" name="table_records">
                  </td>
                  <td><?php echo $row['stream_id'];?></td>
                  <td><?php echo $row['stream_code'];?></td>
                  <td><?php echo $row['stream_name'];?></td>                  
                  <td><?php echo $row['stream_status'];?></td>
                  <td>
                    <li class="dropdown" style="list-style: none;">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Action</a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a edit-id="<?php echo $row['stream_id']; ?>" data-toggle="modal" data-target="#edit_stream" class="edit_btn" style="cursor: pointer;"><i class="fa fa-edit"></i> Edit</a></li>
                          <li><a edit-id="<?php echo $row['stream_id']; ?>" data-toggle="modal" data-target="#delete_stream" class="delete_btn" style="cursor: pointer;"><i class="fa fa-remove"></i> Delete</a></li>
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
                <li><a href="#" data-toggle="modal" data-target="#delete_checked" id="delete_selected">Delete</a></li>
              </ul>
            </div>
          </div>
          <!-- end bulk actions -->
      </div>
    </div>
  </div>
</div>
  
<!--add modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">New Stream</h4>
      </div>
      <div class="modal-body">
        <div id="testmodal" style="padding: 5px 20px;">
          <form action="" method="post" id="add_form" class="form-horizontal calender" role="form" > 
            <div class="form-group">
              <label class="col-sm-3 control-label">Class</label>
              <div class="col-sm-9">
                <select name="class_id" class="form-control" required style="width:100%">
                  <option value="">--Choose Class--</option>
                <?php
                  $classes = $mf->getAllClasses();
                  if(count($classes)){
                    foreach($classes as $class){
                ?>
                <option value="<?php echo $class['class_id']; ?>"><?php echo $class['class_name']; ?></option>
                <?php }} ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Stream name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="stream_name">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Stream code</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="stream_code">
              </div>
            </div>            
            
            <div class="form-group">
              <label class="col-sm-3 control-label">Status</label>
              <div class="col-sm-9">
                <select name="status" required class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            </div>

            <input type="hidden" name="action" value="add_stream" />
          </form>
        </div>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary antosubmit">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- edit modal -->
<div id="edit_stream" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel2">Edit Stream</h4>
      </div>
      <div class="modal-body">
        <div id="testmodal" style="padding: 5px 20px;">
          <form id="edit_form" action="" method="post" class="form-horizontal calender" role="form">
            <div class="form-group">
              <label class="col-sm-3 control-label">Stream Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="stream_name" name="stream_name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Stream Code</label>
              <div class="col-sm-9">
                <textarea class="form-control" style="height:55px;" id="stream_code" name="stream_code"></textarea>
              </div>              
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Status</label>
              <div class="col-sm-9">
                <select name="status" id="stream_status" required class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            </div>
            <!-- hidden fields -->
            <input type="hidden" name="action" value="edit_stream"/>
            <input type="hidden" name="edit_id" id="edit_id" />
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <?php
          createSectionButton($_SESSION['role_id'], $_GET['num'], 'Can613');
          createSectionButton($_SESSION['role_id'], $_GET['num'], 'Upd614');
        ?>
      </div>
    </div>
  </div>
</div>

<!-- delete modal -->
<div id="delete_stream" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Delete Stream</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete seleted stream?</p>
        </div>
        <form action="" method="post">
          <!-- hidden fields -->
          <input type="hidden" name="action" value="delete_stream"/>
          <input type="hidden" name="delete_id" id="delete_id">
          <div class="modal-footer">
          <?php
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'No615');
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes616');
          ?>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- delete for bulk actions -->
<div id="delete_checked" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Delete Streams</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete seleted streams(s)?</p>
        </div>
        <form action="" method="post">
          <!-- hidden fields -->
          <input type="hidden" name="action" value="delete_selected_stream"/>
          <input type="hidden" name="delete_ids" id="delete_ids">
          <div class="modal-footer">
          <?php
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'No615');
            createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes616');
          ?>
          </div>
        </form>
    </div>
  </div>
</div>

<?php
  set_js(array(
    "src/js/stream_details.js",
    "vendors/validator/validator.min.js"
  ));
?>
