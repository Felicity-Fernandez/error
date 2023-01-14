$('#desktop').click(function(){
	$('.sidebar a').toggleClass('hideMenuList');
	$('.sidebar').toggleClass('changeWidth');
})
$('#mobile').click(function(){
	$('.sidebar').toggleClass('showMenu');
	$('.backdrop').toggleClass('showBackdrop');
})
$('.backicn').click(function(){
	$('.sidebar').toggleClass('showMenu');
	$('.backdrop').removeClass('showBackdrop');
})
$('.backdrop').click(function(){
	$('.sidebar').removeClass('showMenu');
	$('.backdrop').removeClass('showBackdrop');
})
$('li').click(function(){
	$('li').removeClass();
	$(this).addClass('selected');
	$('.sidebar').removeClass('showMenu');
	$('.backdrop').removeClass('showBackdrop');
})
var box = document.getElementById('box');
var down = false;
function toggleNotif(){
	if (down) {
		box.style.height = '0px';
		box.style.opacity = 0;
		down = false;
	}else {
		box.style.height = '510px';
		box.style.opacity = 1;
		down = true;
	}
}