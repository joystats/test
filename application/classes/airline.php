<?php
class Airline extends MX_Controller {
	public $member_id;
	public $license_code;
	public $member;
	
	public function __construct($member_id=0){
		parent::__construct();
		$this->member_id=$member_id;
		$this->setData();
	}
	public function setData(){
		$this->db->select('*')->from('tb_member')->where('member_id',$this->member_id);
		$result_member=$this->db->get()->row_array();
		$this->member=$result_member;
	}
	function getListAirline(){
		$this->db->select('*')->from('tb_airline')->order_by('airline_name','ASC');
		$result=$this->db->get()->result_array();
		return $result;
	}
}

?>