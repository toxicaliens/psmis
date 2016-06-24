<?php
	include_once('src/models/Masterfile.php');
	$mf = new Masterfile();
	
	switch ($_POST['action']) {
		case add_masterfile:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
// 			var_dump($_POST);exit;
			$mf->addMasterfile($_POST['role']);
			$_SESSION['warnings'] = $mf->getWarnings();
			break;

		case edit_masterfile:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);	
			break;

		case delete_masterfile:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			break;

		case add_contact:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$mf->addContact();
			$_SESSION['warnings'] = $mf->getWarnings();
			break;

		case edit_contact:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$mf->editContact();
			$_SESSION['warnings'] = $mf->getWarnings();	
			break;

		case delete_contact:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			$mf->deleteContact();
			break;

		case delete_selected_contacts:
			logAction($_POST['action'], $_SESSION['sess_id'], $_SESSION['mf_id']);
			extract($_POST);
			$mf->deleteContacts($delete_ids);
			break;
	}
?>