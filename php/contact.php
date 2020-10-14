<?php
require '../vendor/autoload.php';
$ini = parse_ini_file('../setup.ini');
use Mailgun\Mailgun;

$mgClient = Mailgun::create($ini["MAILGUN"]);
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