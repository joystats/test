<?php
class Customer extends MX_Controller {
	public $user_id;
	public $member;
	
	public function __construct($user_id=0)
	{
		parent::__construct();
		$this->user_id=$user_id;
		$this->setData();
	}
	public function setData(){
		$this->db->select('*')->from('tb_member')->where('member_id',$this->user_id);
		$result_member=$this->db->get()->row_array();
		$this->member=$result_member;
	}
	function getMemberId(){
		return $this->user_id;
	}
	function test(){
		echo 1;
	}
}

?>