<?php
class Company extends MX_Controller {
	public $member_id;
	public $license_code;
	public $member;
	
	public function __construct($member_id=0)
	{
		parent::__construct();
		$this->member_id=$member_id;
		$this->setData();
	}
	public function setData(){
		$this->db->select('*')->from('tb_member')->where('member_id',$this->member_id);
		$result_member=$this->db->get()->row_array();
		$this->member=$result_member;
	}
	function getLicenseCode(){
		return $this->member['license_code'];
	}
	function getListBank(){
		$this->db->select('*')->from('tb_bank')->where('license_code',$this->getLicenseCode())->order_by('bank_id','ASC');
		$result_bank=$this->db->get()->result_array();
		return $result_bank;
	}

}

?>