<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MX_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
	}
	public function index()
	{
		$data['title']="Test";
		$this->load->view('index',$data);
	}
	public function login()
	{
		$data['title']="Login - TradeTabien";
		$this->load->view('login',$data);
	}
	public function register()
	{
		$data['title']="Register - TradeTabien";
		$this->load->view('register',$data);
	}
	public function error()
	{
		$data['title']="Page not found - TradeTabien";
		$this->load->view('error',$data);
	}
	
	function uploadImage(){
		if($this->session->userdata('member_fid')<=0){
			return false;
		}
		$path='uploads/'.$this->session->userdata('member_fid');
		$data['success']=0;
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		if($_FILES){
			foreach($_FILES['image']['name'] as $name => $value){
				$filename = explode(".",$_FILES['image']['name'][$name]);
				$allow_ext = array('png','jpg','jpeg');
				if(in_array($filename[1],$allow_ext)){
					$tmp_name=$_FILES['image']['tmp_name'][$name];
					$target=$path.'/'.md5(rand()).'.'.$filename[1];
					move_uploaded_file($tmp_name,$target);
					$pic['post_id']=$this->input->post('post_id');
					$pic['picture_path']=$target;
					$this->db->insert("tb_picture",$pic);
				}
			}
		}
	}
	public function random_number($length){
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	
	function getRealIpAddr(){
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

?>