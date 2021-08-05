$(document).ready(function(){
	$('#name').keyup(function(){
		var query_string = $(this).val();
		$.ajax({
			type: "POST",
			url: "search_book_suggest.php",
			data: { name:query_string },
			
			success: function(data)
			{ 
				$('.suggestresult').html(data);
				$('.suggestresult li').click(function(){
					var return_value = $(this).text();
					$('#name').attr('value', return_value); 
					$('#name').val(return_value);
					$('#name').focus();
					$('.suggestresult').html('');
				});
			}
		});
	});
	
});
