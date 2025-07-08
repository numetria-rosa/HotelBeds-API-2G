<?php
require_once 'config.php';
require 'vendor/autoload.php';

$response = [
	'status' => 'success',
	'message' => 'Mail sent successfully',
	'data' => []
];



//Checking is it ajax request
if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    //Invalid Ajax request
	http_response_code(403);
	$response = [
		'status' => 'error',
		'message' => 'Invalid request, please try again.',
		'data' => []
	];
	responseHandler($response);
}
  	
if( !isset($_POST['data']) ) {
    http_response_code(400);
    $response = [
        'status' => 'error',
        'message' => 'Empty post data.',
        'data' => []
    ];
    responseHandler($response);
}
$data = json_decode($_POST['data'], true); $errors = '';

//Email validation
if ( isset($data["userEmail"]) && !empty( $data["userEmail"] ) ) {
    $email = trim($data["userEmail"]);
    if ( filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $errors .= "$email is <strong>NOT</strong> a valid email address.<br/>";
    }
} else {
    $errors .= 'Please enter your email address.<br/>';
}
//Name Validation
if ( isset($data["userName"]) && !empty( $data["userName"] ) ) {
    $name = trim( $data["userName"] );
    if ( filter_var($name, FILTER_SANITIZE_STRING) === false){
        $errors .= 'Please enter a valid name.<br/>';
    } elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $errors .= 'Only letters and white space allowed for name...<br/>';
    }
} else {
    $errors .= 'Please enter your name.<br/>';
}

//Subject Validation
if ( isset($data["subject"]) && !empty( $data["subject"] ) ) {
    $subject = trim( $data["subject"] );
    if ( filter_var($subject, FILTER_SANITIZE_STRING) === false){
        $errors .= 'Please enter a subject to send.<br/>';
    }
} else {
    $errors .= 'Please enter a subject to send.<br/>';
}

//Message Validation
if ( isset($data["message"]) && !empty( $data["message"] ) ) {
    $message = trim( $data["message"] );
    if ( filter_var($message, FILTER_SANITIZE_STRING) === false){
        $errors .= 'Please enter a message to send.<br/>';
    }
} else {
    $errors .= 'Please enter a message to send.<br/>';
}



if(!empty( $errors )) {
    http_response_code(400);
    $response = [
        'status' => 'error',
        'message' => $errors,
        'data' => []
    ];
    responseHandler($response);
}

//Filtering out newlines in the email subject
$subject = str_replace(array("\r","\n"),array(" "," "),$subject);
$contactContent = file_get_contents('email_templates/contact.html');;
$parameters = ['name' => $name, 'to_name' => TO_NAME, 'message' => $message ];

if(! send_mail( $email, $subject, $contactContent, $parameters ) ){ 
    //Email sent failed.
    http_response_code(500);
    $response = [
        'status' => 'error',
        'message' => 'Email service failing temporarily Or Maybe you are entered invalid E-mail, Please enter valid email and try again.',
        'data' => []
    ];
    responseHandler($response);
} else {
    //Email successfully sent
    http_response_code(200);
    responseHandler($response);
} 

/**
 * responseHandler function
 * @param array $response request response
 */
function responseHandler($response)
{
	header('Content-type: application/json');
	echo json_encode($response);
	exit;
}

/**
 * send_mail function
 * @param  string $email             [[Description]]
 * @param  string $Subject           [[Description]]
 * @param  string $message           [[Description]]
 * @param  array [$parameters = []] [[Description]]
 * @return boolean  [[Description]]
 */

function send_mail($email, $Subject, $message, $parameters = []){
	////Parse the message with given parameters
	if( !empty( $parameters ) )$message = parse($message, $parameters);
    
    
    
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
	$mail->SMTPAuth = SMTP_AUTH;                               // Enable SMTP authentication
	$mail->Username = SMTP_USERNAME;
	$mail->Password = SMTP_PASSWORD;
	$mail->SMTPSecure = SMTP_SECURE;                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = SMTP_PORT;                                    // TCP port to connect to
	
    if( isset($parameters['name']) )  
        $mail->setFrom($email, $parameters['name']);
    else 
        $mail->setFrom($email);
    
    
	$mail->addAddress(TO_EMAIL);     // Add a recipient
	//$mail->addReplyTo($email, 'Smart Invoice V3 Promotion');
    $mail->addBCC(TO_EMAIL);
	
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = $Subject;
	
	$mail->Body = $message;
	$mail->AltBody = strip_tags($message);
	
	if(!$mail->send()) {//$mail->ErrorInfo;
        return false;
	} 
	return true;
}


/**
 * parse function
 * @param  string $message    [[Description]]
 * @param  array $parameters [[Description]]
 * @return string [[Description]]
 */
function parse($message, $parameters) {
	foreach ($parameters as $key => $value) {
		$message = str_replace('{'.$key.'}', $value, $message);
	}
	return $message;
}

