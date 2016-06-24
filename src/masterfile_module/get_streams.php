<?php
session_start();
include('../connection/config.php');

$return = array();
if(isset($_POST['form_id'])){
	$query = "SELECT * FROM school_forms_and_streams 
	WHERE form_id = '".pg_escape_string($_POST['form_id'])."' AND school_id = '".$_SESSION['school_id']."'";
	if($result = pg_query($query)){
		if (pg_num_rows($result)) {
			while ($rows = pg_fetch_assoc($result)) {
				$return[] = $rows;
			}
			echo json_encode($return);
		}
	}
}