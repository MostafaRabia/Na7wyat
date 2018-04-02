$(document).ready(function(){
	function addDegree(thisId){
		var id = thisId.attr('id');
		var degree = parseFloat($('#'+id).val());
		var max = parseFloat($('#'+id).attr('max'));
		var userId = $('#'+id).attr('userId');
		var idExam = $('#'+id).attr('idExam');
		if (degree<=max){
			$.ajax({
				url:'../../../result/'+id,
				type:'get',
				data:{'degree':degree,'userId':userId,'idExam':idExam},
				success:function(data){
					$('#degree'+id).text(degree);
					Materialize.toast('تم اضافة الدرجة بنجاح.', 2000);
				}
			});
		}else{
			Materialize.toast('لم يتم اضافة الدرجة.', 2000);
		}
	}
	$('.addDegree').on('click',function(){
		addDegree($(this));
	});
	$('.addDegreeText').on('keyup',function(event){
		if (event.which==13){
			addDegree($(this));
		}
	});
});