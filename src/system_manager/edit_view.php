<?php
set_title('Edit View');
set_layout("form-layout.php");

if(isset($_GET['id'])){
	$view = $_GET['id'];

	//get the row
	$query="SELECT * FROM ".DATABASE.".sys_views WHERE sys_view_id='$view'";
	$data=run_query($query);
	$total_rows=get_num_rows($data);
	}
	$con=1;
	$total=0;

	while($row=get_row_data($data)){

	//the values
	$sys_view_id = $row['sys_view_id'];
    $view_name = $row['sys_view_name'];
    $view_index = $row['sys_view_index'];
    $view_url = $row['sys_view_url'];
    $view_status = $row['sys_view_status'];
    $view_parent = $row['parent'];
    $choice1 = '';
    $choice2 = '';
    if($view_status == 't'){
    	$choice1 = 'selected';
    }else{
    	$choice2 = 'selected';
    }
}
?>  
<div class="page-title">
  	<div class="title_left">
        <h3>
          	Edit View Item
      	</h3>
  	</div>

	<?php include('src/search_box.php'); ?>
</div>

<div class="clearfix"></div>    

<div class="row">
  	<div class="col-md-12 col-xs-12">
    	<div class="x_panel">
      		<div class="x_title">
        	<h2>Edit System View <small><a href="?num=all_views">< Manage System View ></a></small></h2>
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
						<label for="view_name" class="control-label col-md-3 col-sm-3 col-xs-12">View Name:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<input type="text" name="view_name" value="<?=$view_name; ?>" class="form-control" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="view_index" class="control-label col-md-3 col-sm-3 col-xs-12">View Index:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<input type="text" name="view_index" value="<?=$view_index; ?>" class="form-control" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="view_url" class="control-label col-md-3 col-sm-3 col-xs-12">View URL:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-sm-12">
							<input type="text" name="view_url" value="<?=$view_url; ?>" class="form-control" autocomplete="off" required/>
						</div>
					</div>
					<div class="form-group">
						<label for="view_status" class="control-label col-md-3 col-sm-3 col-xs-12">View Status:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="view_status" class="form-control">
								<option value="1" <?=$choice1; ?>>Active</option>
								<option value="0" <?=$choice2; ?>>Inactive</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="parent" class="control-label col-md-3 col-sm-3 col-xs-12">Parent:<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="parent" class="form-control">
								<option value="NULL">--No Parent--</option>
									<?php
										$result = run_query("SELECT * FROM sys_views WHERE parent is null");
										while($row = get_row_data($result)){
											$sys_view_id2 = $row['sys_view_id'];
											$view_name = $row['sys_view_name'];
									?>
									<option value="<?=$sys_view_id2; ?>" <?php if($sys_view_id2 == $view_parent){ echo 'selected'; } ?>><?=$view_name; ?></option>
									<?php
										}
									?>
							</select>
						</div>
					</div>
					

					<input type="hidden" name="action" value="edit_view"/>
		            <input type="hidden" name="view_id" value="<?=$sys_view_id; ?>"/>

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
