$(document).ready(function(){
$('#adiv').fadeIn(1000);
$('#adiv').fadeOut(2000);
$('#password').keypress(function(e){
	if(e.which == 13){
		$('#adiv').fadeIn(1000);
	}
});

});