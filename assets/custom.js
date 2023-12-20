function set_respose(message='',state='',timeout=5000) {
    $('#response').removeClass('text-success').removeClass('text-danger');
    if(message != '') {
        $('#response').html(message);
        if(state == 'success') {
            $('#response').addClass('text-success');
        } else if(state == 'error') {
            $('#response').addClass('text-danger');
        }
        setTimeout(function(){
            $('#response').html('');
            $('#response').removeClass('text-success').removeClass('text-danger');
        },timeout);
    }
}

jQuery(document).ready(function($){
    $('#form_signup').click(function() {
        var email = $('#signup_email').val();
        var firstname = $('#signup_firstname').val();
        var lastname = $('#signup_lastname').val();
        var phone = $('#signup_phone').val();
        console.log(email,firstname,lastname, phone)
        if(email == undefined || email == '') {
            set_respose('Email is required field.','error');
        } else if(firstname == undefined || firstname == '') {
            set_respose('First name is required field.','error');
        } else if(lastname == undefined || lastname == '') {
            set_respose('Last name is required field.','error');
        } else if(phone == undefined || phone == '') {
            set_respose('Last name is required field.','error');
        }

        var formdata = {
            api: 'auth',
            call: 'login',
            email: email,
            firstname: firstname,
            lastname: lastname,
            phone: phone
        }

        $.ajax('/events/','POST',{
            'data': formdata,
            success: function(response) {
                console.log(resposne);
            }
        });

        
    });
});