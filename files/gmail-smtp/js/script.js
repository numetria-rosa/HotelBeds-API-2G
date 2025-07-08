$(window).load(function() {
    $("#loader").fadeOut("slow");
    $('#main').fadeIn("slow");
});
$(document).ready(function(){
    jQuery.validator.setDefaults({
		errorPlacement : function(error, element) {
			element.removeClass('has-success').addClass('has-error');
		}
	});
    $('#emailForm').validate( {
        submitHandler : function(form) {
            return false;
        },
        rules : {
            userEmail:{
                required: true,
                email: true
            },
			userName:{
				required : true,
				minlength : 3,
				maxlength : 50
			},
            subject: {
                required : true,
				minlength : 10
            },
            message: {
                required : true,
				minlength : 50
            }
        },
        messages : {
            userEmail:{
                required : "Please enter your Email"
            },
			userName:{
				required : "Please enter your name"
			},
            subject: {
                required : "Please enter your contact purpose",
				minlength : "Minimum length of subject must be 10 chars long."
            },
            message: {
                required : "Please enter your sweet message",
				minlength : "Minimum length of your message must be 50 chars long."
            }
        },
        errorPlacement : function(error, element) {
            $(element).closest('div.form-group').find('.help-block').html(error.html());
        },
        highlight : function(element) {
            $(element).closest('div.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
             $(element).closest('div.form-group').removeClass('has-error').addClass('has-success');
             $(element).closest('div.form-group').find('.help-block').html('');
        }
    });
    
    $(document).on('click', '#sendMailBtn', function(e){
        
       
        
        e.preventDefault();
        if( $('#emailForm').valid() ) {
			var sendMailBtn = $('#sendMailBtn');
			sendMailBtn.button('loading');
            $.ajax({
                url: 'ajax.php',
                method: 'post',
                dataType: 'json',
                data : { data: JSON.stringify($('#emailForm').serializeObject()) },
                success: function( response ){
					sendMailBtn.button('reset');
					$('input,textarea').val('');
                    showSuccessMessage();
                },
                error: function( response ) {
					sendMailBtn.button('reset');
					if( response.status === 400 || response.status === 403 || response.status === 500 ) {
						showWarningMessage(response.responseJSON.message);
					} else {
						showWarningMessage();
					}
                }
            });
        }
        
        return false;
    });
    
    function showSuccessMessage(){
        swal({
            title: "Many Thanks!!!",
            text: "Thanks for contacting us, We will get back to your inbox shortly...",
            type: "success",
            html: true
            /*imageUrl: "img/thumbs-up.jpg"*/
        });
    }
    
    function showWarningMessage(message){
		if(typeof message === 'undefined' || message === '' ) message = "Something went wrong, Please try again.";
        swal({
            title: "Oops...",
            text: message,
            type: "error",
            html: true
        });
    }
    
    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
});

