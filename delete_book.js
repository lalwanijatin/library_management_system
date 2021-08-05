
$(document).ready(function(){
	$('#book').keyup(function(){
		var query_string = $(this).val();
		$.ajax({
			type: "POST",
			url: "delete_book.php",
			data: { name:query_string },
			
			success: function(data)
			{ 
				$('.suggestresult').html(data);
				$('.suggestresult li').click(function(){
					var return_value = $(this).text();
					$('#book').attr('value', return_value); 
					$('#book').val(return_value);
					$('#book').focus();
					$('.suggestresult').html('');
				});
			}
		});
	});
	
});
