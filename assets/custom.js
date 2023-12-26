function set_respose(message='',state='',timeout=5000) {
	$( '#response' ).removeClass( 'text-success' ).removeClass( 'text-danger' );
	if (message != '') {
		$( '#response' ).html( message );
		if (state == 'success') {
			$( '#response' ).addClass( 'text-success' );
		} else if (state == 'error') {
			$( '#response' ).addClass( 'text-danger' );
		}
		setTimeout(
			function () {
				$( '#response' ).html( '' );
				$( '#response' ).removeClass( 'text-success' ).removeClass( 'text-danger' );
			},
			timeout
		);
	}
}

jQuery( document ).ready(
	function ($) {
		$( '#form_signup' ).click(
			function () {
				var email     = $( '#signup_email' ).val();
				var password  = $( '#signup_password' ).val();
				var firstname = $( '#signup_firstname' ).val();
				var lastname  = $( '#signup_lastname' ).val();
				var phone     = $( '#signup_phone' ).val();
				if (email == undefined || email == '') {
					set_respose( 'Email is required field.','error' );
					return;
				} else if (password == undefined || password == '') {
					set_respose( 'Password is required field.','error' );
					return;
				} else if (firstname == undefined || firstname == '') {
					set_respose( 'First name is required field.','error' );
					return;
				} else if (lastname == undefined || lastname == '') {
					set_respose( 'Last name is required field.','error' );
					return;
				} else if (phone == undefined || phone == '') {
					set_respose( 'Last name is required field.','error' );
					return;
				}

				var formdata = {
					api: 'user',
					call: 'signup',
					email: email,
					password: password,
					firstname: firstname,
					lastname: lastname,
					phone: phone,
				};

				$.ajax(
					{
						type: "POST",
						url: base_url,
						data: formdata,
						success: function (response) {
							set_respose( response.message,response.status );
							if (response.status == 'success') {
								window.location = base_url + '?action=login';
							}
						}
					}
				);

			}
		);

		$( '#form_login' ).click(
			function () {
				var email    = $( '#login_email' ).val();
				var password = $( '#login_password' ).val();
				if (email == undefined || email == '') {
					set_respose( 'Email is required field.','error' );
					return;
				} else if (password == undefined || password == '') {
					set_respose( 'Password is required field.','error' );
					return;
				}

				var formdata = {
					api: 'user',
					call: 'auth',
					email: email,
					password: password,
				};

				$.ajax(
					{
						type: "POST",
						url: base_url,
						data: formdata,
						success: function (response) {
							set_respose( response.message,response.status );
							if (response.status == 'success') {
								window.location = base_url + '?action=events';
							}
						}
					}
				);

			}
		);
	}
);