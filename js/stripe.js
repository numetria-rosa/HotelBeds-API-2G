// Stripe API Key
var stripe = Stripe(stripePublickey);
var elements = stripe.elements();
var elementStyles = {
    base: {
        border: '1px solid red !important',
    },
    invalid: {
        color: '#ff0000',
        ':focus': {
            color: '#ff0000',
        },
        '::placeholder': {
            color: '#ff0000',
        },
    },
};

var elementClasses = {
    focus: 'focus',
    empty: 'empty',
    invalid: 'invalid',
};

var cardNumber = elements.create('cardNumber', {
    style: elementStyles,
    classes: elementClasses,
});

cardNumber.mount('#example3-card-number');

var cardExpiry = elements.create('cardExpiry', {
    style: elementStyles,
    classes: elementClasses,
});

cardExpiry.mount('#example3-card-expiry');

var cardCvc = elements.create('cardCvc', {
    style: elementStyles,
    classes: elementClasses,
});

cardCvc.mount('#example3-card-cvc');

var form = document.getElementById('payment-form');

form.addEventListener('submit', function (event) {
    event.preventDefault();
    stripe.createToken(cardNumber).then(function (result) {
        if (result.error) {
            $('#errorpayment').text(result.error.message);
        } else {
            stripeTokenHandler(result.token);
        }
    });
});

// Send Stripe Token to Server
function stripeTokenHandler(token) {
    AdulteFirstName = [];
    AdulteLastName = [];
    ChildFirstName = [];
    ChildLastName = [];
    ChildAge = [];
    Remark = [];

    var Error = false;

    $('.input-text').each(function () {
        if ($(this).val() == '') {
            $(this).addClass('errorinput');
            Error = true;
        } else {
            $(this).removeClass('errorinput');
            var attr = $(this).attr('name');
            if (attr == 'AdulteFirstName[]') {
                AdulteFirstName.push($(this).val());
            }
            if (attr == 'AdulteLastName[]') {
                AdulteLastName.push($(this).val());
            }
            if (attr == 'ChildFirstName[]') {
                ChildFirstName.push($(this).val());
            }
            if (attr == 'ChildLastName[]') {
                ChildLastName.push($(this).val());
            }
            if (attr == 'ChildAge[]') {
                ChildAge.push($(this).val());
            }
        }
    });

    var form = document.getElementById('payment-form');
    // Add Stripe Token to hidden input
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    if (Error == false) {
        if (Error == false) {
            Remark.push($('.input-text2').val());
            $('#confirmpayement').prop('disabled', true);
            dataString = 'AdulteFirstName=' + AdulteFirstName + '&AdulteLastName=' + AdulteLastName + '&ChildFirstName=' + ChildFirstName + '&ChildLastName=' + ChildLastName + '&ChildAge=' + ChildAge + '&Remark=' + Remark + '&stripeToken=' + token.id + '&fname=' + $('#fname').val() +'&lname=' + $('#lname').val()+'&email=' + $('#pemail').val()+'&price=' + $('#pprice').val()+ '&action=CheckBooking';
            $.ajax({
                type: 'POST',
                url: '/stripe.php',
                data: dataString,
                success: function (msg, data, settings) {
                     if (msg == 'error') {
                       $('#confirmpayement').prop('disabled', false);
                       $('#errorpayment').innerText('error de payement');
                    } else{
                        $('#confirmpayement').prop('disabled', false);
                        window.location.href=WORKPATH+"Dashboard-booking.php";
                     }
                }
            });
        }
    }

}
