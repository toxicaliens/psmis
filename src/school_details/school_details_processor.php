<?php
	include_once('src/models/School.php');
	include_once('src/models/Streams.php');
	$school = new School();
	$stream = new Streams();

	switch ($_POST['action']) {
		case add_class:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$school->addClass();
			$_SESSION['warnings'] = $school->getWarnings();
			break;

		case del_class:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$school->deleteClass();
			$_SESSION['warnings'] = $school->getWarnings();
			break;

		case add_stream:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$stream->addStream();
			$_SESSION['warnings'] = $stream->getWarnings();
			break;

		case edit_stream:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$stream->editStream();
			$_SESSION['warnings'] = $stream->getWarnings();
			break;

		case delete_stream:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$stream->deleteStream();
			break;

		case delete_selected_stream:
	        logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
	        extract($_POST);
	        $stream->deleteSelectedStreams($delete_ids);
	        break;
		
	}
?>