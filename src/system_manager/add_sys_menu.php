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
						<label for="parent" class="control-label col-md-3 col-sm-3 col-xs-12">Parent:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="parent" class="form-control select2_single">
								<option value="null">No Parent</option>
									<?php
										$run = run_query("SELECT * FROM menu WHERE parent_id is null");
										while($row=get_row_data($run)){
											$text=$row['text'];
											$menu_id=$row['menu_id'];
											echo "<option value=\"$menu_id\">$text</option>";
										}
									?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="menu_name" class="control-label col-md-3 col-sm-3 col-xs-12">Menu Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="menu_name" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="icon" class="control-label col-md-3 col-sm-3 col-xs-12">Icon:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="icon" autocomplete="off"/>
						</div>
					</div>
					<div class="form-group">
						<label for="sequence" class="control-label col-md-3 col-sm-3 col-xs-12">Sequence:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="number" min="0" class="form-control" name="sequence" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="view" class="control-label col-md-3 col-sm-3 col-xs-12">View:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="view" class="form-control select2_single">
								<option value="">--Attach to View--</option>
								<?php
									$run = run_query("SELECT * FROM sys_views ORDER BY sys_view_name ASC");
									while($row=get_row_data($run)){
										$text=$row['sys_view_name'];
										$view_id=$row['sys_view_id'];
										echo "<option value=\"$view_id\">$text</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="status" class="form-control">
								<option value="1">Active</option>
						        <option value="0">Inactive</option>
							</select>
						</div>
					</div>
					
					
					<input type="hidden" name="action" value="add_menu_item"/>
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