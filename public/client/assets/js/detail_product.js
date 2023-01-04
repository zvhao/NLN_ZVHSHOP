// Thu gọn detail_product
$(function () {
	const contentDetail = document.querySelector(".desc-short-product");
	const btn1 = document.getElementById("btn1")
	const btn2 = document.getElementById("btn2")
	// console.log(contentDetail);
	var offset = contentDetail.offsetHeight;

	// console.log(offset);

	if (offset > 300) {
		contentDetail.style.height = '300px';
		btn1.style.display = 'none'
		btn2.style.display = ''

	} else {
		btn1.style.display = 'none'
		btn2.style.display = 'none'
	}

	btn1.onclick = function () {
		contentDetail.style.height = '300px';
		btn1.style.display = 'none'
		btn2.style.display = ''

	};
	btn2.onclick = function () {
		contentDetail.style.height = 'auto';
		btn1.style.display = ''
		btn2.style.display = 'none'
	};
});



//submit form comment - detail product

// console.log($action);

var $url = window.location.href;
$(document).ready(function () {
	var $action = document.querySelector('form.form-comment').action
	$(".form-comment").submit(function (event) {
		var formData = {
			stars: $("input[name=stars]").val(),
			id_user: $("input[name=id_user]").val(),
			id_pro: $("input[name=id_pro]").val(),
			comment: $("textarea[name=comment]").val(),
			btn_submit: $("button[name=btn_submit]").val(),
		};

		$.ajax({
			type: "POST",
			url: $action,
			data: formData,
			dataType: "json",
			encode: true,
			success: function (data) {
				Swal.fire({
					icon: 'success',
					title: 'Cảm ơn bạn đã đánh giá!',
					showConfirmButton: false,
					timer: 1500
				})
				console.log(data);
				$(".form-comment").load($url + " .form-comment")
				$(".table-comments").load($url + " .table-comments")
			},
			error: function (xhr, ajaxOptions, throwError) {
				alert(xhr.status);
				alert(throwError);
			}
		})

		event.preventDefault();
	});
});


var inputRating = document.querySelector('input[name=stars]')
var rs = document.getElementsByClassName('icon-rating')
for (const [key, value] of Object.entries(rs)) {
	value.addEventListener("click", function () {
		// console.log(parseInt(key) + 1);
		var value = parseInt(key) + 1
		inputRating.value = value
		for (let index = 0; index < value; index++) {
			// console.log(rs[index].className);
			rs[index].classList.add('fa-solid')
			rs[index].classList.remove('fa-regular')
		}
		for (let j = 4; j >= value; j--) {
			// console.log(1);
			// console.log(rs[j].classList[parseInt(rs[j].classList.length) - 1]);
			if (rs[j].classList[parseInt(rs[j].classList.length) - 1] == 'fa-solid') {
				rs[j].classList.remove('fa-solid')
				rs[j].classList.add('fa-regular')
				// console.log(Object.values(rs[j].classList).length);


			}
			// rs[j].className = rs[j].className === 'fa-solid' ? 'fa-regular' : 'fa-solid';

		}
	});
	//   
}



//add to cart
$(document).ready(function () {
	var $action = document.querySelector('form.form-add-to-cart').action
	// console.log($('.num-order').val());
	$('form.form-add-to-cart').submit(function (e) {
		var formData = {
			num_order: $('.num-order').val(),
			add_to_cart: $('.add-to-cart').val(),
		}

		$.ajax({
			type: "POST",
			url: $action,
			data: formData,
			// dataType: "json",
			// encode: true,
			success: function (data) {
				Swal.fire({
					icon: 'success',
					title: 'Thêm vào giỏ thành công!',
					showCancelButton: true,
					confirmButtonColor: '#037dff',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Vào giỏ hàng!',
					cancelButtonText: 'OK!'
				}).then((result) => {
					if(result.isConfirmed) {
						window.location.href = 'http://localhost/NLN_ZVHSHOP/cart'
					}
				})
			},
			error: function (xhr, ajaxOptions, throwError) {
				alert(xhr.status);
				alert(throwError);
				console.log(throwError);
			}

		});
		e.preventDefault();
		$(".a-header-right.header-cart-link").load($url + " .a-header-right.header-cart-link")
		$(".header-cart-list").load($url + " .header-cart-list")
	});


});