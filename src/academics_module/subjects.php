<?php
include_once('src/models/Academics.php');
$subjects = new Academics;

set_title('Manage Subjects');
set_layout('dt-layout.php');
?>
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Manage Subjects
          	<small>
               	All Subjects done in the school.
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
                    <h2>All Subjects</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      	<li>
                      		<button id="fc_create" class="btn btn-sm" data-toggle="modal" data-target="#add_subject" title="Add New Subject"><i class="fa fa-plus"></i> Add</button>
                      	</li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<?php
                  		$subjects->splash('subjects');

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
                      		<li><i>This is simply a module for managing all the subjects that a particular school does. </i></li>
                      		<li><i>Only Active(<i class="fa fa-check" style="color: green;"></i>) subjects will be accessible in the system.</i></li>
                      	</ul>
                    </p>
              		<table id="datatable-buttons" class="table jambo_table table-striped table-bordered bulk_action">
						<thead>
							<tr class="headings">
                  <th>
                    <input type="checkbox" id="check-all" class="flat">
                  </th>
							  	<th>Subject#</th>
							  	<th>Name</th>
							  	<th>Code</th>
							  	<th>Status</th>
							  	<th>Action</th>
						  </tr>
						</thead>
 						<tbody>
					 	<?php
					 		$rows = $subjects->selectQuery(
					 			'subjects',
					 			'*',
					 			"school_id = '".$_SESSION['school_id']."'"
					 		);
					 		if(count($rows)){
					 			foreach($rows as $row){
					   	?>
		        <tr class="pointer">
              <td class="a-center ">
                <input type="checkbox" class="flat inputs" value="<?php echo $row['subject_id']; ?>" name="table_records">
              </td>
							<td><?php echo $row['subject_id']; ?></td>
						    <td><?php echo $row['subject_name']; ?></td>
						    <td><?php echo $row['subject_code']; ?></td>
							<td>
							<?php
								$status = $subjects->getStatus($row['subject_status']);
								if($status == 'Active'){
							?>
							<i class="fa fa-check" style="color: green;"></i>
							<?php }else{ ?>
							<i class="fa fa-close" style="color: red;"></i>
							<?php } ?>
							</td>
							<td>
							<li class="dropdown" style="list-style: none;">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Action</a>
                <ul class="dropdown-menu" role="menu">
                  <li><a edit-id="<?php echo $row['subject_id']; ?>" data-toggle="modal" data-target="#edit_subject" class="edit_btn" style="cursor: pointer;"><i class="fa fa-edit"></i> Edit</a></li>
                  <li><a edit-id="<?php echo $row['subject_id']; ?>" data-toggle="modal" data-target="#delete_subject" class="delete_btn" style="cursor: pointer; color:red;"><i class="fa fa-remove"></i> Delete</a></li>
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
                <li><a href="#" data-toggle="modal" id="delete_selected" data-target="#delete_checked">Delete</a></li>
              </ul>
            </div>
          </div>
          <!-- end bulk actions -->
              	</div>
            </div>
      	</div>
    </div>

<!-- Begin Modals -->
<div id="add_subject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">New Subject Entry</h4>
      	</div>
      	<div class="modal-body">
	        <div id="testmodal" style="padding: 5px 20px;">
	          <form id="add_form" action="" method="post" class="form-horizontal" role="form">
	            <div class="item form-group">
	              <label class="col-sm-3 control-label">Subject Name</label>
	              <div class="col-sm-9">
	                <input type="text" class="form-control" value="<?php echo $subjects->get('subject_name'); ?>" name="subject_name" required/>
	              </div>
	            </div>
	            <div class="item form-group">
	              <label class="col-sm-3 control-label">Subject Code</label>
	              <div class="col-sm-9">
	                <input type="text" class="form-control" value="<?php echo $subjects->get('subject_code'); ?>" name="subject_code" required/>
	              </div>
	            </div>
	            <div class="item form-group">
	              <label class="col-sm-3 control-label">Status</label>
	              <div class="col-sm-9">
	                <select name="status" required class="form-control">
	                	<option value="1" <?php if(isset($_POST['status'])) echo ($subjects->get('status') == 1) ? 'selected': 'selected'; ?>>Active</option>
	                	<option value="0" <?php if(isset($_POST['status'])) echo ($subjects->get('status') == 0) ? 'selected': ''; ?>>Inactive</option>
	                </select>
	              </div>
	            </div>
	            <!-- hidden fields -->
	            <input type="hidden" name="action" value="add_subject"/>
	          </form>
	        </div>
      	</div>
      	<div class="modal-footer">
        <?php
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Clo595');
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Sav593');
        ?>
      	</div>
    </div>
  </div>
</div>

<div id="edit_subject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Update Subject</h4>
      	</div>
      	<div class="modal-body">
	        <div id="testmodal" style="padding: 5px 20px;">
	          <form id="edit_form" action="" method="post" class="form-horizontal calender" role="form">
	            <div class="form-group">
	              <label class="col-sm-3 control-label">Subject Name</label>
	              <div class="col-sm-9">
	                <input type="text" class="form-control" id="subject_name" name="subject_name" required />
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label">Subject Code</label>
	              <div class="col-sm-9">
	                <input type="text" class="form-control" id="subject_code" name="subject_code" required />
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label">Status</label>
	              <div class="col-sm-9">
	                <select name="status" id="subject_status" required class="form-control">
	                	<option value="1">Active</option>
	                	<option value="0">Inactive</option>
	                </select>
	              </div>
	            </div>
	            <!-- hidden fields -->
	            <input type="hidden" name="action" value="edit_subject"/>
	            <input type="hidden" name="edit_id" id="edit_id" />
	          </form>
	        </div>
      	</div>
      	<div class="modal-footer">
        <?php
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Can591');
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Upd592');
        ?>
      	</div>
    </div>
  </div>
</div>

<div id="delete_subject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Delete Subject</h4>
      	</div>
      	<div class="modal-body">
	       	<p>Are you sure you want to delete seleted subject?</p>
      	</div>
      	<form action="" method="post">
      		<!-- hidden fields -->
      		<input type="hidden" name="action" value="delete_subject"/>
      		<input type="hidden" name="delete_id" id="delete_id">
	      	<div class="modal-footer">
	        <?php
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'No590');
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes589');
	        ?>
	      	</div>
      	</form>
    </div>
  </div>
</div>

<div id="delete_checked" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Delete Subject</h4>
      	</div>
      	<div class="modal-body">
	       	<p>Are you sure you want to delete seleted subject(s)?</p>
      	</div>
      	<form action="" method="post">
      		<!-- hidden fields -->
      		<input type="hidden" name="action" value="delete_selected_subjects"/>
      		<input type="hidden" name="delete_ids" id="delete_ids">
	      	<div class="modal-footer">
	        <?php
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'No590');
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes589');
	        ?>
	      	</div>
      	</form>
    </div>
  </div>
</div>
<?php
	set_js(array(
		"src/js/subjects.js",
		"vendors/validator/validator.min.js"
	));
?>
