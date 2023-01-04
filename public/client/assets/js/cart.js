// $(document).ready(function() {
// 	$(".num-order").change(function () { 
// 		var id = $(this).attr('data-id');
// 		var qty = $(this).val();
// 		var data = {id: id, qty: qty};

// 		$.ajax({
// 			url: 'cart/update_cart',
// 			method: 'POST',
// 			data: data,
// 			dataType: 'json',
// 			success: function(data) {
// 				$("#sub-total-"+id).text(data.sub_total);
// 				$("#total-price span").text(data.total);
// 				console.log(1);
// 			},
// 			error: function(xhr, ajaxOptions, throwError) {
// 				alert(xhr.status);
// 				alert(throwError);
// 			}
// 		});

// 	});
// })

var $url = window.location.href;

$(function () {
	var action = document.querySelector('form.form-update-cart').action
	// console.log(action);
	$(".num-order").change(function (e) {
		// e.preventDefault();
		var id = $(this).attr('data-id');
		var qty = $(this).val()
		var formPost = {
			id: id,
			qty: qty
		}
		// console.log(formPost.id);
		$.ajax({
			type: "POST",
			url: action,
			data: formPost,
			success: function (data) {
				var dataNew = JSON.parse(data);
				$("#sub_total-"+id).text(dataNew.sub_total.toLocaleString('de-DE')+ "₫");
				$("#total-cart").text(dataNew.total.toLocaleString('de-DE') + "₫");
				// console.log(dataNew.total.toLocaleString('de-DE'));
			}
		});
		e.preventDefault();
	});
	
});