<?php
set_title('Edit Action');
set_layout("form-layout.php");

if(isset($_GET['id'])){
	$action_id = $_GET['id'];

	$query = "SELECT * FROM sys_actions WHERE sys_action_id = '".$action_id."'";
	$result = run_query($query);
	if($result){
		while($row = get_row_data($result)){
			// $sys_action_code = $row['sys_action_code'];
			$sys_action_class = $row['sys_action_class'];
			$sys_action_type = $row['sys_action_type'];
			$sys_action_description = $row['sys_action_description'];
			$sys_view_id = $row['sys_view_id'];
			$sys_action_status = $row['sys_action_status'];
			$sys_action_name = $row['sys_action_name'];
			$sys_button_type = $row['sys_button_type'];
			$others = $row['others'];
			$action1 = '';
			$action2 = '';
			if($sys_button_type == 'form'){
				$action1 = 'selected';
			}elseif($sys_button_type == 'section'){
				$action2 = 'selected';
			}
		}
	}
}
?>  
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Edit System Actions
      	</h3>
  	</div>

	<?php include('src/search_box.php'); ?>
</div>

<div class="clearfix"></div>    

<div class="row">
  	<div class="col-md-12 col-xs-12">
    	<div class="x_panel">
      		<div class="x_title">
        	<h2>Edit System Action <small><a href="?num=all_actions">< Manage System Actions ></a></small></h2>
        	<ul class="nav navbar-right panel_toolbox">
          		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          		</li>
	          	<li><a class="close-link"><i class="fa fa-close"></i></a>
	          	</li>
        	</ul>
        	<div class="clearfix"></div>
      		</div>
      		<div class="x_content">
	        	<br />

				<form action="" method="post" class="form-horizontal form-label-left input_mask">
			       <?php if(isset($_SESSION['done-edits'])){ echo $_SESSION['done-edits']; unset($_SESSION['done-edits']); } ?>
					<div class="form-group">
						<label for="action_name" class="control-label col-md-3 col-sm-3 col-xs-12">Action Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<input type="text" name="action_name" value="<?=$sys_action_name; ?>" class="form-control" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">Button Type:</label>
						<div class="col-md-6 col-sm-6 col-sm-12">
						  <select name="type" class="form-control">
                            <option value="">--Choose Button Type--</option>
							<?php
								// $query = "SELECT * From sys_actions";
								// $options = run_query($query);
								// while($row = get_row_data($options)){
									$selected_type = $sys_action_type;
									switch($selected_type){
										case 'submit':
											$selected_type = 'submit';
											break;

											case 'reset':
												$selected_type = 'reset';
												break;

												case 'delete':
													$selected_type = 'delete';
													break;

													case 'back':
														$selected_type = 'back';
														break;

														case 'search':
															$selected_type = 'search';
															break;

															case 'button':
																$selected_type = 'button';
																break;
									}
								// }
							?>
							<option value="submit" <?php if($selected_type === 'submit'){ echo 'selected'; } ?>>Submit</option>
							<option value="reset" <?php if($selected_type === 'reset'){ echo 'selected'; } ?>>Reset</option>
							<option value="delete" <?php if($selected_type === 'delete'){ echo 'selected'; } ?>>Delete</option>
							<option value="back" <?php if($selected_type === 'back'){ echo 'selected'; } ?>>Back</option>
							<option value="search" <?php if($selected_type === 'search'){ echo 'selected'; } ?>>Search</option>
							<option value="button" <?php if($selected_type === 'button'){ echo 'selected'; } ?>>Button</option>"button" <?php if($selected_type === 'button'){ echo 'selected'; } ?>>Button</option>
						  </select>	
						</div>
					</div>
					<div class="form-group">
						<label for="class" class="control-label col-md-3 col-sm-3 col-xs-12">Class:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="class" value="<?=$sys_action_class; ?>"
							autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="action_status" class="control-label col-md-3 col-sm-3 col-xs-12">Action Status:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						   <?php
								$choice1 = '';
								$choice2 = '';
								if($sys_action_status == 't'){
									$choice1 = 'selected';
								}else{
									$choice2 = 'selected';
								}
							?>
							<select name="action_status" class="form-control">
								<option value="1" <?=$choice1; ?>>Active</option>
								<option value="0" <?=$choice2; ?>>Inactive</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="action_status" class="control-label col-md-3 col-sm-3 col-xs-12">Action Type:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="button_type" class="form-control">
								<option value="">--Choose Action Type--</option>
							    <option value="form"<?=$action1; ?>>Form Action</option>
							    <option value="section"<?=$action2; ?>>Section Action</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="view_name" class="control-label col-md-3 col-sm-3 col-xs-12">View Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="view_name" class="form-control">
								<option value="">--Choose View--</option>
								<?php
									$query = "SELECT * From sys_views ORDER BY sys_view_name ASC";
									$options = run_query($query);
									while($row = get_row_data($options)){
								?>
								<option value="<?=$row['sys_view_id']; ?>" <?php if($row['sys_view_id'] === $sys_view_id){ echo 'selected'; } ?>><?=$row['sys_view_name']; ?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="action_description" class="control-label col-md-3 col-sm-3 col-xs-12">Action Description:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea id="action_description" class="form-control" name="action_description" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-validation-threshold="10">
							<?=$sys_action_description; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="others" class="control-label col-md-3 col-sm-3 col-xs-12">Others:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="others" value="<?=$others; ?>" 
							autocomplete="off"/>
						</div>
					</div>
					

					<input type="hidden" name="action" value="ed_action"/>
		            <input type="hidden" name="action_id" value="<?=$action_id; ?>"/>

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
		</div>
	</div>
</div>
