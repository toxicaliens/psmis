<?php
$query="SELECT count(sys_view_id)  as total_views FROM sys_views";
$data=run_query($query);
$the_rows=get_row_data($data);
$customer_num=$the_rows['total_views'];
?>
<!-- <div class="x_panel"> -->
    <!-- <div class="x_title">
        <h2>All System Views</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div> -->
      <div class="x_content">
        <!-- <p class="text-muted font-13 m-b-30">
          The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
        </p> -->
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width: 100%">
          <thead>
		          <tr>
				  	<th>ID#</th>
				  	<th>View Name</th>
				  	<th>View Index</th>
				  	<th>View Url</th>
				  	<th>Status</th>
				  	<th>Parent View</th>
				  	<th>Edit</th>
				  </tr>
		         </thead>
          <tbody>
        <?php
          $distinctQuery = "SELECT * FROM sys_views Order by sys_view_id DESC ";
			$resultId = run_query($distinctQuery);	
			$total_rows = get_num_rows($resultId);


			$con = 1;     
			$total = 0;     
			while($row = get_row_data($resultId))     {
			    $sys_view_id = $row['sys_view_id'];
			    $view_name = $row['sys_view_name'];
			    $view_index = $row['sys_view_index'];
			    $view_url = $row['sys_view_url'];
			    $view_status = $row['sys_view_status'];
			    if($view_status == 't'){
			    	$view_status = 'Active';
			    }else{
			    	$view_status = 'Inactive';
			    }
        ?>
        <tr>             
            <td><?=$sys_view_id; ?></td>
		    <td><?=$view_name; ?></td>         
		    <td><?=$view_index; ?></td>  
		    <td><?=$view_url; ?></td>
		    <td><?=$view_status; ?></td>
		    <td><?=getParentViewName($row['parent']); ?></td>  
            <td><a id="edit_link" href="index.php?num=edit_view&id=<?=$sys_view_id; ?>"><i class="fa fa-edit"></i> Edit</a></td> 
        </tr>
        <?php } ?> 
        </tbody>
      </table>
    </div>
<!-- </div> -->




