<?php
set_title('General Audit Trail');
set_layout("dt-layout.php");
?>

<div class="page-title">
  	<div class="title_left">
        <h3>
              	Master Audit Trail
              	<small>
                  	Logs all actions done in the system
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
                    <h2>Audit Trail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
              	</div>
              	<div class="x_content">
                  	<!-- <p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p> -->

					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
							  	<th>#</th>
							  	<th>ACTION NAME</th>
							  	<th>ACTION TIME</th>
							  	<th>SESSION ID</th>
							  	<th>USER NAME</th>
							  </tr>
						</thead>
					 	<tbody>
					 <?php

					   $distinctQuery = "SELECT a.*, l.*, u.* FROM audit_trail a
									LEFT JOIN login_sessions l ON a.session_id = l.login_session_id
									LEFT JOIN user_login2 u ON a.mf_id = u.mf_id";
					   $resultId = run_query($distinctQuery);	
					   $total_rows = get_num_rows($resultId);
					   
					    $con = 1;     
					    $total = 0;   
					    $counter = 1;  
					    while($row = get_row_data($resultId)){
					        $action_name = $row['case_name'];
							$action_time = $row['datetime'];
							$session_id = $row['session_id']; 
							$user_name = $row['username'];
						?>
					<tr>             
						<td><?=$counter; ?></td>
					    <td><?=$action_name; ?></td>
					    <td><?=$action_time; ?></td>          
						<td><?=$session_id; ?></td>
						<td><?=$user_name; ?></td>
					</tr>
					<?php $counter++; }	?>
					  
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>