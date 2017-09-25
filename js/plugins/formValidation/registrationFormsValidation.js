/* .validate - Jquery Validation PLugin - More examples and documentation at https://github.com/jzaefferer/jquery-validation */
  
var FormsValidation = function () {

    return {
        init: function () {

            /* registration.php Form Validations */
            $('#registration-form-validation').validate({
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
                    min_user_chars: {
                        required: true,
                        number: true
                    },
                    max_user_chars: {
                        required: true,
                        number: true
                    },
                    min_pass_chars: {
                        required: true,
                        number: true
                    },
                    max_pass_chars: {
                        required: true,
                        number: true
                    }
                }
            }); 
           
        }
    };
}();