<?php
$this->load->view('header');
$this->load->module('image');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="list-inline">
				<li><a href="<?=base_url();?>">หน้าแรก</a></li>
				<?
				if($this->session->userdata('member_fid')>0){
				?>
				<li><a href="<?=base_url();?>">ข้อมูลสมาชิก</a></li>
				<li><a href="#"onclick="logout()">ออกจากระบบ</a></li>
				<?
				}else{
				?>
				<li><a href="<?=base_url();?>login">เข้าสู่ระบบ</a></li>
				<li><a href="<?=base_url();?>register">สมัครสมาชิก</a></li>
				<?
				}
				?>
			</ul>
			<button onclick="alert(123,'info');">ตัวอย่าง Alert info</button>
			<button onclick="alert(123,'warning');">ตัวอย่าง Alert Warning</button>
			<button onclick="alert(123,'error');">ตัวอย่าง Alert Error</button>
			<button onclick="alert(123,'success');">ตัวอย่าง Alert Success</button>
			<button onclick="alert(123,'question');">ตัวอย่าง Alert Question</button>
			<button onclick="confirm(123);">ตัวอย่าง Alert Confirm</button>
			<button onclick="getpy()">getPY</button>

			<hr>
			<iframe name="editor" id="editor"></iframe>
			<script>
			/*var viewSourceCode=false;
			var isEditMode=true;
			function enableEditMode(){
				richTextField.document.designMode='On';
			}
			
			function execCmdWithArg(command,arg){
				richTextField.document.execCommand(command,false,arg);
			}
			function toggleSource(){
				if(viewSourceCode){
					richTextField.document.getElementsByTagName('body')[0].innerHTML = richTextField.document.getElementsByTagName('body')[0].textContent;
					viewSourceCode=false;
				}else{
					richTextField.document.getElementsByTagName('body')[0].textContent = richTextField.document.getElementsByTagName('body')[0].innerHTML;
					viewSourceCode=true;
				}
			}
			function toggleEdit(){
				if(isEditMode){
					isEditMode=false;
					richTextField.document.designMode='Off';
				}else{
					isEditMode=true;
					richTextField.document.designMode='On';
				}
			}*/
			
			$("#editor").keditor();
			
			
function getpy(){
	var url="http://128.199.124.135/index.php";
	$.ajax({
		url:url,
		type:'GET',
		crossDomain: true,
		dataType:'jsonp',
		cache:false,
		success:function(data){
			var a=JSON.stringify(data)
			console.log(a)
		}
	})
}
			</script>

		</div>
	</div>
</div>
<script>

/***Image Gallery****/
function insertImg(){
	$("#myModal").modal('show');
	getImageByMemberId(1,1);
	getTotalImagePageByMemberId(1);
}
function append_image(image_path){
	execCmdWithArg('insertImage',image_path)
	//$("#myModal").modal('hide');
}
function getTotalImagePageByMemberId(member_fid){
	var url="<?=base_url();?>image/getTotalImagePageByMemberId";
	$.ajax({
		url:url,
		type:'POST',
		data:{member_id:1},
		dataType:'json',
		cache:false,
		success:function(data){
			$("#list-page").empty();
			for(i=0;i<data.total_page;i++){
				$("#list-page").append('<li><a href="javascript:getImageByMemberId(1,'+(i+1)+')" class="btn btn-default btn-xs">page-'+(i+1)+'</a></li>');
			}
		}
	})
}
function getImageByMemberId(member_fid,page){
	var url="<?=base_url();?>image/getImageByMemberId/";
	$.ajax({
		url:url,
		type:'POST',
		data:{member_fid:member_fid,page:page},
		dataType:'json',
		cache:false,
		success:function(data){
			if(data.length>0){
				$("#list-image").empty();
				$.each(data,function(k,v){
					$("#list-image").append('<li><img id="image" src="'+v.image_path+'" onclick="append_image(\''+v.image_path+'\')"></li>');
				})
			}
		}
	})
}



<?php
$this->load->view('footer');
?>