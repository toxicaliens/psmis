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
						<label for="view_name" class="control-label col-md-3 col-sm-3 col-xs-12">View Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="view_name" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="view_index" class="control-label col-md-3 col-sm-3 col-xs-12">View Index:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="view_index" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="view_url" class="control-label col-md-3 col-sm-3 col-xs-12">View URL:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="view_url" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="view_status" class="control-label col-md-3 col-sm-3 col-xs-12">View Status:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="view_status" class="form-control">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="parent" class="control-label col-md-3 col-sm-3 col-xs-12">Parent:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="parent" class="form-control select2_single">
							    <option value="NULL">--No Parent--</option>
								<?php
								$result = run_query("SELECT * FROM sys_views WHERE parent is null");
								while($row = get_row_data($result)){
									$sys_view_id = $row['sys_view_id'];
									$view_name = $row['sys_view_name'];
								?>
								<option value="<?=$sys_view_id; ?>"><?=$view_name; ?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					
					<input type="hidden" name="action" value="add_view"/>
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