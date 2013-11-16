$(function() {
 
	$('#search_auto').css({'width':$('#search input[name="k"]').width()+4});
	$('#search input[name="k"]').keyup(function(){
		$.post('search_auto.php',{'value':$(this).val()},function(data){
			if(data=='0') $('#search_auto').html('').css('display','none');
			else $('#search_auto').html(data).css('display','block');
		});
	});
});