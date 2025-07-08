<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once("files/DB_FUNCTION_INC.php");
$site = new SITE();
require_once './jwt/jwt_utils.php';

// Set local path for testing
$WORKPATH = "http://dmc.local/";

if (isset($_POST['action']) && ($_POST['action'] == "UserRegister")) {
    if (isset($_POST['formkey']) && isset($_SESSION['formkeys'][$_POST['formkey']]) && ($_POST['formkeyCheck'] == "formkeyCheck")) {
        if ($_POST['tokentt'] == '') {
            unset($_SESSION['formkeys'][$_POST['formkey']]);
            $firstname = addslashes(utf8_encode($_POST['firstname']));
            $lastname = addslashes(utf8_encode($_POST['lastname']));
            $useremail = addslashes(utf8_encode($_POST['email']));
            $password = addslashes(utf8_encode($_POST['password']));
            $CreatedAt = date("Y-m-d H:i:s");
            $Verified = 0;
            $Etat = 1;
            $role = "B2C";
            $INSERT = $site->UserRegister($firstname, $lastname, $useremail, md5($password), $CreatedAt, $Verified, $Etat, $role, 0, "EUR", "1,2");
            $subject = "Welcome";
            $body = file_get_contents('email-templates/mailwelcome.php');
            $body = str_replace("user-text", "We are the most Dynamic planning tool in travel! Get ready to start planning your trip based on your interest, budget and travel preferences. To get your started, we have put together a few sample packages that you can customize online as you wish. ", $body);
            $body = str_replace("email-user", "Your username is " . $useremail, $body);
            $body = str_replace("header text", "Welcome", $body);
            $body = str_replace("url-text", $WORKPATH . "login.php", $body);
            smtpmailer($useremail, $NOREPLY_EMAIL, $SITE_NAME, $subject, $body, $is_gmail = false);
            header("Location: " . $WORKPATH . "login.php");
            exit();
        }
    }
}

if (isset($_POST['action']) && ($_POST['action'] == "UserCheck")) {
    $emailcheck = 0;
    $email = addslashes(utf8_encode($_POST['email']));
    $UserEmailCheck = $site->EmailCheck($email);
    if ($UserEmailCheck > 0) {
        $emailcheck = 1;
    }
    echo $emailcheck;
}

if (isset($_POST['action']) && ($_POST['action'] == "UserLogin")) {
    $email = addslashes(utf8_encode($_POST['email']));
    $password = addslashes(utf8_encode($_POST['password']));
    $login = $site->UserLogin($email, md5($password));
    if (!empty($login) > 0) {
        if ($login['etat'] == 1) {
            $_SESSION['agnMarkup'] = 0;
            $_SESSION['isUser'] = 1;
            $_SESSION['USER'] = $login;
            header("location:" . $WORKPATH . "index.php");
        } else {
            header("location:" . $WORKPATH . "login.php?error=true");
        }
    } else {
        header("location:" . $WORKPATH . "login.php?error=true");
    }
}

if (isset($_POST['action']) && ($_POST['action'] == "UserforgetPassword")) {
    $emailcheck = 0;
    $email = addslashes(utf8_encode($_POST['email']));
    $UserEmailCheck = $site->EmailCheck($email);
    if ($UserEmailCheck > 0) {
        $emailcheck = 1;
        $subject = "Password recovery";
        $headers = array('alg' => 'HS256', 'typ' => 'JWT');
        $payload = array('email' => $UserEmailCheck, 'exp' => (time() + 60 * 60));
        $jwt = generate_jwt($headers, $payload);
        $body = file_get_contents('email-templates/mail.php');
        $body = str_replace("user-text", "Please use the link below to reset your password", $body);
        $body = str_replace("email-user", "", $body);
        $body = str_replace("Your account is now activated", "", $body);
        $body = str_replace("Start now!", "Reset Password", $body);
        $body = str_replace("header text", "Password Recovery", $body);
        $body = str_replace("url-text", $WORKPATH . "resetpassword.php?auth=" . $jwt, $body);
        smtpmailer($email, $NOREPLY_EMAIL, $SITE_NAME, $subject, $body, $is_gmail = false);
        $_SESSION['USERID_FP'] = $UserEmailCheck;
        $_SESSION['USERCODE_FP'] = $code;
        header("location:" . $WORKPATH . "forget-password.php?email=true");
    } else {
        header("location:" . $WORKPATH . "forget-password.php?error=true");
    }
}

if (isset($_POST['action']) && ($_POST['action'] == "UpdatePassword")) {
    $json = json_decode($_SESSION['payload']);
    $password = addslashes(utf8_encode($_POST['password']));
    $update = $site->UpdatePassword(md5($password), $json->email);
    unset($_SESSION['payload']);
    header("location:" . $WORKPATH . "login.php");
}

if (isset($_POST['action']) && ($_POST['action'] == "UpdatePasswordProfil")) {
    $currentpassword =  addslashes(utf8_encode($_POST['currentpassword']));
    $checkpass = $site->Checkpassword(md5($currentpassword), $_SESSION['USER']['id']);
    if ($checkpass > 0) {
        $password = addslashes(utf8_encode($_POST['password']));
        $update = $site->UpdatePassword(md5($password), $_SESSION['USER']['id']);
        header("location:" . $WORKPATH . "Dashboard-Settings.php?updatePass=true#password");
    } else {
        header("location:" . $WORKPATH . "Dashboard-Settings.php?error=true#password");
    }
}

if (isset($_POST['action']) && ($_POST['action'] == "UserUpDateProfil")) {
    $telephone = addslashes(utf8_encode($_POST['telephone']));
    $firstname = addslashes(utf8_encode($_POST['firstname']));
    $lastname = addslashes(utf8_encode($_POST['lastname']));
    $address = addslashes(utf8_encode($_POST['address']));
    $cln_pays = addslashes(utf8_encode($_POST['cln_pays']));
    $cln_ville = addslashes(utf8_encode($_POST['cln_ville']));
    $UPDATE = $site->UserUpdate($telephone, $firstname, $lastname, $address, $cln_ville, $cln_pays, $_SESSION['USER']['id']);
    $_SESSION['USER']['firstname'] = $firstname;
    $_SESSION['USER']['lastname'] = $lastname;
    $_SESSION['USER']['telephone'] = $telephone;
    $_SESSION['USER']['adresse'] = $address;
    $_SESSION['USER']['code_ville'] = $cln_ville;
    $_SESSION['USER']['code_pays'] = $cln_pays;
    header("location:" . $WORKPATH . "Dashboard-Settings.php?update=true");
}

if (isset($_POST['action']) && ($_POST['action'] == "change_city")) {
    $alpha = $_POST['alpha'];
    $iS = $site->countTableWC("pays", "alpha2", $alpha);
    if ($iS > 0) {
        $P = $site->SelectObjectTableWC("pays", "alpha2", $alpha, "id_pays", "ASC");
        $id_pays = $P->id_pays;
        $V = $site->SelectFromTableWC("ville", "id_pays", $id_pays, "nom_eng", "ASC");
        $options = '<option value="">---</option>';
        foreach ($V as $ville) {
            $id_ville = $ville['id_ville'];
            $nom_eng = json_decode(json_encode($ville['nom_eng']));
            $options .= '<option value="' . $id_ville . '">' . $nom_eng . '</option>';
        }
    } else {
        $options = "";
    }
    echo $options;
}

if (isset($_POST['action']) && ($_POST['action'] == "newsletter")) {
    $email = addslashes(utf8_encode($_POST['email']));
    $UserEmailCheck = $site->EmailCheckletter($email);
    if ($UserEmailCheck > 0) {
        echo 0;
    } else {
        $insert = $site->InsertNewsletter($email);
        echo 1;
    }
}
