$(document).ready(function(){
	if ($('#isTime').val()=="yes"){
		$('.time').css('display','block');
	}else{
		$('.time').hide();
	}
	if ($('#page').val()=="no"){
		$('.rand').css('display','block');
	}else{
		$('.rand').hide();
	}
	$('.datepicker').pickadate();
	$('.timepicker').pickatime({ampmclickable:false,twelvehour:false});
	$('select').material_select();
	$('.submit').on('click',function(){
		var href = $('.formAddQue').attr('action');
		$.ajax({
			url:href,
			type:"POST",
			data:$('.formAddQue').serialize(),
			success:function(data){
				if (data=="addQue"){
					Materialize.toast('تم أضافة السؤال بنجاح', 2000);
				}else if (data=="errorCreateQue"){
					Materialize.toast('اسم السؤال مطلوب.', 2000);
				}
			}
		});
		return false;
	});
	$('#isTime').on('change',function(){
		if ($(this).val()=="yes"){
			$('.time').css('display','block');
		}else{
			$('.time').hide();
		}
	});
	$('#page').on('change',function(){
		if ($(this).val()=="no"){
			$('.rand').css('display','block');
		}else{
			$('.rand').hide();
		}
	});
});