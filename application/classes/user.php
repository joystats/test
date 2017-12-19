<?php
class User extends MX_Controller {
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
	function getUsername(){
		return $this->member['member_username'];
	}
	function getMemberFirstName(){
		return $this->member['member_firstname'];
	}
	function getMemberLastName(){
		return $this->member['member_lastname'];
	}
	function getMemberNickName(){
		return $this->member['member_nickname'];
	}
	function getUsernameLink(){
		$name=$this->member['member_firstname'];
		if($this->member['member_lastname']!=""){
			$name.=" ".$this->member['member_lastname'];
		}
		if($this->member['member_nickname']!=""){
			$name.=" (".$this->member['member_nickname'].")";
		}
		return "<a href='users/profile_setting/".$this->member['member_id']."'>".$name."</a>";
	}
	function getMemberEmail(){
		return $this->member['member_email'];
	}
	function getMemberMobile(){
		return $this->member['member_mobile'];
	}
	function getMemberJoined(){
		return $this->member['member_joined'];
	}
	function getMemberLastLogin(){
		return $this->member['member_lastlogin'];
	}
	function getMemberCreated(){
		if($this->member['member_created']<=0){
			return false;
		}
		$this->db->select('*')->from('tb_member')->where('member_id',$this->member['member_created']);
		$result=$this->db->get()->row_array();
		return $result['member_username'];
	}
	function getMemberStartDate(){
		return $this->member['member_startdate'];
	}
	function getMemberEndDate(){
		return $this->member['member_enddate'];
	}
	function getMemberIsAdmin(){
		return $this->member['is_admin'];
	}
	function getMemberActive(){
		return $this->member['member_active'];
	}
	function getMemberActiveName(){
		if($this->member['member_active']>0){
			return "<span class='color_green'>Yes</span>";
		}else{
			return "No";
		}
	}
	function getLicenseCode(){
		return $this->member['license_code'];
	}
	function getAllUserList(){
		$this->db->select('*')->from('tb_member')->where('license_code',$this->getLicenseCode())->where('member_delete','0');
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->result_array();
		}
	}
	
	function is_allow($member_id){
		if($member_id==$this->session->userdata('member_id') || $this->session->userdata('is_admin')>0){
			return true;
		}else{
			return false;
		}
	}
	function is_admin($member_id){
		$this->db->select('is_admin')->from('tb_member')->where('member_id',$member_id);
		$result=$this->db->get()->row_array();
		if($result['is_admin']>0){
			return true;
		}else{
			return false;
		}
	}
	function is_active($member_id){
		$this->db->select('is_admin')->from('tb_member')->where('member_id',$member_id);
		$result=$this->db->get()->row_array();
		if($result['is_admin']>0){
			return true;
		}else{
			return false;
		}
	}
	function getMaxUser(){
		$this->db->select('setting_value')->from('tb_setting')->where('setting_name','max_user')->where('license_code',$this->getLicenseCode());
		$rs_get=$this->db->get();
		if($rs_get->num_rows()>0){
			$rs=$rs_get->row_array();
			return $rs['setting_value'];
		}	
	}
	
	function countBooking(){
		$this->db->select('count(booking_id) as total_booking')->from('tb_booking')->where('member_id',$this->user_id)->where('booking_online',1)->where('license_code',$this->getLicenseCode());
		$rs_get=$this->db->get();
		if($rs_get->num_rows()>0){
			$rs=$rs_get->row_array();
			return $rs['total_booking'];
		}
	}

}

?>