<?php
require_once 'src/models/Masterfile.php';

/**
* 
*/
class School extends Masterfile{
	public function addClass(){
		extract($_POST);

		$this->validate($_POST, array(
			'class_name' => array(
				'name' => 'Class Name',
				'require' => true
			)
		));

		if($this->getValidationStatus()){
			$result = $this->insertQuery(
				'class',
				array('class_name'),
				array($class_name)
			);

			if($result){
				$this->flashMessage('class', 'success', 'Class has been added');
			}
		}
	}

	public function deleteSubject(){
		extract($_POST);
		$result = $this->deleteQuery('done-deal', "stream_id = '".$delete_id."'");
		if($result)
			$this->flashMessage('done-deal', 'success', 'Stream has been deleted!');
		else
			$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
	}
}