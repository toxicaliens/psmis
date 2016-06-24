<!-- <div class="row"> -->
  	<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
    	<!-- <div class="x_panel"> -->
      		<!-- <div class="x_title">
	        	<h2>Add New User Role</h2>
	        	<div class="clearfix"></div>
      		</div> -->
      		<div class="x_content">
      			<?php 
				if(isset($_SESSION['done-add'])){
				    echo "<p style='color:#f00; font-size:16px;'>".$_SESSION['done-add']."</p>";
				    unset($_SESSION['done-add']);
				} 
				?>
	        	<br />
				<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label for="role_name" class="control-label col-md-3 col-sm-3 col-xs-12">Role Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="role_name" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="role_name" class="control-label col-md-3 col-sm-3 col-xs-12">Role Status<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="status" class="form-control">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
					</div>
					
					<input type="hidden" name="action" value="add_role"/>
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