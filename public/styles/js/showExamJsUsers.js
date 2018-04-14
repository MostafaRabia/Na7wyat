$(document).ready(function(){
	$('.brand-logo').removeAttr('href');
	$('nav ul').remove();
	$('nav .button-collapse').remove();
	if (Cookies.get('time')){
		$('.asideLeft h4 span span').html(Cookies.get('time'));
	}
	if ($('.asideLeft h4 span span').html()==null){}else{
		var Timer = setInterval(function(){
			var presentTime = $('.asideLeft h4 span span').html();
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
function myUnloadHandler(){
	var hour = new Date(new Date().getTime() + 60 * 60 * 1000);
	Cookies.remove('time',{path:''});
	if ($('.asideLeft h4 span span').html()==null){}else{
		Cookies.set('time',$('.asideLeft h4 span span').html(),{expires:hour,path:''});
	}
}
if ("onpagehide" in window) {
    window.addEventListener("pagehide", myUnloadHandler, false);
} else {
    window.addEventListener("unload", myUnloadHandler, false);
}
