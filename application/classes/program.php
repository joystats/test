<?php
class Program extends MX_Controller {
	public $member_id;
	public $member;
	
	public function __construct($member_id){
		parent::__construct();
		$this->member_id=$member_id;
		$this->setData();
	}
	public function setData(){
		$this->db->select('*')->from('tb_member')->where('member_id',$this->member_id);
		$result_member=$this->db->get()->row_array();
		$this->member=$result_member;
	}
	
	public function getListProgram(){
		$this->db->select('*')->from('tb_program');
		$this->db->like('program_owner',$this->member['license_code']);
		$this->db->or_like('program_use',$this->member['license_code']);
		$this->db->order_by('program_id','desc');
		$result=$this->db->get()->result_array();
		return $result;
	}
	function getProgram($id){
		$this->db->select('*');
		$this->db->from('tb_program');
		$this->db->where('program_id',$id);
		$result=$this->db->get();
		$data = $result->row(); 	
		return $data;
	}
	function getPeriod($id){
		$this->db->select('*');
		$this->db->from('tb_period');
		$this->db->where('program_id',$id);
		$this->db->order_by('period_start','asc');
		$result=$this->db->get()->result_array(); 	
		return $result;
	}
	
	function getCountPeriod_active($id){
		$this->db->select('*');
		$this->db->from('tb_period');
		$this->db->where('program_id',$id);
		$this->db->where('period_active','1');
		$query = $this->db->get();
		return $query->num_rows();
	}
	function getCountPeriod_inactive($id){
		$this->db->select('*');
		$this->db->from('tb_period');
		$this->db->where('program_id',$id);
		$this->db->where('period_active','0');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
}

?>