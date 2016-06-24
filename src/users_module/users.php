<?php

set_title('All Users');
set_layout("dt-layout.php");
?>

<div class="page-title">
  	<div class="title_left">
        <h3>
          	All System Users
          	<small>
                People who can log into the system.
          	</small>
      	</h3>
  	</div>

  	<?php include('src/search_box.php'); ?>
    </div>

    <div class="clearfix"></div>

    <div class="row">

      	<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              	<div class="x_title">
                    <h2>All Users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<!-- <p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p> -->
              		<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
							  	<th>ID#</th>
							  	<th>Username</th>
							  	<th>Email</th>
							  	<th>Status</th>
							  	<th>User Role</th>
							  	<th>Edit</th>
						  </tr>
						</thead>
 						<tbody>
					 	<?php
					 	$query = "SELECT u.*, ur.role_name FROM user_login2 u 
					 	LEFT JOIN user_roles ur ON ur.role_id = u.user_role
					 	WHERE school_id = '".$_SESSION['school_id']."'";
					 	$resultId = run_query($query);
					    while($row = get_row_data($resultId))     {
					        $id = $row['user_id'];
					        $username = $row['username'];
							$email=$row['email'];
							$status=$row['user_active']; 
							if($status == 't'){
								$status = 'Active';
								$class = 'label label-success';
							}else{
								$status = 'Blocked';
								$class = 'label label-danger';
							}
							$user_role=$row['role_name'];
						?>
						<tr>             
							<td><?=$id; ?></td>
						    <td><?=$username; ?></td>
						    <td><?=$email; ?></td>          
							<td><span class="<?=$class; ?>"><?=$status; ?></span></td>
							<td><?=$user_role; ?> </td>          
							<td><a id="edit_link" href="index.php?num=edit_user&user=<?=$id; ?>"><i class="fa fa-edit"></i> Edit</a></td>
						</tr>	
						<?php } ?>
					  </tbody>
					</table>
              	</div>
            </div>
      	</div>
    </div>
