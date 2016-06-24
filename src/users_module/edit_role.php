<?php
set_title('Edit User Role');
set_layout("form-layout.php");

	//get the value
$id=$_GET['id'];
if (isset($id))
{
//get the row
$query="SELECT * FROM ".DATABASE.".user_roles WHERE role_id='$id'";
$data=run_query($query);
}

$row=get_row_data($data);

//the values
$role_id = $row['role_id'];
$role_name = $row['role_name'];
$role_status = $row['role_status'];
?>  
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Edit User Role
      	</h3>
  	</div>

	<?php include('src/search_box.php'); ?>
</div>

<div class="clearfix"></div>    

<div class="row">
  	<div class="col-md-12 col-xs-12">
    	<div class="x_panel">
      		<div class="x_title">
        	<h2>Edit User Role <small><a href="?num=add_role">< Manage User Roles ></a></small></h2>
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
						<label for="role_name" class="control-label col-md-3 col-sm-3 col-xs-12">Role Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<input type="text" name="role_name" value="<?=$role_name; ?>" class="form-control" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<?php
								$choice1 = '';
								$choice2 = '';
								if($role_status == 't'){
									$choice1 = 'selected';
								}else{
									$choice2 = 'selected';
								}
							?>
							<select name="status" class="form-control">
								<option value="">--Choose Status--</option>
								<option value="1" <?=$choice1; ?>>Active</option>
								<option value="0" <?=$choice2; ?>>Inactive</option>
							</select>
						</div>
					</div>

					<input type="hidden" name="action" value="edit_role"/>
					<input type="hidden" name="role_id" value="<?=$role_id; ?>"/>

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