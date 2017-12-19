<?php
class Wholesale extends MX_Controller {
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
	function getListWholesale(){
		$this->db->select('*')->from('tb_wholesale')->order_by('wholesale_name','ASC');
		$result=$this->db->get()->result_array();
		return $result;
	}
	function getWholesale($id){
		$this->db->select('*')->from('tb_wholesale')->where('wholesale_id',$id)->order_by('wholesale_name','ASC');
		$result=$this->db->get();
		$data = $result->row(); 	
		return $data;
	}
}

?>