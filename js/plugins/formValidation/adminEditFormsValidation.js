/* .validate - Jquery Validation PLugin - More examples and documentation at https://github.com/jzaefferer/jquery-validation */
  
var FormsValidation = function () {

    return {
        init: function () {

            /* adminuseredit.php Form Validations */
            $('#admin-edit-user').validate({
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
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 36
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    newpass: {
                        minlength: 4
                    },
                    conf_newpass: {
                        equalTo: '#inputPassword'
                    },
                    email: {
                        required: true,
                        email: true
                    }
                }
            }); 
           
        }
    };
}();