<?php
include_once('src/models/Exams.php');
include_once('src/models/Masterfile.php');
$exams = new Exams;
$master = new Masterfile;

set_title('Manage Grades');
set_layout('dt-layout.php');
?>
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Manage Grades
          	<small>
               	All Subjects  Grades done in the school.
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
                    <h2>All Subjects Grade</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      	<li>
                      		<button id="fc_create" class="btn btn-sm" data-toggle="modal" data-target="#add_subject_grade" title="Add New Grade"><i class="fa fa-plus"></i> Add</button>
                      	</li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<?php 
                  		$exams ->splash('subjects'); 
              		?>

                  	<?php	
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
                      		<li><i>This is simply a module for managing all the subjects  Grades  For a particular school. </i></li>
                      	</ul>
                    </p>
              		<table id="datatable-buttons" class="table jambo_table table-striped table-bordered">
						<thead>
							<tr class="headings">
							  	<th>Grade#</th>
							  	<th>Form</th>
							  	<th>Subject</th>
							  	<th>Min</th>
							  	<th>Max</th>
							  	<th>Score</th>
							  	<th>Action</th>
						  </tr>
						</thead>
 						<tbody>
					 	<?php
					 		$exams ->selectQuery(
					 			'grading', 
					 			'*', 
					 			"school_id = '".$_SESSION['school_id']."'"
					 		);
					 		$rows = $exams ->getRows();
					 		if(count($rows)){
					 			foreach($rows as $row){
					   	?>
						<tr>             
							<td><?php echo $row['grading_id']; ?></td>
						    <td><?php echo $row['form']; ?> </td>
						    <td><?php echo $row['subject_id ']; ?> </td>          
							<td><?php echo $row['min']; ?> </td> 
							<td><?php echo $row['max']; ?> </td>
							<td><?php echo $row['score']; ?> </td>
							<td>
							<li class="dropdown" style="list-style: none;">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Action</a>
		                        <ul class="dropdown-menu" role="menu">
		                          <li><a edit-id="<?php echo $row['grading_id']; ?>" data-toggle="modal" data-target="#edit_subject_grade" class="edit_btn" style="cursor: pointer;"><i class="fa fa-edit"></i> Edit</a></li>
		                          <li><a edit-id="<?php echo $row['grading_id']; ?>" data-toggle="modal" data-target="#delete_subject_grade" class="delete_btn" style="cursor: pointer; color:red;"><i class="fa fa-remove"></i> Delete</a></li>
		                        </ul>
	                        </li>
							</td>     
						</tr>	
						<?php }} ?>
					  </tbody>
					</table>
              	</div>
            </div>
      	</div>
    </div>

<!-- Begin Modals -->
<div id="add_subject_grade" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Subject Grades</h4>
      	</div>
      	<div class="modal-body">
	        <div id="testmodal" style="padding: 5px 20px;">
	          <form id="add_form" action="" method="post" class="form-horizontal" role="form">
	            <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Form</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="form" class="form-control">
							    <?php
									$run = run_query("SELECT * FROM form WHERE school_id = '".$_SESSION['school_id']."'");
									while($row=get_row_data($run)){
										$text=$row['form_name'];
										$view_id=$row['form_id'];
										echo "<option value=\"$view_id\">$text</option>";
									}
								?>
							</select>
						</div>
				</div>
	            <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject:<span class="required">*</span></label>
						<div class="col-sm-9 col-sm-9 col-xs-12">
							<select name="subject_id" class="form-control select2_single" style="width: 100%;">
								<option value="">--Select Subject--</option>
								<?php
									$run = run_query("SELECT * FROM subjects WHERE school_id = '".$_SESSION['school_id']."'");
									while($row=get_row_data($run)){
										$text=$row['subject_name'];
										$view_id=$row['subject_id'];
										echo "<option value=\"$view_id\">$text</option>";
									}
								?>
							</select>
						</div>
					</div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label">Min:</label>
	              <div class="col-sm-9">
	                <input type="number" class="form-control" value="<?php echo $exams->get('min'); ?>" name="min" required/>
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label">Max:</label>
	              <div class="col-sm-9">
	                <input type="number" class="form-control" value="<?php echo $exams->get('max'); ?>" name="max" required/>
	              </div>
	            </div>
	            <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Grade</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="points"  value="<?php echo $exams->get('points'); ?>" class="form-control">
							    <option value="">--Choose Grade--</option>
								<option value="12">A</option>
						        <option value="11">A-</option>
						        <option value="10">B+</option>
						        <option value="9">B</option>
						        <option value="8">B-</option>
						        <option value="7">C +</option>
						        <option value="6">C</option>
						        <option value="5">C-</option>
						        <option value="4">D+</option>
						        <option value="3">D</option>
						        <option value="2">D-</option>
						        <option value="1">E</option>
							</select>
						</div>
				</div>
	            
	            <!-- hidden fields -->
	            <input type="hidden" name="action" value="add_subject_grade"/>
	          </form>
	        </div>
      	</div>
      	<div class="modal-footer">
        <?php 
        	//createSectionButton($_SESSION['role_id'], $_GET['num'], 'Clo564'); 
        	//createSectionButton($_SESSION['role_id'], $_GET['num'], 'Add565'); 
        ?>
      	</div>
    </div>
  </div>
</div>

<div id="edit_subject_grade" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Subject Grades</h4>
      	</div>
      	<div class="modal-body">
	        <div id="testmodal" style="padding: 5px 20px;">
	          <form id="add_form" action="" method="post" class="form-horizontal" role="form">
	            <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Form</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="form" id="form"  class="form-control">
								<?php
									$run = run_query("SELECT * FROM form WHERE school_id = '".$_SESSION['school_id']."'");
									while($row=get_row_data($run)){
										$text=$row['form_name'];
										$view_id=$row['form_id'];
										echo "<option value=\"$view_id\">$text</option>";
									}
								?>
							</select>
						</div>
				</div>
	            <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject:<span class="required">*</span></label>
						<div class="col-sm-9 col-sm-9 col-xs-12">
							<select name="subject_id" id="subject"  class="form-control select2_single">
								<option value="">--Select Subject--</option>
								<?php
									$run = run_query("SELECT * FROM subjects WHERE school_id = '".$_SESSION['school_id']."'");
									while($row=get_row_data($run)){
										$text=$row['subject_name'];
										$view_id=$row['subject_id'];
										echo "<option value=\"$view_id\">$text</option>";
									}
								?>
							</select>
						</div>
					</div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label">Min:</label>
	              <div class="col-sm-9">
	                <input type="number" class="form-control"  id="min" value="<?php echo $exams->get('min'); ?>" name="min" required/>
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label">Max:</label>
	              <div class="col-sm-9">
	                <input type="number" class="form-control" id="max"  value="<?php echo $exams->get('max'); ?>" name="max" required/>
	              </div>
	            </div>
	             <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Grade</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="points" id="grade" value="<?php echo $exams->get('points'); ?>" class="form-control">
							    <option value="">--Choose Grade--</option>
								<option value="12">A</option>
						        <option value="11">A-</option>
						        <option value="10">B+</option>
						        <option value="9">B</option>
						        <option value="8">B-</option>
						        <option value="7">C +</option>
						        <option value="6">C</option>
						        <option value="5">C-</option>
						        <option value="4">D+</option>
						        <option value="3">D</option>
						        <option value="2">D-</option>
						        <option value="1">E</option>
							</select>
						</div>
				</div>
	            
	            <!-- hidden fields -->
	            <input type="hidden" name="action" value="edit_subject_grade"/>
	            <input type="hidden" name="edit_id" id="edit_id" />
	          </form>
	        </div>
      	</div>
      	<div class="modal-footer">
        <?php 
        	//createSectionButton($_SESSION['role_id'], $_GET['num'], 'Clo564'); 
        	//createSectionButton($_SESSION['role_id'], $_GET['num'], 'Add565'); 
        ?>
      	</div>
    </div>
  </div>
</div>

<div id="delete_subject_grade" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Delete Subject Grade</h4>
      	</div>
      	<div class="modal-body">
	       	<p>Are you sure you want to delete seleted subject Grade?</p>
      	</div>
      	<form action="" method="post">
      		<!-- hidden fields -->
      		<input type="hidden" name="action" value="delete_subject_grade"/>
      		<input type="hidden" name="delete_id" id="delete_id">
	      	<div class="modal-footer">
	        <?php 
	        	//createSectionButton($_SESSION['role_id'], $_GET['num'], 'No571'); 
	        	//createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes572'); 
	        ?>
	      	</div>
      	</form>
    </div>
  </div>
</div>
<?php
	set_js(array(
		"src/js/grade.js",
		"vendors/validator/validator.min.js"
	));
?>