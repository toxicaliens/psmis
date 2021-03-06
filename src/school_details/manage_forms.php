  <?php
include_once('src/models/School.php');
$school = new School;

set_title('Manage class');
set_layout('dt-layout.php');
?>
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Manage classs
          	<small>
               	All classsin the school.
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
                    <h2>All class</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      	<li>
                      		<button id="fc_create" class="btn btn-sm" data-toggle="modal" data-target="#add_class" title="Add New Subject"><i class="fa fa-plus"></i> Add</button>
                      	</li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<?php 
                  		$school->splash('classs'); 
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
                      		<li><i>This is simply a module for managing all the classs that a perticuler school does. </i></li>
                      	</ul>
                    </p>
              		<table id="datatable-buttons" class="table jambo_table table-striped table-bordered">
						<thead>
							<tr class="headings">
							  	<th>class id#</th>
							  	<th>class Name</th>
							  	<th>Action</th>
							  
						  </tr>
						</thead>
 						<tbody>
					 	<?php
				
					 		$rows = $school->getallclasses();
					 		if(count($rows)){
					 			foreach($rows as $row){
					 				
					   	?>
						<tr>             
							<td><?php echo $row['class_id']; ?></td>
						    <td><?php echo $row['class_name']; ?></td>        
							
							<td>
							<li class="dropdown" style="list-style: none;">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Action</a>
		                        <ul class="dropdown-menu" role="menu">
		                          <li><a edit-id="<?php echo $row['class_id']; ?>" data-toggle="modal" data-target="#edit_class" class="edit_btn" style="cursor: pointer;"><i class="fa fa-edit"></i> Edit</a></li>
		                          <li><a edit-id="<?php echo $row['class_id']; ?>" data-toggle="modal" data-target="#delete_class" class="delete_btn" style="cursor: pointer; color:red;"><i class="fa fa-remove"></i> Delete</a></li>
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
<div id="add_class" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Add class</h4>
      	</div>
      	<div class="modal-body">
	        <div id="testmodal" style="padding: 5px 20px;">
	          <form id="add_form" action="" method="post" class="class-horizontal" role="form" novalidate>
	            <div class="item form-group">
	              <label class="col-sm-3 control-label">class Name</label>
	              <div class="col-sm-9">
	                <input type="text" class="form-control" value="<?php echo $school->get('class_name'); ?>" name="class_name" required="required"/>
	              </div>
	            </div>
	            <!-- hidden fields -->
	            <input type="hidden" name="action" value="add_class"/>
	          </form>
	        </div>
      	</div>
      	<div class="modal-footer">
        <?php 
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Clo573'); 
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Sav577'); 
        ?>
      	</div>
    </div>
  </div>
</div>

<div id="edit_class" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Update class</h4>
      	</div>
      	<div class="modal-body">
      		<div id="testmodal" style="padding: 5px 20px;">
		        <form id="edit_form" action="" method="post" class="class-horizontal" role="class" novalidate>
		            <div class="item class-group">
		              <label class="col-sm-3 control-label">class Name</label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" value="<?php echo $school->get('class_name'); ?>" name="class" required="required"/>
		              </div>
		            </div>
		            <!-- hidden fields -->
		            <input type="hidden" name="action" value="update_class"/>
	          	</form>
	        </div>
      	</div>
      	<div class="modal-footer">
        <?php 
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Clo602'); 
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Upd603'); 
        ?>
      	</div>
    </div>
  </div>
</div>

<div id="delete_class" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">classubject</h4>
      	</div>
      	<div class="modal-body">
	       	<p>Are you sure you want to delete seleted subject?</p>
      	</div>
      	<form action="" method="post">
      		<!-- hidden fields -->
      		<input type="hidden" name="action" value="del_class"/>
      		<input type="hidden" name="delete_id" id="del_class" />
	      	<div class="modal-footer">
	        <?php 
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'No605'); 
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes572'); 
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
