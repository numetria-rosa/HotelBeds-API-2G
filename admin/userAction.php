<?php
session_start();
include_once("files/DB_FUNCTION_INC.php");
$site = new SITE();

if (isset($_POST['action']) && ($_POST['action'] == "UserRegister")) {
    $username = addslashes(utf8_encode($_POST['username']));
    $useremail = addslashes(utf8_encode($_POST['useremail']));
    $telephone = addslashes(utf8_encode($_POST['full_number']));
    $password = addslashes(utf8_encode($_POST['password']));
    $CreatedAt = date("Y-m-d H:i:s");
    $Verified = 0;
    $Etat = 0;
    $INSERT = $site->UserRegister($username, $useremail, $telephone, md5($password), $CreatedAt, $Verified, $Etat);

    $_SESSION['USER']['id'] = $INSERT;
    $_SESSION['USER']['username'] = $username;
    $_SESSION['USER']['telephone'] = $telephone;
    $_SESSION['USER']['email'] = $useremail;
    $_SESSION['USER']['firstname'] = "";
    $_SESSION['USER']['lastname'] = "";
    $_SESSION['isUser'] = 1;
    $subject = "Bienvenue Chez Emna Voyages";
    $body = file_get_contents('email-templates/email.php');
    $body = str_replace("DummyTexttest", $username, $body);
    smtpmailer($useremail, $NOREPLY_EMAIL, $SITE_NAME, $subject, $body, $is_gmail = false);

    header("location:" . $WORKPATH . "backoffice.php");
}

if (isset($_POST['action']) && ($_POST['action'] == "UserLogin")) {
    $username = addslashes(utf8_encode($_POST['username']));
    $password = addslashes(utf8_encode($_POST['password']));
    $login = $site->UserLogin($username, md5($password));
    if (!empty($login) > 0) {
        $_SESSION['isUser'] = 1;
        $_SESSION['USER'] = $login;
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['action']) && ($_POST['action'] == "UserCheck")) {
    $emailcheck = 0;
    $usernamecheck = 0;

    $email = addslashes(utf8_encode($_POST['email']));

    $UserEmailCheck = $site->EmailCheck($email);

    if ($UserEmailCheck > 0) {
        $emailcheck = 1;
    }

    $username = addslashes(utf8_encode($_POST['username']));
    $UserNameCheck = $site->UserNameCheck($username);

    if ($UserNameCheck > 0) {
        $usernamecheck = 1;
    }

    $arr = [$usernamecheck, $emailcheck];

    print_r(json_encode($arr));

}

if (isset($_POST['action']) && ($_POST['action'] == "UserUpDateProfil")) {
    $username = addslashes(utf8_encode($_POST['username']));
    $telephone = addslashes(utf8_encode($_POST['full_number']));
    $firstname = addslashes(utf8_encode($_POST['firstname']));
    $lastname = addslashes(utf8_encode($_POST['lastname']));
    $UPDATE = $site->UserUpdate($username, $telephone, $firstname, $lastname, $_SESSION['USER']['id']);
    $_SESSION['USER']['username'] = $username;
    $_SESSION['USER']['telephone'] = $telephone;
    $_SESSION['USER']['firstname'] = $firstname;
    $_SESSION['USER']['lastname'] = $lastname;

    header("location:" . $WORKPATH . "backoffice.php");
}

if (isset($_POST['action']) && ($_POST['action'] == "UserforgetPassword")) {
    $emailcheck = 0;
    $email = addslashes(utf8_encode($_POST['lost_email']));
    $UserEmailCheck = $site->EmailCheck($email);
    if ($UserEmailCheck > 0) {
        $code = substr(uniqid('', true), -5);
        $emailcheck = 1;
        $subject = "code de réinitialisation du mot de passe";
        $body = file_get_contents('email-templates/emailmdp.php');
        $body = str_replace("DummyTextCode_V", "votre code de réinitialisation de mot de passe est <b>:" . $code . "</b>", $body);
        smtpmailer($email, $NOREPLY_EMAIL, $SITE_NAME, $subject, $body, $is_gmail = false);
        $_SESSION['USERID_FP'] = $UserEmailCheck;
        $_SESSION['USERCODE_FP'] = $code;
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['action']) && ($_POST['action'] == "CodeValidation")) {
    $code = addslashes(utf8_encode($_POST['code']));
    if ($code == $_SESSION['USERCODE_FP']) {
        unset($_SESSION['USERCODE_FP']);
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['action']) && ($_POST['action'] == "UpdatePassword")) {
    $password = addslashes(utf8_encode($_POST['password']));
    $update = $site->UpdatePassword(md5($password), $_SESSION['USERID_FP']);
    unset($_SESSION['USERID_FP']);
    echo 1;
}

?>