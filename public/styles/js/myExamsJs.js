$(document).ready(function(){
	$('.enter').on('click',function(){
		$('#modal1').modal();
		$('#modal1').modal('open');
		$('.enter-modal').attr('href',$(this).attr('href'));
		return false;
	});
});