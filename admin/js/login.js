
var HOME = "https://dmc.local/admin/";
//var HOME = "/superAdmin/";
$(".login_content form .submit").click(function (){
    //alert(HOME);
    var Error   = false;
    action      = "login_form";
    Email       = $("#Email").val();
                Login         = $("#Login").val();
                Password            = $("#Password").val();
    
    dataString  = "Email=" + encodeURIComponent(Email) + "&Login=" + encodeURIComponent(Login) + "&Password=" + encodeURIComponent(Password) + "&action=" + action;
    //alert(dataString);

    if(Error == true){
        return false;
    }else{
        
        $.ajax({
            type: 'POST',
            url: HOME+'files/functions_confirm.php',
            data: dataString,
            success: function (msg,data,settings) {
                if(data == 'success' ){
                    //alert(msg);
                    $('.alert').removeClass('no-display');
                
                    if ( msg == "AIG") {
                        $('.alert').addClass('no-display');
                        $('.alert').removeClass('alert-info');
                        $('.alert').text('All is Good');
                        $('.alert').addClass('alert-success');
                        window.location.href = HOME;
                    }else if ( msg == "AID") {
                        $('.alert').text('Ce Compte est désactivé.');
                        $('.alert').addClass('alert-info');
                    }else if ( msg == "CAI") {
                        $('.alert').text('Le Login / Mot de Passe est incorrect.');
                        $('.alert').addClass('alert-info');
                    }else if ( msg == "AIB") {
                        $('.alert').text('Veuillez vérifier vos entrées.');
                        $('.alert').addClass('alert-info');
                    }else{

alert(msg);

                        $('.alert').removeClass('alert-info');
                        $('.alert').text('Une erreur s\'est produite.');
                        $('.alert').addClass('alert-warning');
                    }
                }
            }
        });
    }
});