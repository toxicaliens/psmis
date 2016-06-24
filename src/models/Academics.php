<?php
	include_once('src/models/Masterfile.php');

	class Academics extends Masterfile	{
		public function addSubject(){
			extract($_POST);

		$check = array(
			'subject_name' => array(
				'name' => 'Subject Name',
				'required' => true,
				'unique2' => 'subjects'
			),
			'subject_code' => array(
				'name' => 'Subject Code',
				'required' => true,
				'unique' => 'subjects'
			),
			'status' => array(
				'name' => 'Status',
				'numeric' => true
			)
		);

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->insertQuery(
					'subjects',
					array(
						'subject_name',
						'subject_code',
						'subject_status',
						'school_id'
						),
					array(
						sanitizeVariable($subject_name),
						sanitizeVariable($subject_code),
						sanitizeVariable($status),
						$_SESSION['school_id']
					)
				);

				if($result)
					$this->flashMessage('subjects', 'success', 'Subject has been added!');
				else
					$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
			}
		}

		public function editSubject(){
			extract($_POST);
			$check = [
				'subject_name' => [
					'name' => 'Subject Name',
					'required' => true,
					'unique2' => [
						'table' => 'subjects',
						'skip_column' => 'subject_id',
						'skip_value' => $edit_id
					]
				],
				'subject_code' => [
					'name' => 'Subject Code',
					'required' => true,
					'unique2' => 'subjects'
				],
				'status' => [
					'name' => 'Status',
					'required' => true,
					'numeric' => true
				]
			];

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->updateQuery(
					'subjects',
					"subject_name = '".sanitizeVariable($subject_name)."',
					subject_code = '".sanitizeVariable($subject_code)."',
					subject_status = '".sanitizeVariable($status)."'",
					"subject_id = '".sanitizeVariable($edit_id)."'"
				);
				if($result)
					$this->flashMessage('subjects', 'success', 'Subject has been updated!');
				else
					$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
			}
		}

		public function deleteSubject(){
			extract($_POST);
			$result = $this->deleteQuery('subjects', "subject_id = '".$delete_id."'");
			if($result)
				$this->flashMessage('subjects', 'success', 'Subject has been deleted!');
			else
				$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
		}

		public function deleteSubjects($delete_ids){
			if(!empty($delete_ids)){
				$delete_ids = rtrim($delete_ids, ', ');

				$result = $this->deleteQuery('subjects', "subject_id IN ($delete_ids)");
				if($result){
					$this->flashMessage('subjects', 'success', 'Subject(s) deleted successfully!');
				}else{
					$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
				}
			}else{
				$this->flashMessage('subjects', 'warning', 'You must select at least one record');
			}
		}
		
		public function loadFormsAndStreams(){
			$classes =$this->getAllClasses();
			$list = '<ul class="to_do">';
			
			if(count($classes)){
				foreach ($classes as $class){
					$list .= '<li><p>';
					$list .= ' <i class="fa fa-tag"></i> Class: <span style="color: red;">'.$class['class_name'].'</span></p></li>';
					$list .= $this->loadStreams($class['class_id']);
				}
			}
			
			$list .= '</ul>';
			
			return $list;
		}
		
		public function loadStreams($class_id){
			$streams = $this->getStreamsFromClass($class_id);
			$list = '<ul>';

			if(count($streams)){
				foreach ($streams as $stream){
					$list .= '<li><p class="stream"><input type="radio" class="flat" name="stream" value="'.$stream['class_stream_id'].'" required>'; 
					$list .=' Stream: <i class="fa fa-spinner"></i><span style="color: green"> '.$stream['stream_name'].'</span></p></li>';
				}
			}
			
			$list .= '</ul>';
			return $list;
		}
	}
?>
