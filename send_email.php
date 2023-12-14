<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '././config/constants.php';
include_once '././lib/db_php.php';

function isValidAttachment($attachment): bool
{
    $allowedTypes = ['image/jpg', 'image/png', 'application/pdf']; // Add more allowed file types

    return in_array($attachment['type'], $allowedTypes);
}

function sendEmailViaMailTrap($sender, $recipient, $subject, $message, $attachment): bool
{
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        // Configure SMTP settings

        $mail->setFrom($sender);
        $mail->addAddress($recipient);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Handle attachments outside of this function

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Email could not be sent. PHPMailer Error: {$e->getMessage()}";
        return false;
    }
}

function insertEmailData($connection, $sender, $recipient, $subject, $message, $attachment): \PgSql\Result|false
{
    $query = "INSERT INTO emails (sender, recipient, subject, message, attachment) VALUES ($1, $2, $3, $4, $5)";

    return pg_execute($connection, "", array($sender, $recipient, $subject, $message, $attachment));
}

try {
    $connection = db_connect();

    // check to see if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sender = filter_var($_POST['sender'], FILTER_SANITIZE_EMAIL);
        $recipient = filter_var($_POST['recipient'], FILTER_SANITIZE_EMAIL);

        $subject = strip_tags($_POST['subject']);
        $message = strip_tags($_POST['message']);

        $attachment = $_FILES['filea'];

        // Handle attachment separately
        if (isValidAttachment($attachment)) {
            // Check file size
            $maxFileSize = 5000000; // 5 MB
            if ($_FILES["filea"]["size"] > $maxFileSize) {
                echo "Sorry, your file is too large.";
                // You might want to exit the script or handle this error in some way.
            } else {
                $safeFileName = generateSafeFileName($attachment['name']);
                $uploadPath = 'uploads/' . $safeFileName;
                move_uploaded_file($attachment['tmp_name'], $uploadPath);

                // Call sendEmailViaMailTrap here to send the email
                if (sendEmailViaMailTrap($sender, $recipient, $subject, $message, $uploadPath)) {
                    echo "Email sent successfully";
                    if (insertEmailData($connection, $sender, $recipient, $subject, $message, $uploadPath)) {
                        echo " and inserted safely into the database";
                    } else {
                        echo "But error storing the email in the database";
                    }
                } else {
                    echo "Email failed to send";
                }
            }
        } else {
            echo "Invalid attachment file type or size.";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}