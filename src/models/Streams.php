<?php

require_once 'src/models/Library.php';

/**
* 
*/
class Streams extends Library{
	
	private $_sys_data = array();
		
	public function __construct(){
		$query = "SELECT * FROM stream";
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

	public function getAllStreams(){
		$rows = $this->selectQuery(
			'stream',
			'*'
		);
		return $rows;
	}

	public function getSysData(){
		return $this->_sys_data;
	}

	public function addStream(){
		extract($_POST);

		$check = array(
			'stream_name' => array(
				'name' => 'Stream Name',
				'required' => true,
				'unique' => 'stream'
			),
			'stream_code' => array(
				'name' => 'Stream Code',
				'required' => true,
				'unique' => 'stream'
			),
			'status' => array(
				'name' => 'Status',
				'numeric' => true
			)
		);

		$this->validate($_POST, $check);
		if($this->getValidationStatus()){
			$this->insertStream($stream_name, $stream_code, $status);

			//var_dump($result);die();
			if($result)
				$this->flashMessage('done-deal', 'success', 'Stream has been added!');
			else
				$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
		}
	}

	public function editStream(){
		extract($_POST);
		$check = [
			'stream_name' => [
				'name' => 'Stream Name',
				'required' => true,
				'unique2' => 'stream'
			],
			'stream_code' => [
				'name' => 'Stream Code',
				'required' => true,
				'unique2' => 'stream'
			],
			'status' => [
				'name' => 'Status',
				'numeric' => true
			]
		];

		$this->validate($_POST, $check);
		if($this->getValidationStatus()){
			$result = $this->updateQuery(
				'stream',
				[
					'stream_name',
					'stream_code',
					'stream_status',
					'stream_id'
				],
				[
					sanitizeVariable($stream_name),
					sanitizeVariable($stream_code),
					sanitizeVariable($status),
					$_SESSION['stream_id']
				]
			);
			if($result)
				$this->flashMessage('done-deal', 'success', 'System Detail has been updated!');
			else
				$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
		}
	}

	public function deleteStream(){
		extract($_POST);
		$result = $this->deleteQuery('stream', "stream_id = '".$delete_id."'");
		if($result)
			$this->flashMessage('done-deal', 'success', 'Stream has been deleted!');
		else
			$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
	}

	public function deleteSelectedStreams($delete_ids){
		if(!empty($delete_ids)){
			$delete_ids = rtrim($delete_ids, ', ');

			$result = $this->deleteQuery('stream', "stream_id IN ($delete_ids)");
			if($result){
				$this->flashMessage('done-deal', 'success', 'School Streams(s) deleted successfully!');
			}else{
				$this->flashMessage('done-deal', 'error', 'Encountered an error! '.get_last_error());
			}
		}else{
			$this->flashMessage('done-deal', 'warning', 'You must select at least one record');
		}
	}

	public function insertStream($stream_name, $stream_code, $status){
		$result = $this->insertQuery(
			'stream', 
			[
				'stream_name', 
				'stream_code', 
				'stream_status',
				'school_id'
				], 
			[
				sanitizeVariable($stream_name), 
				sanitizeVariable($stream_code), 
				sanitizeVariable($status),
				$_SESSION['school_id']
			],
			'stream_id'
		);
		if($result){
        	return $result['stream_id'];
        }else{
        	return false;
    	}

    	if($stream_id){
    		$query = $this->insertQuery(
    			'class_stream_allocation',
    			[
    				'class_id',
    				'stream_id',
    				'school_id'
    				],
    			[
    				sanitizeVariable($class_id),
    			]
    			);
			if($this->addClassStreamAllocation($class_id, $stream_id, $school_id )){

			}
		}
	}

}