<?php
include '../connection/config.php';

$return = [];
if(!empty($_POST['role_id'])){
	$role_id  = pg_escape_string(trim($_POST['role_id']));
	
	if($result =pg_query("SELECT * FROM title WHERE role_id = '".$role_id."'")){
		while($rows = pg_fetch_assoc($result)){
			$return[] = $rows;
		}
		echo json_encode($return);
	}
}