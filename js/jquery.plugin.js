var directory="uploads/";

/*****wysiwyg*****/
$(function(){
	$.fn.keditor = function(options){
		var base = $(this);
		var viewSourceCode=false;
		var isEditMode=true;
		
		
		
		$.fn.keditor.defaults={
			width:'1000px',
			height:'200px',
			border:'1px solid #666'
		}
		var options = $.extend({},$.fn.keditor.defaults,options);
		
		base.each(function() {
			var element= $(this);
			element.css({
				width: options.width,
				height:options.height,
				border:options.border
			})
			
			editor.document.designMode='On';
			element.before('<div id="editor-bar"></div>');
			
			var btn = '<button class="btn btn-default btn-sm" id="bold"><i class="fa fa-bold"></i></button>';
			$("#editor-bar").append(btn);
			$('#bold').on("click", function (e) {base.execCmd('bold')})
			var btn = '<button class="btn btn-default btn-sm" id="italic"><i class="fa fa-italic"></i></button>';
			$("#editor-bar").append(btn);
			$('#italic').on("click", function (e) {base.execCmd('italic')})
			var btn = '<button class="btn btn-default btn-sm" id="underline"><i class="fa fa-underline"></i></button>';
			$("#editor-bar").append(btn);
			$('#underline').on("click", function (e) {base.execCmd('underline')})
			var btn = '<button class="btn btn-default btn-sm" id="strikeThrough"><i class="fa fa-strikethrough"></i></button>';
			$("#editor-bar").append(btn);
			$('#strikeThrough').on("click", function (e) {base.execCmd('strikeThrough')})
			var btn = '<button class="btn btn-default btn-sm" id="justifyLeft"><i class="fa fa-align-left"></i></button>';
			$("#editor-bar").append(btn);
			$('#justifyLeft').on("click", function (e) {base.execCmd('justifyLeft')})
			var btn = '<button class="btn btn-default btn-sm" id="justifyRight"><i class="fa fa-align-right"></i></button>';
			$("#editor-bar").append(btn);
			$('#justifyRight').on("click", function (e) {base.execCmd('justifyRight')})
			var btn = '<button class="btn btn-default btn-sm" id="justifyCenter"><i class="fa fa-align-center"></i></button>';
			$("#editor-bar").append(btn);
			$('#justifyCenter').on("click", function (e) {base.execCmd('justifyCenter')})
			var btn = '<button class="btn btn-default btn-sm" id="justifyFull"><i class="fa fa-align-justify"></i></button>';
			$("#editor-bar").append(btn);
			$('#justifyFull').on("click", function (e) {base.execCmd('justifyFull')})
			var btn = '<button class="btn btn-default btn-sm" id="indent"><i class="fa fa-indent"></i></button>';
			$("#editor-bar").append(btn);
			$('#indent').on("click", function (e) {base.execCmd('indent')})
			var btn = '<button class="btn btn-default btn-sm" id="outdent"><i class="fa fa-outdent"></i></button>';
			$("#editor-bar").append(btn);
			$('#outdent').on("click", function (e) {base.execCmd('outdent')})
			var btn = '<button class="btn btn-default btn-sm" id="subscript"><i class="fa fa-subscript"></i></button>';
			$("#editor-bar").append(btn);
			$('#subscript').on("click", function (e) {base.execCmd('subscript')})
			var btn = '<button class="btn btn-default btn-sm" id="superscript"><i class="fa fa-superscript"></i></button>';
			$("#editor-bar").append(btn);
			$('#superscript').on("click", function (e) {base.execCmd('superscript')})
			var btn = '<button class="btn btn-default btn-sm" id="undo"><i class="fa fa-rotate-left"></i></button>';
			$("#editor-bar").append(btn);
			$('#undo').on("click", function (e) {base.execCmd('undo')})
			var btn = '<button class="btn btn-default btn-sm" id="insertUnorderedList"><i class="fa fa-list-ul"></i></button>';
			$("#editor-bar").append(btn);
			$('#insertUnorderedList').on("click", function (e) {base.execCmd('insertUnorderedList')})
			var btn = '<button class="btn btn-default btn-sm" id="insertOrderedList"><i class="fa fa-list-ol"></i></button>';
			$("#editor-bar").append(btn);
			$('#insertOrderedList').on("click", function (e) {base.execCmd('insertOrderedList')})
			var btn = '<button class="btn btn-default btn-sm" id="link"><i class="fa fa-link"></i></button>';
			$("#editor-bar").append(btn);
			$('#link').on("click", function (e) {base.execCmdWithArg('createLink',prompt('Enter URL','http://'))})
			var btn = '<button class="btn btn-default btn-sm" id="unlink"><i class="fa fa-unlink"></i></button>';
			$("#editor-bar").append(btn);
			$('#unlink').on("click", function (e) {base.execCmd('unlink')})
			var btn = '<button class="btn btn-default btn-sm" id="code"><i class="fa fa-code"></i></button>';
			$("#editor-bar").append(btn);
			$('#code').on("click", function (e) {
				if(viewSourceCode){
					editor.document.getElementsByTagName('body')[0].innerHTML = editor.document.getElementsByTagName('body')[0].textContent;
					viewSourceCode=false;
				}else{
					editor.document.getElementsByTagName('body')[0].textContent = editor.document.getElementsByTagName('body')[0].innerHTML;
					viewSourceCode=true;
				}
			})
			var btn = '<button class="btn btn-default btn-sm" id="insertImage"><i class="fa fa-file-image-o"></i></button>';
			$("#editor-bar").append(btn);
			$('#insertImage').on("click", function (e) {base.insertImage()})

			var btn = '<select id="fontName">';
				btn += '<option value="Tahoma">Tahoma</option>';
				btn += '<option value="Verdana">Verdana</option>';
				btn += '<option value="Comic Sans Ms">Comic Sans Ms</option>';
				btn += '<option value="Courier">Courier</option>';
				btn += '<option value="Arial">Arial</option>';
				btn += '</select>';
			$("#editor-bar").append(btn);
			$('#fontName').on("change", function (e) {base.execCmdWithArg('fontName',this.value)})
			
			var btn = '<select id="formatBlock">';
				btn += '<option value="H1">H1</option>';
				btn += '<option value="H2">H2</option>';
				btn += '<option value="H3">H3</option>';
				btn += '<option value="H4">H4</option>';
				btn += '<option value="H5">H5</option>';
				btn += '<option value="H6">H6</option>';
				btn += '</select>';
			$("#editor-bar").append(btn);
			$('#formatBlock').on("change", function (e) {base.execCmdWithArg('formatBlock',this.value)})
			
			/*var btn = '<select id="fontSize">';
				btn += '<option value="1">size 1</option>';
				btn += '<option value="2">size 2</option>';
				btn += '<option value="3">size 3</option>';
				btn += '<option value="4">size 4</option>';
				btn += '<option value="5">size 5</option>';
				btn += '<option value="6">size 6</option>';
				btn += '<option value="7">size 7</option>';
				btn += '</select>';
			$("#editor-bar").append(btn);
			$('#fontSize').on("change", function (e) {base.execCmdWithArg('fontSize',this.value)})*/
			
			var btn = '<input type="color" id="foreColor">';
			$("#editor-bar").append(btn);
			$('#foreColor').on("change", function (e) {base.execCmdWithArg('foreColor',this.value)})
			var btn = '<input type="color" id="hiliteColor">';
			$("#editor-bar").append(btn);
			$('#hiliteColor').on("change", function (e) {base.execCmdWithArg('hiliteColor',this.value)})
		});
		
		base.execCmd=function(command){
			editor.document.execCommand(command,false,null);
		}
		base.execCmdWithArg=function(command,arg){
			editor.document.execCommand(command,false,arg);
		}
		base.insertImage=function(e){
			
			$("#myModal").remove();
			var modal='<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
				modal+='<div class="modal-dialog modal-lg" role="document">';
				modal+='<div class="modal-content" style="border-radius:0px !important;">';
				modal+='<div class="modal-body">';
				modal+='<div class="row">';
				modal+='<div class="col-md-2" id="list-of-directory">';
				modal+='</div>';
				modal+='<div class="col-md-10" id="image-container">เลือก Folder ด้านซ้าย';
				modal+='</div>';
				modal+='</div>';
				modal+='</div>';
				modal+='</div>';
				modal+='</div>';
				modal+='</div>';
			$("#editor-bar").append(modal);	
			$("#myModal").modal('show')	
			
			// list of directory
			list_of_directory();
		}
		
	}
}(jQuery))
function list_of_directory(){
	var list_of_directory="";
	var url=directory+"directory.php";
	$.ajax({
		url:url,
		type:'GET',
		data:{'proc':'list'},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#list-of-directory").empty('');
			$("#list-of-directory").append('Loading...');
		},
		success:function(data){
			list_of_directory+='<ul class="list-unstyled">';
			list_of_directory+='<li><a href="javascript:createDirectory();">[+]NewFolder</a></li>';
			$.each(data,function(k,v){
				list_of_directory+='<li><a href="javascript:list_of_image(\''+v+'\');">'+v+'</a></li>';
			})
			list_of_directory+='</ul>';
			$("#list-of-directory").empty('');
			$("#list-of-directory").append(list_of_directory);
		}
	})
}


function list_of_image(directory_name=''){
	var image_container="";
	var url=directory+"upload.php";
	var image_path=directory+directory_name+'/';
	$.ajax({
		url:url,
		type:'POST',
		data:{'proc':'list',directory_name:directory_name},
		dataType:'json',
		cache:false,
		beforeSend:function(data){
			$("#image-container").empty('');
			$("#image-container").append('Loading...');
		},
		success:function(data){
			image_container+='<ul class="list-inline"><li><b>'+directory_name+'</b> <a href="javascript:deleteDirectory(\''+directory_name+'\');">[ลบ Folder นี้]</a></li>';  
			image_container+='<li><form method="post" id="frm" enctype="multipart/form-data">';
			image_container+='<div class="input-group">';
			image_container+='<input type="file" class="form-control" placeholder="เลือกรูปภาพ">';
			image_container+='<span class="input-group-btn">';
			image_container+='<button class="btn btn-default" type="button" onclick="upload_image(\''+directory_name+'\')">อัพโหลด</button>';
			image_container+='</span>';
			image_container+=' </div></li></ul>';
			image_container+="<ul class='list-inline'>";
			if(data.length>0){
				$.each(data,function(k,v){
					image_container+='<li><img id="image_'+k+'" src="'+image_path+v.name+'" class="img"></li>';
				})
			}else{
				image_container+='<li>ไม่มีรูปภาพ</li>';
			}
			image_container+="</ul>";
			$("#image-container").empty('');
			$("#image-container").append(image_container);
			
			$('.img').css({'cursor':'pointer','width':'100px','height':'100px'}).on("click", function (e) {
				e.preventDefault();
				editor.document.execCommand('insertImage',false,$(this).attr('src'));
				$("#myModal").modal('hide')
			})
		}
	})
}
			
function createDirectory(){
	var directory_name=prompt('ตั้งชื่อ Folder','NewFolder');
	var url=directory+"directory.php";
	$.ajax({
		url:url,
		type:'GET',
		data:{'proc':'create',directory_name:directory_name},
		dataType:'html',
		cache:false,
		success:function(data){
			list_of_directory();
		}
	})
}

function deleteDirectory(directory_name){
	var url=directory+"directory.php";
	swal({
		title: 'ยืนยันการลบ Folder',
		type: 'info',
		html:'รูปใน Folder นี้ จะถูกลบทั้งหมด',
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText:'<i class="fa fa-thumbs-up"></i> OK',
		cancelButtonText:'<i class="fa fa-thumbs-down"></i> NO',	
	}).then((res) => {
		if(res.value){
			$.ajax({
				url:url,
				type:'GET',
				data:{'proc':'delete',directory_name:directory_name},
				dataType:'html',
				cache:false,
				success:function(data){
					list_of_directory();
					$("#image-container").empty('');
				}
			})
		}
	})
	
}

function upload_image(directory_name){
	var url=directory+"upload.php";
	var formData = new FormData();
	formData.append('userPhoto', $('input[type=file]')[0].files[0]); 
	formData.append('proc', 'upload'); 
	formData.append('directory_name', directory_name); 
	$.ajax({
		url:url,
		type:'POST',
		data:formData,
		dataType:'json',
		processData: false,
        contentType: false,
		cache:false,
		success:function(data){
			if(data.success>0){
				list_of_image(directory_name);
			}else{
				alert('ลองอีกครั้ง');
			}
		}
	})
}

