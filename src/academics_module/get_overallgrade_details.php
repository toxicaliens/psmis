<?php
	include '../connection/config.php';

	if(isset($_POST['edit_id'])){
		$query = "SELECT * FROM overall_grading WHERE overall_grade_id = '".$_POST['edit_id']."'";
		if($result = pg_query($query)){
			if(pg_num_rows($result)){
				echo json_encode(pg_fetch_assoc($result));
			}
		}
	}
?>