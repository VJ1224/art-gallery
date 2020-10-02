<?php
    $emailto = "vanshjain1224@gmail.com";

    $name = (isset($_POST['name']) ? $_POST['name']: '');
    $email = (isset($_POST['email']) ? $_POST['email']: '');
    $subject = (isset($_POST['subject']) ? $_POST['subject']: '');
    $body = (isset($_POST['message']) ? $_POST['message']: '');
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From:" . $email . "\r\n";
    
    $message = "A new message was sent to you from ArtHub.\n\n";

    $message .= "Name: ";
    $message .= $name;
    $message .= "\n";

    $message .= "Email: ";
    $message .= $email;
    $message .= "\n\n";

    $message .= "Message: \n";
    $message .= $body;

    mail($emailto, $subject, $message, $headers)
?>