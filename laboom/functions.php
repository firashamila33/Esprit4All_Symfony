<?php

// Send Email
$send = '';

if( isset($_POST['email']) && !empty($_POST['email']) ){
	$send = send_message_to_agent( $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['subject'], $_POST['message'] );
	if( $send ){
		$send = 
		"<div class='alert alert-success alert-dismissible' role='alert'>
        	<button type='button' class='close'><label aria-hidden='true'>&times;</label></button>
			<label class='alert-message'>Thank You! Your inquiry submitted successfully. we will contact you very soon.</label>
        </div>";        
	} else {
		$send = 
		"<div class='alert alert-danger alert-dismissible' role='alert'>
        	<button type='button' class='close'><label aria-hidden='true'>&times;</label></button>
			<label class='alert-message'>Oops! Something went wrong. We couldn't send your message. Please try again later.</label>
        </div>";
	}
} else {
	$send = 
	"<div class='alert alert-danger alert-dismissible' role='alert'>
    	<button type='button' class='close'><label aria-hidden='true'>&times;</label></button>
		<label class='alert-message'>Oops! Something went wrong. We couldn't send your message. Please try again later.</label>
    </div>";
}

function send_message_to_agent( $first_name, $last_name, $email, $subject, $message ){
	
	$to       = 'info@laboom.com';
	
	$message  = '<p>First Name : '.$first_name.'</p>';
	$message .= '<p>Last Name : '.$last_name.'</p>';
	$message .= '<p>Email Address : '.$email.'</p>';
	$message .= '<p>Message : '.$message.'</p>';
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "From: support@despina.com\r\n";
	
	return mail($to, $subject, $message, $headers);
}

echo $send;

?>
