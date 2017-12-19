<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MX_Controller {
	public $member_id=0;
	public $member_fid=0;
	public $member_name=null;
	public $member_email=null;
	public $rs=null;
	public $row=null;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this->load->model('member_model');
		$this->load->library('display');
	}
	
	function test(){
		echo 'member module';
	}
	
	function login(){
		if($this->isMember($this->input->post('member_fid'))){
			$this->setSession($this->input->post('member_fid'));
			$data['success']=1;
			echo json_encode($data);
		}else{
			 $this->register_facebook();
		}
		
	}
	
	function login_email(){
		$data['success']=0;
		$this->db->select('member_fid')->from('tb_member')->where('member_email',$this->input->post('member_email'))->where("member_password",md5($this->input->post('member_password')));
		$query=$this->db->get();
		$num=$query->num_rows();
		if($num>0){
			$row=$query->row_array();
			$this->setSession($row['member_fid']);
			$data['success']=1;
		}
		echo json_encode($data);
	}
	
	function logout(){
		$data['success']=1;
		$this->session->unset_userdata('member_fid');
		echo json_encode($data);
	}

	function register_email(){
		$data['success']=0;
		if(!$this->isAlreadyEmail($this->input->post('member_email'))){
			$fid=time();
			$ins['member_fid']=$fid;
			$ins['member_name']='Member'.rand(10000,99999);
			$ins['member_email']=$this->input->post('member_email');
			$ins['member_password']=md5($this->input->post('member_password'));
			$ins['created']=date('Y-m-d H:i:s');
			$this->db->insert("tb_member",$ins);
			if($this->db->insert_id()>0){
				$data['success']=2;
				$this->setSession($fid);
			}
		}else{
			$data['success']=1;
		}
		
		echo json_encode($data);
	}
	
	function register_facebook(){
		$data['success']=0;
		$ins['member_fid']=$this->input->post('member_fid');
		$ins['member_name']=$this->input->post('member_name');
		$ins['member_email']=$this->input->post('member_email');
		$ins['created']=date('Y-m-d H:i:s');
		$this->db->insert("tb_member",$ins);
		if($this->db->insert_id()>0){
			$data['success']=1;
			$this->setSession($this->input->post('member_fid'));
		}
		echo json_encode($data);
	}
	
	function send_email($ins){
		$this->setMember($ins['member_fid']);
		$admin_email=$this->backend->getAdminEmail();
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.tradetabien.com',
			'smtp_port' => 587,//587,25,26
			'smtp_user' => 'test@tradetabien.com',
			'smtp_pass' => '1234',
			'mailtype'  => 'html'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->set_mailtype("html");
		$this->email->from('MAIL-ROBOT@tradetabien.com', 'MAIL-ROBOT');
		$mail_to=array_filter(array($admin_email));
		$this->email->to($mail_to);
		$this->email->subject('แจ้งโอนเงิน '.$ins['payment_tag_number'].' '.$ins['payment_tag_province']);
		
		$message='<strong><u>แจ้งโอนเงิน</u></strong>';
		$message .= '<br/>เลขทะเบียน : '.$ins['payment_tag_number'];
		$message .= '<br/>ทะเบียนจังหวัด : '.$ins['payment_tag_province'];
		$message .= '<br/>ยอดโอน : '.$ins['payment_amount'];
		$message .= '<br/>ธนาคารต้นทาง : '.$ins['payment_from_bank'];
		$message .= '<br/>โอนเข้าธนาคาร : '.$ins['payment_to_bank'];
		$message .= '<br/>วัน-เวลาโอน : '.$ins['payment_datetime'];
		$message .= '<br/>ผู้แจ้ง : '.$this->getMemberName();
		$message .= '<br/>อีเมล์ : '.$this->getMemberEmail();
		$message .= '<br/>เบอร์โทร : '.$this->getMemberMobile();
		$message .= '<br/><br/><strong>TradeTabien.com</strong><br/>';
		$message .= $this->backend->getAdminAddress().'<br/>';
		$message .= $this->backend->getAdminTelephone();
		
		$this->email->message($message);	
		$this->email->send();
	}
	
	function isLogin(){
		if($this->session->userdata('member_fid')>0){
			return true;
		}else{
			return false;
		}
	}
	
	function setSession($member_fid=0){
		$sess['member_fid']=$member_fid;
		$this->session->set_userdata($sess);
	}
	
	function isMember($member_fid=0){
		$this->db->select('member_fid')->from('tb_member')->where('member_fid',$member_fid);
		$query=$this->db->get();
		$num=$query->num_rows();
		if($num>0){
			return true;
		}else{
			return false;
		}
	}
	
	function setMember($member_fid=0){
		$this->member_fid=$member_fid;
		$this->db->select('*')->from('tb_member')->where('member_fid',$member_fid)->where('member_active',1);
		$row=$this->db->get()->row_array();
		$this->row=$row;
	}
	
	function getMemberFid(){
		return $this->row['member_fid'];
	}
	
	function getMemberName(){
		return $this->row['member_name'];
	}
	
	function getMemberEmail(){
		return $this->row['member_email'];
	}
	
	function getMemberMobile(){
		return $this->row['member_mobile'];
	}
	
	function getMemberAddress(){
		return $this->row['member_address'];
	}
	
	function getMemberLevel(){
		return $this->row['member_level'];
	}
	
	function getMemberCreated(){
		return $this->row['created'];
	}
	function fullViewMember(){
		$this->db->select("member_fid")->from("tb_member")->where("member_fid",$this->input->post('member_fid'));
		$row=$this->db->get()->row_array();
		$this->setMember($row['member_fid']);
		$getMemberName=$this->getMemberName();
		$getMemberEmail=($this->getMemberEmail()!="")?$this->getMemberEmail():'-';
		$getMemberMobile=($this->getMemberMobile()!="")?$this->getMemberMobile():'-';
		$getMemberAddress=($this->getMemberAddress()!="")?$this->getMemberAddress():'-';
		$getMemberCreated=$this->display->thaidate($this->getMemberCreated());
		$table = <<<EOF
			<table>
						<tr>
							<td>ชื่อ</td>
							<td>$getMemberName</td>
						</tr>
						<tr>
							<td>อีเมล์</td>
							<td>$getMemberEmail</td>
						</tr>
						<tr>
							<td>เบอร์โทร</td>
							<td>$getMemberMobile</td>
						</tr>
						<tr>
							<td>ที่อยู่</td>
							<td>$getMemberAddress</td>
						</tr>
						<tr>
							<td>วันที่สมัคร</td>
							<td>$getMemberCreated</td>
						</tr>
					<table>
EOF;
		echo $table;
	}
	
	function getMemberLists(){
		$this->db->select("member_fid")->from("tb_member")->where("member_active",1)->order_by("member_fid","DESC");
		$result=$this->db->get()->result_array();
		return $result;
	}
}
