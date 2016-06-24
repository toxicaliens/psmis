<?php
session_start();
include('../connection/config.php');

$return = array();
if(isset($_POST['county_id'])){
	$query = "SELECT * FROM counties_and_constituencies 
	WHERE county_id = '".pg_escape_string($_POST['county_id'])."'";
	if($result = pg_query($query)){
		if (pg_num_rows($result)) {
			while ($rows = pg_fetch_assoc($result)) {
				$return[] = $rows;
			}
			echo json_encode($return);
		}
	}
}