<?php
$this->load->view('header');
if($this->session->userdata('member_fid')>0){
	header('Location:'.base_url());
}
?>
<div class="container">
	<div class="row row_head">
		<div class="col-md-12">
			<h1 class="font-medium font-kanit">เข้าสู่ระบบ</h1>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<p>เข้าสู่ระบบด้วย Facebook หรือ อีเมล์ของคุณ</p>
				<div class="margin-top">
					<button type="button" class="btn btn-primary" onclick="login()"><i class="fa fa-facebook-official"></i> เข้าสู่ระบบด้วย Facebook</button>
				</div>
				<p class="title-hr-section"><span class="white-bg">หรือ</span></p>
				<div class="row register_email text-center">
					<ul class="list-inline">
						<li>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">ใส่อีเมล์</span>
								<input type="text" id="email" class="form-control" placeholder="Email">
							</div>
						</li>
						<li>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">รหัสผ่าน</span>
								<input type="password" id="password" class="form-control" placeholder="password">
							</div>
						</li>
					</ul>
					<div class="margin-top-small">
						<button type="button" class="btn btn-info" id="btn_login" onclick="login_email()">เข้าสู่ระบบด้วยอีเมล์</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('footer');
?>