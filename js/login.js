function register(){
	var email = $("#email").val();
	var member_password = $("#password").val();
	if(email.trim()==''){
		alert('กรุณากรอกอีเมล์ที่ใช้งานจริง');
		$("#email").focus();
		return;
	}
	if(member_password.trim()==''){
		alert('กรุณากรอกรหัสผ่าน');
		$("#password").focus();
		return;
	}
	$.ajax({
		url:base_url+'member/register_email',
		type:'POST',
		data:{member_email:email.trim(),member_password:member_password.trim()},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#btn_register").attr("disabled",true);
		},success:function(data){
			if(data.success==0){
				alert('กรุณาลองใหม่อีกครั้ง');
				$("#email").focus();
			}else if(data.success==1){
				alert('อีเมล์นี้มีผู้ใช้แล้ว');
				$("#email").focus();
			}else{
				alert('สมัครสมาชิกเรียบร้อยแล้ว');
				window.location=base_url+'profile';
			}
			$("#btn_register").attr("disabled",false);
		}
	})
}

function login_email(){
	var email = $("#email").val();
	var member_password = $("#password").val();
	if(email.trim()==''){
		alert('กรุณากรอกอีเมล์');
		$("#email").focus();
		return;
	}
	if(member_password.trim()==''){
		alert('กรุณากรอกรหัสผ่าน');
		$("#password").focus();
		return;
	}
	$.ajax({
		url:base_url+'member/login_email',
		type:'POST',
		data:{member_email:email.trim(),member_password:member_password.trim()},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#btn_login").attr("disabled",true);
		},success:function(data){
			if(data.success==0){
				alert('อีเมล์หรือรหัสผ่านไม่ถูกต้อง');
				$("#password").focus();
			}else{
				window.location=base_url+'profile';
			}
			$("#btn_login").attr("disabled",false);
		}
	})
}

function submit_confirm_payment(){
	var payment_tag_number = $("#payment_tag_number").val();
	var payment_tag_province = $("#payment_tag_province").val();
	var payment_amount = $("#payment_amount").val();
	var payment_from_bank = $("#payment_from_bank").val();
	var payment_to_bank = $("#payment_to_bank").val();
	var payment_datetime = $("#payment_datetime").val();
	if(payment_tag_number.trim()==''){
		alert('กรุณากรอกเลขทะเบียน');
		$("#payment_tag_number").focus();
		return;
	}
	if(payment_tag_province.trim()==''){
		alert('กรุณากรอกทะเบียนจังหวัด');
		$("#payment_tag_province").focus();
		return;
	}
	if(payment_amount.trim()==''){
		alert('กรุณากรอกยอดโอน');
		$("#payment_amount").focus();
		return;
	}
	if(payment_from_bank.trim()==''){
		alert('กรุณากรอกธนาคารต้นทาง');
		$("#payment_from_bank").focus();
		return;
	}
	if(payment_to_bank.trim()==''){
		alert('กรุณากรอกโอนเข้าธนาคาร');
		$("#payment_to_bank").focus();
		return;
	}
	if(payment_datetime.trim()==''){
		alert('วัน-เวลาโอน');
		$("#payment_datetime").focus();
		return;
	}
	$.ajax({
		url:base_url+'member/confirmPayment',
		type:'POST',
		data:{payment_tag_number:payment_tag_number.trim(),payment_tag_province:payment_tag_province.trim(),payment_amount:payment_amount.trim(),payment_from_bank:payment_from_bank.trim(),payment_to_bank:payment_to_bank.trim(),payment_datetime:payment_datetime.trim()},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#submit_confirm_payment").attr("disabled",true);
		},success:function(data){
			if(data.success==0){
				alert('เกิดข้อผิดพลาดกรุณาลองใหม่');
			}else{
				$("#payment_tag_number").val('');
				$("#payment_tag_province").val('');
				$("#payment_amount").val('');
				$("#payment_from_bank").val('');
				$("#payment_to_bank").val('');
				$("#payment_datetime").val('');
				alert('บันทึกข้อมูลเรียบร้อยแล้ว');
			}
			$("#submit_confirm_payment").attr("disabled",false);
		}
	})
}

function submit_confirm_receive(){
	var receive_number = $("#receive_number").val();
	var receive_province = $("#receive_province").val();
	var receive_datetime = $("#receive_datetime").val();
	if(receive_number.trim()==''){
		alert('กรุณากรอกเลขทะเบียน');
		$("#receive_number").focus();
		return;
	}
	if(receive_province.trim()==''){
		alert('กรุณากรอกทะเบียนจังหวัด');
		$("#receive_province").focus();
		return;
	}
	if(receive_datetime.trim()==''){
		alert('กรุณากรอกวัน-เวลาที่ได้รับสินค้า');
		$("#receive_datetime").focus();
		return;
	}
	$.ajax({
		url:base_url+'member/confirmReceive',
		type:'POST',
		data:{receive_number:receive_number,receive_province:receive_province,receive_datetime:receive_datetime.trim()},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#submit_confirm_receive").attr("disabled",true);
		},success:function(data){
			if(data.success==0){
				alert('เกิดข้อผิดพลาดกรุณาลองใหม่');
			}else{
				$("#receive_number").val('');
				$("#receive_province").val('');
				$("#receive_datetime").val('');
				alert('บันทึกข้อมูลเรียบร้อยแล้ว');
			}
			$("#submit_confirm_receive").attr("disabled",false);
		}
	})
}

function submit_info(){
	var member_name = $("#member_name").val();
	var member_email = $("#member_email").val();
	var member_mobile = $("#member_mobile").val();
	var member_address = $("#member_address").val();
	if(member_name.trim()==''){
		alert('กรุณากรอกชื่อ');
		$("#member_name").focus();
		return;
	}
	if(member_email.trim()==''){
		alert('กรุณากรอกอีเมล์');
		$("#member_email").focus();
		return;
	}
	if(member_mobile.trim()==''){
		alert('กรุณากรอกเบอร์โทรศัพท์');
		$("#member_mobile").focus();
		return;
	}
	if(member_address.trim()==''){
		alert('กรุณากรอกที่อยู่');
		$("#member_address").focus();
		return;
	}
	$.ajax({
		url:base_url+'member/changeMemberInfo',
		type:'POST',
		data:{member_name:member_name.trim(),member_email:member_email.trim(),member_mobile:member_mobile.trim(),member_address:member_address.trim()},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#submit_info").attr("disabled",true);
		},success:function(data){
			if(data.success==0){
				alert('เกิดข้อผิดพลาดกรุณาลองใหม่');
			}else{
				alert('บันทึกข้อมูลเรียบร้อยแล้ว');
			}
			$("#submit_info").attr("disabled",false);
		}
	})
}

function submit_chg_password(){
	var member_password = $("#member_password").val();
	var member_repassword = $("#member_repassword").val();
	if(member_password.trim()==''){
		alert('กรุณากรอกรหัสผ่านใหม่');
		$("#member_password").focus();
		return;
	}
	if(member_repassword.trim()==''){
		alert('กรุณากรอกยืนยันรหัสผ่านใหม่');
		$("#member_repassword").focus();
		return;
	}
	if(member_password.trim()!=member_repassword.trim()){
		alert('รหัสผ่านทั้งสองครั้งไม่เหมือนกัน');
		$("#member_repassword").focus();
		return;
	}
	$.ajax({
		url:base_url+'member/changePassword',
		type:'POST',
		data:{member_password:member_password.trim(),member_repassword:member_repassword.trim()},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#submit_info").attr("disabled",true);
		},success:function(data){
			if(data.success==0){
				alert('เกิดข้อผิดพลาดกรุณาลองใหม่');
			}else{
				alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
				$("#member_password").val(null);
				$("#member_repassword").val(null);
			}
			$("#submit_info").attr("disabled",false);
		}
	})
}
