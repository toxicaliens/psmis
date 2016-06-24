<?php
	include '../connection/config.php';

	if(isset($_POST['edit_id'])){
		$query = "SELECT * FROM grading WHERE grading_id = '".$_POST['edit_id']."'";
		if($result = pg_query($query)){
			if(pg_num_rows($result)){
				echo json_encode(pg_fetch_assoc($result));
			}
		}
	}
?>