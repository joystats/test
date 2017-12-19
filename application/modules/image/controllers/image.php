<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends MX_Controller {
	public $rs=null;
	public $row=null;
	public $page_size_gallery=2;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this->load->model('member_model');
		$this->load->library('display');
	}
	
	function test(){
		echo 'Image module';
	}
	
	function getImageListByMemberId($member_fid=0){
		$this->db->select("*")->from("tb_image")->where("member_fid",$member_fid)->order_by("image_id","DESC");
		$result=$this->db->get()->result_array();
		return $result;
	}
	
	function getTotalImagePageByMemberId(){
		$member_fid=$this->input->post('member_fid');
		$this->db->select("count(*) total")->from("tb_image")->where("member_fid",$member_fid)->order_by("image_id","DESC");
		$row=$this->db->get()->row_array();
		$page=floor($row['total']/$this->page_size_gallery);
		if(($row%$this->page_size_gallery)!=0){
			$page+=1;
		}
		$data['total_page']=$page;
		echo json_encode($data);
	}
	function getImageByMemberId(){
		$start=($this->input->post('page')-1)*$this->page_size_gallery;
		$this->db->select("*")->from("tb_image")->where("member_fid",$this->input->post('member_fid'))->order_by("image_id","ASC")->limit($this->page_size_gallery,$start);
		$result=$this->db->get()->result_array();
		echo json_encode($result);
	}
}
