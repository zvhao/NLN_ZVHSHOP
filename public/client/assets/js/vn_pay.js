window.addEventListener('load', function (

) {


	const form_vn_pay = document.querySelector('.submit_vnpay');
	const img_vnpay = document.querySelector('.vnpay_img');
	const formPayment = document.querySelector('.form_checkout')

	img_vnpay?.addEventListener('click', function (e) {
		const fullname = document.querySelector('input[name="fullname"]').value;
		const tel = document.querySelector('input[name="tel"]').value;
		const email = document.querySelector('input[name="email"]').value;
		const address = document.querySelector('input[name="address"]').value;
		const note = document.querySelector('#note').value;
		const total = document.querySelector('input[name="total"]').value;
		console.log( formPayment.getAttribute('action'));
	

		if(!fullname || !tel || !email || !address || !total) {
			alert("Thông tin chưa hợp lệ!!!")
		} else {
			const data_payment = {
				method: "Vn_pay",
					 fullname,
					 email,
					 tel,
					 address,
					 note,
					 total,
					 add_bill: 'add_bill'
			}
			localStorage.setItem('data_payment',JSON.stringify(data_payment));

			localStorage.setItem('url_payment',JSON.stringify(formPayment.getAttribute('action')));
			form_vn_pay.submit();

	
		}
		


	})


	const success_vnpay = document.querySelector('.success_vnpay');
	if(success_vnpay){
		const data_payment = JSON.parse(localStorage.getItem('data_payment'));
		const url = JSON.parse(localStorage.getItem('url_payment'));
		if(data_payment && url){

			$.ajax({
				type: "POST",
				url: url,
				data:data_payment,
				dataType: "text",
				success: function (data) {
						 localStorage.removeItem('.data_payment');
						 localStorage.removeItem('.url_payment');
	
					 console.log('thanh cong');
	 
				},
				error: function (e) {
					 console.log(e);
				},
		  });
		}
	}
})