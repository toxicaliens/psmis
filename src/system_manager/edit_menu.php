<?php
set_title('Edit Menu Details');
set_layout("form-layout.php");

if(isset($_GET['id'])){
		$menu_id = $_GET['id'];
		$result = run_query("SELECT * FROM menu WHERE menu_id = '".$menu_id."'");
		$row = get_row_data($result);
		$status=$row['status'];
		$view_id=$row['view_id'];
		$sequence=$row['sequence'];
	}
?>  
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Edit Menu Item
      	</h3>
  	</div>

	<?php include('src/search_box.php'); ?>
</div>

<div class="clearfix"></div>    

<div class="row">
  	<div class="col-md-12 col-xs-12">
    	<div class="x_panel">
      		<div class="x_title">
        	<h2>Edit System Menu <small><a href="?num=manage_menu">< Manage System Menu ></a></small></h2>
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
						<label for="menu_name" class="control-label col-md-3 col-sm-3 col-xs-12">Menu Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<input type="text" name="menu_name" value="<?=$row['text']; ?>" class="form-control" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="icon" class="control-label col-md-3 col-sm-3 col-xs-12">Icon:</label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<input type="text" name="icon" value="<?=$row['icon']; ?>" class="form-control" autocomplete="off"/>
						</div>
					</div>
					<div class="form-group">
						<label for="view" class="control-label col-md-3 col-sm-3 col-xs-12">View:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="view" class="form-control">
								<option value="">--Attach to View--</option>
								<?php
									$run = run_query("SELECT * FROM sys_views ORDER BY sys_view_name ASC");
									while($row=get_row_data($run)){
										$text=$row['sys_view_name'];
										$sys_view_id=$row['sys_view_id'];
								?>
								<option value="<?=$sys_view_id; ?>" <?php if($sys_view_id === $view_id){ echo 'selected'; } ?>><?=$text; ?></option>
								<?php	
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status:</label>
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
							<select name="status" class="form-control">
								<option value="1" <?=$choice1; ?>>Active</option>
								<option value="0" <?=$choice2; ?>>Inactive</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="sequence" class="control-label col-md-3 col-sm-3 col-xs-12">Sequence:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="number" min="0" class="form-control" name="sequence" value="<?=$sequence; ?>"
							autocomplete="off" required/>
						</div>
					</div>
					

					<input type="hidden" name="menu_id" value="<?=$menu_id; ?>" />
					<input name="action" type="hidden" value="edit_menu_details" />

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
