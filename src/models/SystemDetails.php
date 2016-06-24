<?php
	include_once('src/models/Library.php');

	class SystemDetails extends Library
	{
		private $_sys_data = array();
		
		public function __construct(){
			$query = "SELECT * FROM system_details";
			if($result = run_query($query)){
				if(get_num_rows($result)){
					$this->_sys_data[] = get_row_data($result);
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public function getSysData(){
			return $this->_sys_data;
		}

		public function getSystemDetails(){
			$details = $this->selectQuery(
		 			'system_details', 
		 			'*',
		 			"setting_id = '".sanitizeVariable($setting_id)."'" 
		 		);
		 		// print_r($details); exit;	
			return $details;
		}

		public function exists(){
			$this->selectQuery('system_details', '*');
			$rows = $this->getRows();
			if(count($rows)){
				return true;
			}else{
				return false;
			}
		}

		public function addSystemDetails(){
			extract($_POST);

			$check = array(
				'setting_name' => array(
					'name' => 'Setting Name',
					'required' => true,
					'unique' => 'system_details'

				),
				'setting_code' => array(
					'name' => 'Setting Code',
					'required' => true,
					'unique' => 'system_details'
				),
				'setting_value' => array(
					'name' => 'Setting Value',
					'required' => true,
					'unique' => 'system_details'
				)
			);
		
			$this->validate($_POST, $check);
			// var_dump($this->getValidationStatus()); exit;
			if($this->getValidationStatus()){				
				$result = $this->insertQuery(
					'system_details', 
					array(
						'setting_name', 
						'setting_code',
						'setting_value'
						), 
					array(
						sanitizeVariable($setting_name), 
						sanitizeVariable($setting_code),
						sanitizeVariable($setting_value)
					)
				);

				if($result)
					$this->flashMessage('done-deal', 'success', 'System Details have been added!');
				else
					$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
			}
		}

		public function editSystemDetails(){
			extract($_POST);
			$check = array(
				'setting_name' => array(
					'name' => 'Setting Name',
					'required' => true,
					'unique' => 'system_details'
				),
				'setting_code' => array(
					'name' => 'Setting Code',
					'required' => true,
					'unique' => 'system_details'
				),
				'setting_value' => array(
					'name' => 'Setting Value',
					'required' => true,
					'unique' => 'system_details'
				)
			);

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->updateQuery(
					'system_details',
					"setting_name = '".sanitizeVariable($setting_name)."',
					setting_value = '".sanitizeVariable($setting_value)."',
					setting_code = '".sanitizeVariable($setting_code)."' "
				);
				if($result)
					$this->flashMessage('done-deal', 'success', 'System Detail has been updated!');
				else
					$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
			}
		}

		public function deleteSystemDetail(){
			extract($_POST);
			$result = $this->deleteQuery('system_details', "setting_id = '".$delete_id."'");
			if($result)
				$this->flashMessage('done-deal', 'success', 'System Setting has been deleted!');
			else
				$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
		}

		public function deleteSystemDetails($delete_ids){
			if(!empty($delete_ids)){
				$delete_ids = rtrim($delete_ids, ', ');

				$result = $this->deleteQuery('system_details', "setting_id IN ($delete_ids)");
				if($result){
					$this->flashMessage('done-deal', 'success', 'System Setting(s) deleted successfully!');
				}else{
					$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
				}
			}else{
				$this->flashMessage('done-deal', 'warning', 'You must select at least one record');
			}
		}
	}