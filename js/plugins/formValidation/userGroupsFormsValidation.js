/* .validate - Jquery Validation PLugin - More examples and documentation at https://github.com/jzaefferer/jquery-validation */
  
var FormsValidation = function () {

    return {
        init: function () {
            
            /* usergroups.php Form Validations */
            $('#user-groups-create').validate({
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
                    group_name: {
                        required: true
                    },
                    group_level: {
                        required: true,
                        range: [2, 256]
                    }
                }
            });

            /* usergroups.php Form Validations */
            $('#user-groups-edit').validate({
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
                    group_name: {
                        required: true
                    },
                    group_level: {
                        required: true,
                        range: [2, 256]
                    }
                }
            }); 
           
        }
    };
}();