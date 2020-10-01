<?php
    $emailto = "vanshjain1224@gmail.com";

    $name = (isset($_POST['name']) ? $_POST['name']: '');
    $email = (isset($_POST['email']) ? $_POST['email']: '');
    $subject = (isset($_POST['subject']) ? $_POST['subject']: '');
    $body = (isset($_POST['message']) ? $_POST['message']: '');
    
    $header = "From:" . $email . "\r\n";
    
    $message = "A new message was sent to you from your website.\n\n";

    $message .= "Name: ";
    $message .= $name;
    $message .= "\n";

    $message .= "Email: ";
    $message .= $email;
    $message .= "\n\n";

    $message .= "Message: ";
    $message .= "\n";
    $message .= $body;

    mail($emailto, $subject, $message, $header)
?>