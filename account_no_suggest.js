$(document).ready(function(){
	$('#book_return').keyup(function(){
		var query_string = $(this).val();
		$.ajax({
			type: "POST",
			url: "account_no_suggest.php",
			data: { name:query_string },
			
			success: function(data)
			{ 
				$('.suggestresult').html(data);
				$('.suggestresult li').click(function(){
					var return_value = $(this).text();
					$('#book_return').attr('value', return_value); 
					$('#book_return').val(return_value);
					$('#book_return').focus();
					$('.suggestresult').html('');
				});
			}
		});
	});
	
	
	$('#issue_book').keyup(function(){
		var query_string = $(this).val();
		$.ajax({
			type: "POST",
			url: "account_no_suggest.php",
			data: { name:query_string },
			
			success: function(data)
			{ 
				$('.suggestresult1').html(data);
				$('.suggestresult1 li').click(function(){
					var return_value = $(this).text();
					$('#issue_book').attr('value', return_value); 
					$('#issue_book').val(return_value);
					$('#issue_book').focus();
					$('.suggestresult1').html('');
				});
			}
		});
	});
	
});
