<?php
	include_once('src/models/Academics.php');
	$academics = new Academics();

	switch ($_POST['action']) {
		case add_subject:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$academics->addSubject();
			$_SESSION['warnings'] = $academics->getWarnings();
			break;

		case edit_subject:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$academics->editSubject();
			$_SESSION['warnings'] = $academics->getWarnings();
			break;

		case delete_subject:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$academics->deleteSubject();
			break;

		case delete_selected_subjects:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			extract($_POST);
			$academics->deleteSubjects($delete_ids);
			break;
	}
?>
