<?php
	include_once('src/models/Library.php');
	/**
	* 
	*/
	class Masterfile extends Library{
		private $_destination = '';
		
		public function __construct(){
			$this->_destination = 'images/profile_pics/';
		}
		
		public function addMasterfile($role){
			extract($_POST);
			
			$role = trim($role);
			if(!empty($role)){
				$role_data = $this->getRoleData($role);
				switch ($role_data['role_code']) {
					case Guardian:
						$this->validate($_POST, array(
								// step 1 personal details validation
								'role' => array(
									'name' => 'Role',
									'required' => true
								),
								'id_no' => array(
									'name' =>'ID Number.',
									'required' => true,
									'unique' => 'masterfile'
								),
								'reg_date' => array(
									'name' => 'Registration Date',
									'required' => true
								),
								'surname' => array(
									'name' => 'Surname',
									'required' => true
								),
								'fname' => array(
									'name' => 'First Name',
									'required' => true
								),
								'gender' => array(
									'name' => 'Gender',
									'required' => true
								),
								// step 2 Contact Details validation
								'phone_number' => array(
									'name' => 'Phone',
									'required' => true
								),
								// step 3 Login Details
								'username' => array(
									'name' => 'Username',
									'required' => true,
									'unique' => 'user_login'
								),
								'password' => array(
									'name' => 'Password',
									'required' => true,
									'min' => 6
								)
							)
						);
						$validation_status = $this->getValidationStatus();
						if($validation_status){
							$destination = $this->_destination.$_FILES['photo']['name'];
							$image_path = (!empty($_FILES['photo']['name'])) ? $this->uploadImage($_FILES['photo']['tmp_name'], $destination) : '';
							
							$mf_id = $this->insertMasterfile($surname, $fname, $mname, $gender, 'NULL', $id_no, $reg_date, 'NULL', $image_path, $role, 'NULL');
							
							if($mf_id){
								if($this->addContactDetails($phone_number, $email, $mf_id, Main)){
									$pass_hash = sha1($password);
									$user_role_id = $this->getUserRoleIdFromRoleCode(Guardian);
									if($this->createLoginAccount($username, $pass_hash, $email, '1', $user_role_id, $mf_id)){
										$this->flashMessage('masterfile', 'success', 'Mastefile has been created!');
									}else{
										$this->flashMessage('masterfile', 'error', 'Encountered an error while creating masterfile!');
									}
								}
							}
							
						}
						break;
						
					case Pupil:
						$this->validate($_POST, [
							// step 1 personal details validation
							'role' => array(
									'name' => 'Role',
									'required' => true
							),
							'id_no' => array(
									'name' =>'Admission Number.',
									'required' => true,
									'unique' => 'masterfile'
							),
							'dob' => array(
									'name' => 'Date of Birth',
									'required' => true
							),
							'reg_date' => array(
									'name' => 'Registration Date',
									'required' => true
							),
							'surname' => array(
									'name' => 'Surname',
									'required' => true
							),
							'fname' => array(
									'name' => 'First Name',
									'required' => true
							),
							'gender' => array(
									'name' => 'Gender',
									'required' => true
							),
							'guardian' => [
									'name' => 'Guardian',
									'required' => true
							],
							'class_id' => [
									'name' => 'Class',
									'required' => true
							],
							'stream_id'  => [
									'name' => 'Stream',
									'required' => true
							]
						]);
						
						if($this->getValidationStatus()){
							$destination = $this->_destination.$_FILES['photo']['name'];
							$image_path = (!empty($_FILES['photo']['name'])) ? $this->uploadImage($_FILES['photo']['tmp_name'], $destination) : '';
							
							if($this->insertMasterfile($surname, $fname, $mname, $gender, $guardian, $id_no, $reg_date, $dob, $image_path, $role,'NULL', $class_id, $stream_id)){
								$this->flashMessage('masterfile', 'success', 'Masterfile has been created');
							}else{
								$this->flashMessage('masterfile', 'error', 'Encountered an error while created the masterfile!');
							}
						}
						break;
						
						case Teacher:
							$this->validate($_POST, array(
									// step 1 personal details validation
									'role' => array(
									'name' => 'Role',
									'required' => true
									),
									'id_no' => array(
									'name' =>'ID Number.',
									'required' => true,
									'unique' => 'masterfile'
									),
									'title' => array(
										'name' => 'Title',
										'required' => true
									),
									'reg_date' => array(
									'name' => 'Registration Date',
									'required' => true
									),
									'surname' => array(
									'name' => 'Surname',
									'required' => true
									),
									'fname' => array(
									'name' => 'First Name',
									'required' => true
									),
									'gender' => array(
									'name' => 'Gender',
									'required' => true
									),
									// step 2 Contact Details validation
									'phone_number' => array(
									'name' => 'Phone',
									'required' => true
									),
									// step 3 Login Details
									'username' => array(
										'name' => 'Username',
										'required' => true,
										'unique' => 'user_login'
									),
									'password' => array(
											'name' => 'Password',
											'required' => true,
											'min' => 6
									),
									'title' => [
											'name' => 'Title',
											'required' => true
									]
								)
							);
							
							$validation_status = $this->getValidationStatus();
							if($validation_status){
								$destination = $this->_destination.$_FILES['photo']['name'];
								$image_path = (!empty($_FILES['photo']['name'])) ? $this->uploadImage($_FILES['photo']['tmp_name'], $destination) : '';
									
								$mf_id = $this->insertMasterfile($surname, $fname, $mname, $gender, 'NULL', $id_no, $reg_date, $dob, $image_path, $role, $title);
									
								if($mf_id){
									if($this->addContactDetails($phone_number, $email, $mf_id, Main)){
										// create login account
										$pass_hash = sha1($password);
										$user_role_id = $this->getUserRoleIdFromRoleCode(Guardian);
										if($this->createLoginAccount($username, $pass_hash, $email, '1', $user_role_id, $mf_id)){
											$this->flashMessage('masterfile', 'success', 'Mastefile has been created!');
										}else{
											$this->flashMessage('masterfile', 'error', 'Encountered an error while creating masterfile!');
										}
									}
								}
									
							}
							break;
							
							case Subordinate:
								$this->validate($_POST, array(
								// step 1 personal details validation
								'role' => array(
								'name' => 'Role',
								'required' => true
								),
								'id_no' => array(
								'name' =>'ID Number.',
								'required' => true,
								'unique' => 'masterfile'
										),
										'title' => array(
										'name' => 'Title',
										'required' => true
										),
										'reg_date' => array(
										'name' => 'Registration Date',
										'required' => true
										),
										'surname' => array(
										'name' => 'Surname',
										'required' => true
										),
										'fname' => array(
										'name' => 'First Name',
										'required' => true
										),
										'gender' => array(
										'name' => 'Gender',
										'required' => true
										),
										// step 2 Contact Details validation
										'phone_number' => array(
										'name' => 'Phone',
										'required' => true
										),
										// step 3 Login Details
										'username' => array(
										'name' => 'Username',
										'required' => true,
										'unique' => 'user_login'
												),
												'password' => array(
												'name' => 'Password',
												'required' => true,
												'min' => 6
												)
												)
								);
								$validation_status = $this->getValidationStatus();
								if($validation_status){
									$destination = $this->_destination.$_FILES['photo']['name'];
									$image_path = (!empty($_FILES['photo']['name'])) ? $this->uploadImage($_FILES['photo']['tmp_name'], $destination) : '';
										
									$mf_id = $this->insertMasterfile($surname, $fname, $mname, $gender, 'NULL', $id_no, $reg_date, $dob, $image_path, $role, $title);
										
									if($mf_id){
										if($this->addContactDetails($phone_number, $email, $mf_id, Main)){
											// create login account
											$pass_hash = sha1($password);
											$user_role_id = $this->getUserRoleIdFromRoleCode(Guardian);
											if($this->createLoginAccount($username, $pass_hash, $email, '1', $user_role_id, $mf_id)){
												$this->flashMessage('masterfile', 'success', 'Mastefile has been created!');
											}else{
												$this->flashMessage('masterfile', 'error', 'Encountered an error while creating masterfile!');
											}
										}
									}
										
								}
								break;
				}
			}else{
				$this->flashMessage('masterfile', 'warning', 'You must select a role!');
			}
		}

		public function insertMasterfile($surname, $fname, $mname, $gender, $guardian, $id_no, $reg_date, $dob, $image_path = '', 
				$role_id, $title_id ='NULL', $class_id = 'NULL', $stream_id='NULL'){
// 			var_dump($role_id);
			$result = $this->insertQuery(
				'masterfile', 
				[
					'surname', 
					'firstname', 
					'middlename', 
					'gender', 
					'school_id', 
					'gurdian_mf_id', 
	            	'id_no', 
	            	'reg_date', 
					'dob',
	            	'image_path', 
	            	'role_id',
					'title_id',
					'class_id',
					'stream_id'
            	],
            	[
            		$surname,
            		$fname,
            		$mname,
            		$gender,
            		$_SESSION['school_id'],
            		$guardian,
            		$id_no,
            		$reg_date,
            		$dob,
            		$image_path,
            		$role_id,
            		$title_id,
            		$class_id,
            		$stream_id
            	],
            	'mf_id'
            );
            if($result){
            	return $result['mf_id'];
            }else{
            	return false;
            }
		}

		public function getAllRoles(){
			$rows = $this->selectQuery(
				'role',
				'*'
			);
			return $rows;
		}

		public function getAllCounties(){
			$rows = $this->selectQuery(
				'county',
				'*',
				'county_status IS TRUE'
			);
			return $rows;
		}

		public function getAllGuardians(){
			$return = array();
			$query = "SELECT CONCAT(m.surname,' ',m.firstname,' ',m.middlename) AS guardian_name, * FROM masterfile m
			LEFT JOIN role r ON r.role_id = m.role_id
			WHERE role_code = '".Guardian."'";
			if($result = run_query($query)){
				if(get_num_rows($result)){
					while ($rows = get_row_data($result)) {
						$return[] = $rows;
 					}
 					return $return;
				}
			}
		}

		public function getAllClasses(){
			$rows = $this->selectQuery(
				'class',
				'*',
				"school_id = '".$_SESSION['school_id']."'"
			);
			return $rows;
		}

		public function getAllAdressTypes(){
			$rows = $this->selectQuery(
				'address_types',
				'*'
			);
			return $rows;
		}

		public function getRoleData($role_id){
			$rows = $this->selectQuery(
				'role',
				array('role_code'),
				'role_id = '.$role_id
			);
			return $rows[0];
		}

		public function deleteContacts($delete_ids){
			if(!empty($delete_ids)){
				$delete_ids = rtrim($delete_ids, ', ');

				$result = $this->deleteQuery('contact_types', "contact_type_id IN ($delete_ids)");
				if($result){
					$this->flashMessage('masterfile', 'success', 'Contact Type(s) deleted successfully!');
				}else{
					$this->flashMessage('masterfile', 'error', 'Encountered an error! '.get_last_error());
				}
			}else{
				$this->flashMessage('masterfile', 'warning', 'You must select at least one record');
			}
		}

		public function deleteContact(){
			extract($_POST);
			$result = $this->deleteQuery('contact_types', "contact_type_id = '".$delete_id."'");
			if($result)
				$this->flashMessage('masterfile', 'success', 'Contact Type has been deleted!');
			else
				$this->flashMessage('masterfile', 'error', 'Encountered an error! '.get_last_error());
		}

		public function editContact(){
			extract($_POST);
			$check = array(
				'contact_type_name' => array(
					'name' => 'contact_type_name',
					'required' => true,
					'unique' => 'contact_types'
				),
				'contact_type_code' => array(
					'name' => 'contact_type_code',
					'required' => true,
					'unique' => 'contact_types'
				),
				'status' => array(
					'name' => 'Status',
					'numeric' => true
				)
			);

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->updateQuery(
					'contact_types',
					"contact_type_name = '".sanitizeVariable($contact_type_name)."',
					contact_type_code = '".sanitizeVariable($contact_type_code)."',
					status = '".sanitizeVariable($status)."'",
					"contact_type_id = '".sanitizeVariable($edit_id)."'"
				);
				if($result)
					$this->flashMessage('masterfile', 'success', 'Contact Type has been updated!');
				else
					$this->flashMessage('masterfile', 'warcming', 'The Contact Type is In Use, You cant delete it! ');
			}
		}

		public function addContact(){
			extract($_POST);

		$check = array(
			'contact_type_name' => array(
				'name' => 'contact_type_name',
				'required' => true,
				'unique2' => 'contact_types'
			),
			'contact_type_code' => array(
				'name' => 'contact_type_code',
				'required' => true,
				'unique' => 'contact_types'
			),
			'status' => array(
				'name' => 'Status',
				'numeric' => true
			)
		);

			$this->validate($_POST, $check);
			if($this->getValidationStatus()){
				$result = $this->insertQuery(
					'contact_types',
					array(
						'contact_type_name',
						'contact_type_code',
						'status',
						'school_id'
						),
					array(
						sanitizeVariable($contact_type_name),
						sanitizeVariable($contact_type_code),
						sanitizeVariable($status),
						$_SESSION['school_id']
					)
				);
				// var_dump($result);exit;
				if($result)
					$this->flashMessage('masterfile', 'success', 'Contact Type has been added!');
				else
					$this->flashMessage('masterfile', 'error', 'Encountered an error! '.get_last_error());
			}
		}
		
		public function createLoginAccount($username, $password, $email, $user_active, $user_role, $mf_id){
			$result = $this->insertQuery(
					'user_login2', 
					[
							'username',
							'password',
							'email',
							'user_active',
							'user_role',
							'mf_id',
							'school_id'
					],
					[
							$username,
							$password,
							$email,
							$user_active,
							$user_role,
							$mf_id,
							$_SESSION['school_id']
					]);
			if($result)	
				// send email if available
				// $this->sendEmail();
				return true;
			else 
				return false;
		}
		
		public function getRoleCodeFromId($role_id){
			$query = "SELECT role_code FROM role WHERE role_id = '".$role_id."'";
			if($result  = run_query($query)){
				$rows = get_row_data($result);
				return $rows['role_code'];
			}
		}
		
		public function getUserRoleIdFromRoleCode($role_code){
			$data = $this->selectQuery('user_roles', 'role_id', "role_name = '".sanitizeVariable($role_code)."'");
			return $data[0]['role_id'];
		}
		
		public function getAllTitles(){
			$data = $this->selectQuery('title', 'title_name, title_id');
			return $data;
		}
		
		public function geAllMasterfiles(){
			$data = $this->selectQuery('masterfile_contacts_roles', '*', "surname != 'Admin'");
			return $data;
		}
		
		public function addContactDetails($phone, $email, $mf_id, $type_code){
			$result = $this->insertQuery(
					'contact',
					[
							'contact_phone_no',
							'contact_email',
							'mf_id',
							'contact_type_id'
					],
					[
							$phone,
							$email,
							$mf_id,
							$this->getContactTypeIdFromTypeCode($type_code)
					]
			);
			if($result)
				return true;
			else
				return false;
		}
		
		public function getContactTypeIdFromTypeCode($type_code){
			$data = $this->selectQuery('contact_types', 'contact_type_id', "contact_type_code = '".sanitizeVariable($type_code)."'");
// 			var_dump($data);exit;
			return $data[0]['contact_type_id'];
		}
		
		public function getStreamsFromClass($class_id){
			$data = $this->selectQuery('school_classes_and_streams', '*', "form_id = '".sanitizeVariable($class_id)."' AND school_id = '".$_SESSION['school_id']."'");
			return $data;
		}
		
		public function getAllTeachers(){
			$data = $this->selectQuery('masterfile','mf_id, surname, firstname, middlename', "role_id = '".$this->getRoleIdFromRoleCode(Teacher)."'" );
			return $data;
		}
		
		public function getRoleIdFromRoleCode($role_code){
			$data = $this->selectQuery('role', 'role_id', "role_code = '".$role_code."'");
			return $data[0]['role_id'];
		}
	}
?>





















