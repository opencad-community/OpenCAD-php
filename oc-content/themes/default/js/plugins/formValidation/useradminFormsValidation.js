/* .validate - Jquery Validation PLugin - More examples and documentation at https://github.com/jzaefferer/jquery-validation */
  
var FormsValidation = function () {

    return {
        init: function () { 
        
            /* useradmin.php Modal Form Validations */
            $('#admin-create-user').validate({
                errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function (error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function (e) {
                    // You can use the following if you would like to highlight with green color the input after successful validation!
                    e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                    e.closest('.help-block').remove();
                },
                rules: {
                    user: {
                        required: true,
                        minlength: 3
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    pass: {
                        required: true,
                        minlength: 4
                    },
                    conf_pass: {
                        required: true,
                        equalTo: '#inputPassword'
                    },
                    email: {
                        required: true,
                        email: true
                    },   
                    conf_email: {
                        required: true,
                        equalTo: '#email'
                    }
                    
                }
            }); 
           
        }
    };
}();