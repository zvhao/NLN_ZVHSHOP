$(document).ready(function() {
	$(".num-order").change(function () { 
		var id = $(this).attr('data-id');
		var qty = $(this).val();
		var data = {id: id, qty: qty};

		$.ajax({
			url: 'cart/update_cart',
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function(data) {
				$("#sub-total-"+id).text(data.sub_total);
				$("#total-price span").text(data.total);
				console.log(data);
			},
			error: function(xhr, ajaxOptions, throwError) {
				alert(xhr.status);
				alert(throwError);
			}
		});
		
	});
})