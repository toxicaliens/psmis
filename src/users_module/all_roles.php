<?php
$query="SELECT count(role_id)  as total_roles FROM user_roles";
$data=run_query($query);
$the_rows=get_row_data($data);
$customer_num=$the_rows['total_roles'];
?>
<!-- <div class="x_panel"> -->
    <!-- <div class="x_title">
        <h2>All User Roles</h2>
        <div class="clearfix"></div>
      </div> -->
      <div class="x_content">
        <!-- <p class="text-muted font-13 m-b-30">
          The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
        </p> -->
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width: 100%">
          <thead>
            <tr>
              <th>Role#</th>
              <th>Role Name</th>
              <th>Status</th>
              <th>Edit</th>
              <th>Allocate Views</th>
            </tr>
          </thead>
          <tbody>
        <?php
          $distinctQuery = "SELECT ur.* FROM user_created_roles ucr
          LEFT JOIN user_roles ur ON ucr.role_id = ur.role_id
          WHERE ucr.mf_id = '".$_SESSION['mf_id']."'";
          $resultId = run_query($distinctQuery);   
          while($row = get_row_data($resultId))     {
            $role_id = $row['role_id'];
            $role_name = $row['role_name'];
            $role_status = $row['role_status'];
            if($role_status == 't'){
              $role_status = 'Active';
            }else{
              $role_status = 'Inactive';
            }
        ?>
        <tr>             
          <td><?=$role_id; ?></td>
          <td><?=$role_name; ?></td>         
          <td><?=$role_status; ?></td>  
          <td><a id="edit_link" href="index.php?num=edit_role&id=<?=$role_id; ?>"><i class="fa fa-edit"></i> Edit</a></td>
          <td><a id="edit_link" href="index.php?num=manage_views&id=<?=$role_id; ?>&role_name=<?=$role_name; ?>">Manage Views</a></td>
        </tr>
        <?php } ?> 
        </tbody>
      </table>
    </div>
<!-- </div> -->




