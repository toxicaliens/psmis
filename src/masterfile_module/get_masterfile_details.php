<?php
include '../connection/config.php';

if(!empty($_POST['edit-id'])){
	if($result = pg_query("SELECT * FROM masterfile WHERE mf_id = '".$_POST['edit-id']."'")){
		echo json_encode(pg_fetch_assoc($result));
	}
}