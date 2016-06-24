<?php
	include_once('src/models/Masterfile.php');
	$mf = new Masterfile();
	
	set_title('Masterfile');
	set_layout('dt-layout.php');
?>

<div class="page-title">
  	<div class="title_left"><h3>Masterfile	<small></small>	</h3></div>
  	<?php include('src/search_box.php'); ?>
</div>
<div class="clearfix"></div>

    <div class="row">
      	<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              	<div class="x_title">
                    <h2>All Masterfiles</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<p class="text-muted font-13 m-b-30">
                      <i>All the Masterfiles for Teachers, Subordinate Staff, Pupils and Gurdians</i>
                    </p> 
              		<table id="datatable-buttons" class="table table-striped jambo_table table-bordered">
						<thead>
							<tr>
							  	<th>Mf#</th>
							  	<th>Surname</th>
							  	<th>F. Name</th>
							  	<th>M. Name</th>
							  	<th>ID/Adm No</th>
							  	<th>Phone No</th>
							  	<th>Reg. Date</th>
							  	<th>Role</th>
							  	<th>Title</th>
							  	<th> Action</th>
							  	<th> Profile</th>
						  </tr>
						</thead>
 						<tbody>
					 		<?php 
					 			$mf_records = $mf->geAllMasterfiles();
					 			if(count($mf_records)){
					 				foreach($mf_records as $mf_record){
					 		?>
					 		<tr>
					 			<td><?php echo $mf_record['mf_id']; ?></td>
					 			<td><?php echo $mf_record['surname']; ?></td>
					 			<td><?php echo $mf_record['firstname']; ?></td>
					 			<td><?php echo $mf_record['middlename']; ?></td>
					 			<td><?php echo $mf_record['id_no']; ?></td>
					 			<td><?php echo $mf_record['contact_phone_no']; ?></td>
					 			<td><?php echo $mf_record['reg_date']; ?></td>
					 			<td><?php echo $mf_record['role_name']; ?></td>
					 			<td><?php echo $mf_record['title_name']; ?></td>
					 			<td>
									<li class="dropdown" style="list-style: none;">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-edit"></i> Action</a>
					                	<ul class="dropdown-menu" role="menu">
					                  		<li><a edit-id="<?php echo $mf_record['mf_id']; ?>" data-toggle="modal" data-target="#edit_masterfile" class="edit_btn" style="cursor: pointer;"><i class="fa fa-edit"></i> Edit</a></li>
					                  		<li><a edit-id="<?php echo $mf_record['mf_id']; ?>" data-toggle="modal" data-target="#delete_masterfile" class="delete_btn" style="cursor: pointer; color:red;"><i class="fa fa-remove"></i> Delete</a></li>
					                	</ul>
              						</li>
								</td>
					 			<td><a href="?num=masterfile&mf_id=<?php echo $mf_record['mf_id']; ?>"><i class="fa fa-eye"></i> Profile</a></td>
					 		</tr>
					 		<?php }} ?>
					  </tbody>
					</table>
              	</div>
            </div>
      	</div>
    </div>
    

<div id="edit_masterfile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Update Masterfile</h4>
      	</div>
      	<div class="modal-body" style="height: 450px; overflow-y: scroll;">
	        <div id="testmodal" style="padding: 5px 20px;">
	          <form id="edit_form" action="" method="post" class="form-horizontal calender" role="form">
	            <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role <span class="required">*</span></label>
	              <div class="col-sm-9">
	                 <select name="role" id="role" class="form-control col-md-7 col-xs-12 required">
				        <option value="">--Choose Role--</option>
				        <?php
				          $roles = $mf->getAllRoles();
				          if(count($roles)){
				            foreach ($roles as $role) {
				        ?>
				        <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
			        	<?php }} ?>
			      	</select>
	              </div>
	            </div>
	            
	            <div class="item form-group" id="title_div" style="display: none;">
	              <label for="title" class="control-label col-md-3 col-sm-3 col-xs-12" id="title_lab">Title</label>
	              <div class="col-sm-9">
	                <select name="title" id="title" class="form-control single_select2">
				  		<option value="">--Choose Title--</option>
				  		<?php 
				  			$titles = $mf->getAllTitles();
				  			if(count($titles)){
				  				foreach ($titles as $title){
				  		?>
				  		<option value="<?php echo $title['title_id']; ?>"><?php echo $title['title_name']; ?></option>
				  		<?php
				  				}
				  			}
				  		?>
				  	</select>
	              </div>
	            </div>
	            <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_no" id="lab_adm">Adm No <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <input type="text" id="id_no" name="id_no" required="required" value="<?php echo $mf->get('id_no'); ?>" class="form-control">
	              </div>
	            </div>
	            
	            <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lab_dob">Date of Birth <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <input type="date" required="required" id="dob" name="dob" class="form-control" placeholder="Date of Birth" aria-describedby="inputSuccess2Status" value="<?php echo $mf->get('dob'); ?>">
	              </div>
	            </div>
	            
	            <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration Date <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <input type="date" required="required" id="reg_date" name="reg_date" class="form-control" placeholder="Date of Birth" aria-describedby="inputSuccess2Status" value="<?php echo $mf->get('dob'); ?>">
	              </div>
	            </div>
	            
	            <div class="item form-group">
	               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Surname <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <input type="text" id="surname" name="surname" required="required" value="<?php echo $mf->get('surname'); ?>" class="form-control col-md-7 col-xs-12">
	              </div>
	            </div>
	            
	            <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">First Name <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <input type="text" id="fname" name="fname" value="<?php echo $mf->get('fname'); ?>" required="required" class="form-control col-md-7 col-xs-12">
	              </div>
	            </div>
	            
	            <div class="item form-group">
	              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name </label>
	              <div class="col-sm-9">
	                <input id="mname" class="form-control col-md-7 col-xs-12" type="text" name="mname" value="<?php echo $mf->get('mname'); ?>">
	              </div>
	            </div>
	            
	            <div class="item form-group">
	             <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <div id="gender" class="btn-group" data-toggle="buttons">
				        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
				          <input type="radio" name="gender" value="Male"> &nbsp; Male &nbsp;
				        </label>
				        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
				          <input type="radio" name="gender" value="Female"> Female
				        </label>
				      </div>
	              </div>
	            </div>
	            <hr/>
	            
	            <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="guardian" id="lab_guardian">Guardian <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <select name="guardian" id="guardian" class="form-control col-md-7 col-xs-12 select2_single required" style="width: 100%;">
				        <option value="">--Choose Guardian--</option>
				        <?php
				          $guardians = $mf->getAllGuardians();
				          if(count($guardians)){
				            foreach($guardians as $guardian){
				        ?>
				        <option value="<?php echo $guardian['mf_id']; ?>"
				        <?php
				        	if(isset($_POST['guardian']))
				        		if($mf->get('guardian') == $guardian['mf_id'])	echo 'selected';
				        ?>
				        ><?php echo $guardian['guardian_name']; ?></option>
				        <?php }} ?>
				      </select>
	              </div>
	            </div>
	            
	            <div class="item form-group">
	               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form" id="lab_form">Class <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <select name="class_id" id="form" class="form-control col-md-7 col-xs-12 required">
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
	            
	            <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stream" id="lab_stream">Stream <span class="required">*</span></label>
	              <div class="col-sm-9">
	                <select name="stream_id" id="stream" class="form-control col-md-7 col-xs-12 required">
				        <option value="">--Choose Form Stream--</option>
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
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Clo617');
        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Sav618');
        ?>
      	</div>
    </div>
  </div>
</div>

<div id="delete_masterfile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h4 class="modal-title" id="myModalLabel">Delete Masterfile</h4>
      	</div>
      	<div class="modal-body">
	       	<p>Are you sure you want to delete seleted masterfile?</p>
      	</div>
      	<form action="" method="post">
      		<!-- hidden fields -->
      		<input type="hidden" name="action" value="delete_subject"/>
      		<input type="hidden" name="delete_id" id="delete_id">
	      	<div class="modal-footer">
	        <?php
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'No619');
	        	createSectionButton($_SESSION['role_id'], $_GET['num'], 'Yes620');
	        ?>
	      	</div>
      	</form>
    </div>
  </div>
</div>
<?php set_js(array('src/js/masterfile.js'))?>