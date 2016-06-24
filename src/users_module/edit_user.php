<?php
set_title('Edit Users Details');
set_layout("form-layout.php");

//get the value

if (isset($_GET['user'])){
	$user=$_GET['user'];
	//get the row
	$query="SELECT * FROM ".DATABASE.".user_login2 WHERE user_id='$user'";
	$data=run_query($query);
	$row=get_row_data($data);

	//the values
	$id = $row['user_id'];
	$username = $row['username'];
	$email=$row['email'];
	$status=$row['user_active'];  
	$user_role=$row['user_role'];
}
?>
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Edit User Details
      	</h3>
  	</div>

	<?php include('src/search_box.php'); ?>
</div>

<div class="clearfix"></div>    

<div class="row">
  	<div class="col-md-12 col-xs-12">
    	<div class="x_panel">
      		<div class="x_title">
        	<h2>Edit User Details <small><a href="?num=all_users">< All Users></a></small></h2>
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
						<label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="username" class="form-control" readonly value="<?=$username; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php
								$choice1 = '';
								$choice2 = '';
								if($status == 't'){
									$choice1 = 'selected';
								}else{
									$choice2 = 'selected';
								}
							?>	
							<select name="status" class="form-control" required>
								<option value="1" <?php echo $choice1; ?>>Active</option>
								<option value="0" <?php echo $choice2; ?>>Inactive</option>
							</select>
						</div>
					</div>
					<div class="form-group">
			    		<label for="user_role" class="control-label col-md-3 col-sm-3 col-xs-12">User Role<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="user_role" class="form-control" required>
								<option value="">--Choose Role--</option>
								<?php

			                        $query = "SELECT * FROM user_roles ORDER BY role_name ASC";

			                        if ($data = run_query($query))
			                        {
			                                while ( $fetch = get_row_data($data) )
			                                {
			                        ?>
			                        <option value="<?=$fetch['role_id']; ?>" <?php if($fetch['role_id'] === $user_role){ echo 'selected'; } ?>><?php echo $fetch['role_name']; ?></option>";
			                        <?php
			                            }
			                        }
			                        ?>
							</select>
						</div>
			        </div>

					<input type="hidden" name="action" value="edit_user"/>
					<input type="hidden" name="user_id" value="<?=$id; ?>"/>

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