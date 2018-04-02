$(document).ready(function(){
	var d;
	var t;
	setInterval(function(){
		$('button').removeClass('disabled');
	},5000);
	$('button').on('click',function(){
		$(this).addClass('disabled');
		window.onbeforeunload = function(e) {
		    e.preventDefault();
		}
	});
	$(".button-collapse").sideNav({
		edge:"right",
		draggable:true
	});
	$('ul li a[href="'+location.href+'"]').parent().addClass('active');
});
$(window).on('load',function(){
	$('#loaderSection div').fadeOut(1000,function(){
		$('body').css('overflow','auto');
		$(this).parent().fadeOut(1000,function(){
			$(this).remove();
		});
	});
});