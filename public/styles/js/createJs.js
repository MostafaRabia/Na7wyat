$(document).ready(function(){
	if ($('#isUnlimted').val()=="no"){
		$('.date').css('display','block');
	}else{
		$('.date').hide();
	}
	if ($('#isTime').val()=="yes"){
		$('.time').css('display','block');
	}else{
		$('.time').hide();
	}
	if ($('#page').val()=="yes"){
		$('.rand').css('display','none');
		$(".quesToShowSelect").css("cssText", "display: block !important;");
		if ($('#quesToShowSelect').val()=="yes"){
			$('.quesToShow').css('display','block');
		}
		$(".back").css("cssText", "display: block !important;");
	}else if ($('#page').val()=="no"){
		$(".rand").css("cssText", "display: block !important;");
		$('.quesToShowSelect').css('display','none');
		$('.quesToShow').hide();
		$('.back').css('display','none');
	}

	$('#isUnlimted').on('change',function(){
		if ($(this).val()=="no"){
			$('.date').css('display','block');
		}else{
			$('.date').hide();
		}
	});
	$('.datepicker').pickadate();
	$('.timepicker').pickatime({ampmclickable:false,twelvehour:false});
	$('select').material_select();
	$('.submit-add-ques').on('click',function(){
		var element = this;
		var href = $('.formAddQue').attr('action');
		$.ajax({
			url:href,
			type:"POST",
			data:$('.formAddQue').serialize(),
			beforeSend: function(){
				$(element).addClass('disabled');
			},
			success:function(data){
				$(element).removeClass('disabled');
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
		if ($(this).val()=="yes"){
			$('.rand').css('display','none');
			$(".quesToShowSelect").css("cssText", "display: block !important;");
			if ($('#quesToShowSelect').val()=="yes"){
				$('.quesToShow').css('display','block');
			}
			$(".back").css("cssText", "display: block !important;");
		}else{
			$('.rand').css('display','block');
			$('.quesToShowSelect').css('display','none');
			$('.quesToShow').hide();
			$('.back').css('display','none');
		}
	});
	$('#quesToShowSelect').on('change',function(){
		if ($(this).val()=="yes"){
			$('.quesToShow').css('display','block');
		}else{
			$('.quesToShow').hide();
		}
	});
});