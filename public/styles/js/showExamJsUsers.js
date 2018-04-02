$(document).ready(function(){
	$('.brand-logo').removeAttr('href');
	if ($('.asideLeft span span').html()==null){}else{
		var Timer = setInterval(function(){
			var presentTime = $('.asideLeft span span').html();
			var timeArray = presentTime.split(/[:]+/);
			var m = timeArray[0];
			var s = checkSecond((timeArray[1] - 1));
			if (s==59){
				m--;
			}
			$('.asideLeft h4 span span').html(m+':'+s);
			if (m==0&&s==0){
				window.onbeforeunload = function(e) {
				    e.preventDefault();
				}
				clearInterval(Timer);
				$('form').submit();
			}
		},1000);
	}
	$('.submitBack').on('click',function(){
		var href = $('form').attr('action');
		$('form').attr('action',href+'/back');
		$('form').submit();
		return false;
	});
});
function checkSecond(sec) {
	if (sec < 10 && sec >= 0) {sec = "0" + sec};
	if (sec < 0) {sec = "59"};
	return sec;
}
window.onbeforeunload = function() {
    return "هل إنتهيت من الامتحان ؟";
}