<?php
class Province extends MX_Controller {
	public $user_id;
	public $member;
	
	public function __construct()
	{
		parent::__construct();
	}
	public function setData(){
		$this->db->select('*')->from('tb_member')->where('member_id',$this->user_id);
		$result_member=$this->db->get()->row_array();
		$this->member=$result_member;
	}
	function getProvince(){
		$this->db->select('*')->from('tb_province')->order_by('PROVINCE_NAME','ASC');
		$rs_province=$this->db->get()->result_array();
		return $rs_province;
	}

}

?>