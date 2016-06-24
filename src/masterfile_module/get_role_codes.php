<?php
include '../connection/config.php';

if(isset($_POST['role_id'])){
	$query = "SELECT role_code FROM role WHERE role_id = '".trim($_POST['role_id'])."'";
	if($result = pg_query($query)){
		if(pg_num_rows($result)){
			echo json_encode(pg_fetch_assoc($result));
		}
	}
}