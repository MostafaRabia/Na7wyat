$(document).ready(function(){
    $('.addBtn').on('click',function(){
		var element = this;
        var href = $('.addForm').attr('action');
		$.ajax({
			url:href,
			type:"POST",
			data:$('.addForm').serialize(),
			beforeSend: function(){
				$(element).addClass('disabled');
			},
			success:function(data){
				if (data=="done"){
                    $(element).removeClass('disabled');
					Materialize.toast('تم الإضافة بنجاح.', 2000);
				}else{
                    Materialize.toast('لم تتم الإضافة', 2000);
                }
			}
		});
		return false;
	});
});