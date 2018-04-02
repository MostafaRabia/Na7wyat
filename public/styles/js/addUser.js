$(document).ready(function(){
	$('.submit').on('click',function(){
		var href = $('.addUserForm').attr('action');
		$.ajax({
			url:href,
			type:"POST",
			data:$('.addUserForm').serialize(),
			success:function(data){
				if (data=="errorAddUser"){
					Materialize.toast('كل الحقول مطلوبة.', 2000);
				}else if (data=="addUser"){
					Materialize.toast('تمت الاضافة بنجاح.', 2000);
				}else if (data=="Exist"){
					Materialize.toast('العضو موجود مسبقاً.', 2000);
				}
			}
		});
		return false;
	});
});