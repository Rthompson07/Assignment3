<?php
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once 'config/constants.php';
include_once 'lib/db_php.php';

function insertEmailData($connection, $sender, $recipient, $subject, $message): \PgSql\Result|false
{
    $query = "INSERT INTO sent_emails (sender, recipient, subject, message) VALUES ($1, $2, $3, $4)";

    $result = pg_prepare($connection, "", $query);

    return pg_execute($connection, "", array($sender, $recipient, $subject, $message));
}

function sendEmailViaMailTrap($sender, $recipient, $subject, $message): bool
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '4060fd5a14e424';
        $mail->Password = '3e69569149264e';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;

        $mail->setFrom($sender);
        $mail->addAddress($recipient);
        $mail->isHTML(true);
        $mail->Subject = $subject;

        $mail->Body = $message;

        $mail->send();

        return true;

    }catch(Exception $e){
        echo "Email could not be sent. PHPMailer Error: {$mail->ErrorInfo}";
        return false;

    }
}

try{
    $connection = db_connect();

    // check to see if form is submitted
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $sender = filter_var($_POST['sender'], FILTER_SANITIZE_EMAIL);
        $recipient = filter_var($_POST['recipient'], FILTER_SANITIZE_EMAIL);

        $subject = strip_tags($_POST['subject']);
        $message = strip_tags($_POST['message']);

        if(sendEmailViaMailTrap($sender, $recipient, $subject, $message)){
            echo "Email sent successfully";
            if(insertEmailData($connection, $sender, $recipient, $subject, $message)){
                echo "and inserted safely into the database";
            }else{
                echo "But error storing the email in the database";
            }

        }else{
            echo "Email failed to send";
        }
    }

}catch (Exception $e){
    echo "Error: " . $e->getMessage();

}