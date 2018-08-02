<?php

	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$subject = trim($_POST['subject']);
	$message = trim($_POST['message']);
	
	$emailTo = 'hello@greenx.network'; //Put your own email address here
	if (empty($subject)) {
	    $subject = 'Message from AlphaX Technologies.';
	}
	$body = "Name: $name \n\nEmail: $email \n\nPhone: $phone \n\nMessage:\n$message";
	$headers = 'From: '.$email."\r\n" .
        'Reply-To: '.$email."\r\n";

	mail($emailTo, $subject, $body, $headers);
	$emailSent = true;
	echo ('success');
	
?>
