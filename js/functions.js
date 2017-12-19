window.alert = function(message,type){
	if(!type){
		type='info';
	}
	swal(''+message,'',type);
};

window.confirm = function(message){
	swal({
		title: 'Confirm',
		type: 'info',
		html:message,
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText:'<i class="fa fa-thumbs-up"></i> OK',
		cancelButtonText:'<i class="fa fa-thumbs-down"></i> NO',
	})
};
