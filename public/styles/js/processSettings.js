$(document).ready(function(){
	$('select').material_select();
	$('.timepicker').pickatime({ampmclickable:false,twelvehour:false});

	setInterval(function(){
		$('.check').removeClass('disabled');
	},10000);

    $('.subscribe').on('click',function(){
		if ($('.invalid').hasClass('invalid')){
			Materialize.toast('الأسبوع يبدأ من 1', 2000);
			return false;
		}
		var element = this;
        var href = $('.subscribeForm').attr('action');
        var hrefSuccess = $(element).attr('href');
		$.ajax({
			url:href,
			type:"POST",
			data:$('.subscribeForm').serialize(),
			beforeSend: function(){
				$(element).addClass('disabled');
			},
			success:function(data){
				if (data=="done"){
                    $(element).addClass('disabled');
					Materialize.toast('تم الاشتراك بنجاح.', 2000);
					$('.to-hide').show();
				}else if (data=="errorName"){
                    $(element).removeClass('disabled');
					Materialize.toast('يرجى كتابة الاسم كما التليجرام.', 2000);
				}else if (data=='error'){
                    $(element).removeClass('disabled');
                    Materialize.toast('لا تترك الحقول فارغة.', 2000);
                }
			}
		});
		return false;
	});

	$('.check').on('click',function(){
		var element = this;
		var href = $(this).attr('href');
		$.ajax({
			url:href,
			type:"POST",
			beforeSend: function(){
				$(element).addClass('disabled');
			}
		});
		return false;
	});
});