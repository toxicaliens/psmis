<?php

require_once 'src/models/Academics.php';

/**
* 
*/
class Exams extends Academics
{
	public function addSubjectGrade(){
			extract($_POST);

			$check = array(
				'subject_id' => array(
					'name' => 'Subject',
					'required' => true,
				),
				'form' => array(
					'name' => 'form',
					'required' => true,
				),
				'points' => array(
					'name' => 'points',
					'required' => true,
					'numeric' => true
				),
				'min' => array(
					'name' => 'min',
					'required' => true,
					'numeric' => true
				),
				'max' => array(
					'name' => 'max',
					'required' => true,
					'numeric' => true
				)
			);

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->insertQuery(
					'grading', 
					array(
						'min', 
						'max', 
						'points',
						'form',
						'subject_id',
						'school_id'
						), 
					array(
						sanitizeVariable($min), 
						sanitizeVariable($max), 
						sanitizeVariable($points),
						sanitizeVariable($form),
						sanitizeVariable($subject_id),
						$_SESSION['school_id']
					)
				);

				if($result)
					$this->flashMessage('subjects', 'success', 'Subject  Grade has been added!');
				else
					$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
			}
	}

	public function EditSubjectGrade(){
			extract($_POST);

			$check = array(
				'subject_id' => array(
					'name' => 'Subject',
					'required' => true,
				),
				'form' => array(
					'name' => 'form',
					'required' => true,
				),
				'points' => array(
					'name' => 'points',
					'required' => true,
					'numeric' => true
				),
				'min' => array(
					'name' => 'min',
					'required' => true,
					'numeric' => true
				),
				'max' => array(
					'name' => 'max',
					'required' => true,
					'numeric' => true
				)
			);

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->updateQuery(
					'grading', 
					array(
						'min', 
						'max', 
						'points',
						'form',
						'subject_id',
						'grading_id'
						), 
					array(
						sanitizeVariable($min), 
						sanitizeVariable($max), 
						sanitizeVariable($points),
						sanitizeVariable($form),
						sanitizeVariable($subject_id),
						sanitizeVariable($edit_id)
						
					)
				);

				if($result)
					$this->flashMessage('subjects', 'success', 'Subject  Grade has been Updated!');
				else
					$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
			}
	}

	public function deleteSubject(){
			extract($_POST);
			$result = $this->deleteQuery('grading', "grading_id = '".$delete_id."'");
			if($result)
				$this->flashMessage('subjects', 'success', 'Subject Grade has been deleted!');
			else
				$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
	}

	public function addOverallGrade(){
			extract($_POST);

			$check = array(
				'form' => array(
					'name' => 'form',
					'required' => true,
				),
				'grade' => array(
					'name' => 'grade',
					'required' => true,
				),
				'min' => array(
					'name' => 'min',
					'required' => true,
					'numeric' => true
				),
				'max' => array(
					'name' => 'max',
					'required' => true,
					'numeric' => true
				)
			);

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->insertQuery(
					'overall_grading', 
					array(
						'min', 
						'max', 
						'grade',
						'form',
						'school_id'
						), 
					array(
						sanitizeVariable($min), 
						sanitizeVariable($max), 
						sanitizeVariable($grade),
						sanitizeVariable($form),
						$_SESSION['school_id']
					)
				);

				if($result)
					$this->flashMessage('subjects', 'success', 'Overall  Grade has been added!');
				else
					$this->flashMessage('subjects', 'error', 'Encountered an error! '.get_last_error());
			}
	}
}
