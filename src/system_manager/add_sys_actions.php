<!-- <div class="row"> -->
  	<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
    	<!-- <div class="x_panel"> -->
      		<!-- <div class="x_title">
	        	<h2>Add New System View</h2>
	        	<ul class="nav navbar-right panel_toolbox">
		          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		          	</li>
	          		<li><a class="close-link"><i class="fa fa-close"></i></a>
	          		</li>
	        	</ul>
	        	<div class="clearfix"></div>
      		</div> -->
      		<div class="x_content">
				<?php if(isset($_SESSION['mes2'])){ echo $_SESSION['mes2']; unset($_SESSION['mes2']); } ?>
	        	<br />
				<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label for="action_name" class="control-label col-md-3 col-sm-3 col-xs-12">Action Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="action_name" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">Button Type:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="type" class="form-control" required>
								<option value="submit">Submit</option>
							    <option value="delete">Delete</option>
							    <option value="reset">Reset</option>
							    <option value="back">Back</option>
							    <option value="search">Search</option>
							    <option value="button">Button</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="class" class="control-label col-md-3 col-sm-3 col-xs-12">Class:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="class" value="btn btn-primary" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="action_status" class="control-label col-md-3 col-sm-3 col-xs-12">Action Status:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="action_status" class="form-control">
								<option value="1">Active</option>
							    <option value="0">Inactive</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="action_type" class="control-label col-md-3 col-sm-3 col-xs-12">Action Type:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="button_type" class="form-control">
								<option value="">--Choose Action Type--</option>
							    <option value="form">Form Action</option>
							    <option value="section">Section Action</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="view_name" class="control-label col-md-3 col-sm-3 col-xs-12">View Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="view_name" class="form-control select2_single" required>
								<option value="">--Choose View--</option>
								<?php
									$query = "SELECT * From sys_views ORDER BY sys_view_name ASC";
									$options = run_query($query);
									while($row = get_row_data($options)){
								?>
								<option value="<?=$row['sys_view_id']; ?>"><?=$row['sys_view_name']; ?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="action_description" class="control-label col-md-3 col-sm-3 col-xs-12">Action Description:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea id="action_description" class="form-control" name="action_description" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-validation-threshold="10"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="others" class="control-label col-md-3 col-sm-3 col-xs-12">Others:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="others" autocomplete="off"/>
						</div>
					</div>
					
					
					<input type="hidden" name="action" value="add_action"/>
					<div class="ln_solid"></div>
	              	<div class="form-group">
	                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<?php
							viewActions($_GET['num'], $_SESSION['role_id']);
						?>
						</div>
					</div>
				</form>
			</div>
		<!-- </div> -->
	<!-- </div> -->
<!-- </div> -->