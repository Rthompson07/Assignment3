<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '././config/constants.php';
include_once '././lib/db_php.php';

function insertEmailData($connection, $sender, $recipient, $subject, $message, $attachment): \PgSql\Result|false
{
    $query = "INSERT INTO emails (sender, recipient, subject, message, attachment) VALUES ($1, $2, $3, $4, $5)";

    $result = pg_prepare($connection, "", $query);

    return pg_execute($connection, "", array($sender, $recipient, $subject, $message, $attachment));
}

/** @noinspection PhpInconsistentReturnPointsInspection */
function sendEmailViaMailTrap($sender, $recipient, $subject, $message, $attachment): bool
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '338b83183c199d';
        $mail->Password = 'aa5f7610cde092';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;

        $mail->setFrom($sender);
        $mail->addAddress($recipient);
        $mail->isHTML(true);
        $mail->Subject = $subject;

        $mail->Body = $message;
    } catch (Exception $e) {
        echo "Email could not be sent. PHPMailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

    function isValidAttachment($attachment): bool
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Add more allowed file types

        return in_array($attachment['type'], $allowedTypes);

        // Validate and handle the attachment
        if (isValidAttachment($attachment)) {
            $safeFileName = generateSafeFileName($attachment['name']);
            $uploadPath = 'uploads/' . $safeFileName;
            move_uploaded_file($attachment['tmp_name'], $uploadPath);


            $mail->addAttachment($uploadPath, $safeFileName);
        } else {
            throw new Exception('Invalid attachment file type.');
        }
        $mail->send();

        return true;
    }

    function generateSafeFileName($originalFileName)
    {
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $safeFileName = bin2hex(random_bytes(8)) . '.' . $extension;

        return $safeFileName;
    }


    try {
        $connection = db_connect();

        // check to see if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sender = filter_var($_POST['sender'], FILTER_SANITIZE_EMAIL);
            $recipient = filter_var($_POST['recipient'], FILTER_SANITIZE_EMAIL);

            $subject = strip_tags($_POST['subject']);
            $message = strip_tags($_POST['message']);

            $attachment = $_FILES['attachment'];

            if (sendEmailViaMailTrap($sender, $recipient, $subject, $message, $attachment)) {
                echo "Email sent successfully";
                if (insertEmailData($connection, $sender, $recipient, $subject, $message, $attachment)) {
                    echo " and inserted safely into the database";
                } else {
                    echo "But error storing the email in the database";
                }

            } else {
                echo "Email failed to send";
            }
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
}
