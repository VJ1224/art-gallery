<?php
    require '../vendor/autoload.php';
    use Mailgun\Mailgun;
    $mgClient = Mailgun::create('f05449ee3ab2e0475b6b226b10a2a006-07e45e2a-e63d5a39');
    $domain = "sandbox948ee93d6ea94682baed5886faff15d9.mailgun.org";
    
    $emailto = "vanshjain1224@gmail.com";

    $name = (isset($_POST['name']) ? $_POST['name']: '');
    $email = (isset($_POST['email']) ? $_POST['email']: '');
    $subject = 'ArtHub: '.(isset($_POST['subject']) ? $_POST['subject']: '');
    $body = (isset($_POST['message']) ? $_POST['message']: '');
    
    $message = "A new message was sent to you from ArtHub.\n\n";

    $message .= "Name: ";
    $message .= $name;
    $message .= "\n";

    $message .= "Email: ";
    $message .= $email;
    $message .= "\n\n";

    $message .= "Message: \n";
    $message .= $body;

    $result = $mgClient->messages()->send($domain, array(
        'from'	=> $name." ".$email,
        'to'	=> $emailto,
        'subject' => $subject,
        'text'	=> $message
    ));
?>