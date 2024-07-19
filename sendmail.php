<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $cv = $_FILES['cv'];

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Host = 'smtp.gmail.com';                     // Set the SMTP server to send through
        $mail->Username = 'kaushikbiswascse@gmail.com';                     // SMTP username
        $mail->Password = 'acedoxviqprrhvfg';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
        $mail->Port = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('kaushikbiswascse@gmail.com', 'Kaushik Vishwas');
        $mail->addAddress('kaushikbiswascse@gmail.com', 'Vishwas Kaushik');     // Add a recipient

        // Attachments
        if ($cv['error'] == UPLOAD_ERR_OK) {
            $mail->addAttachment($cv['tmp_name'], $cv['name']);
        } else {
            throw new Exception('Error uploading file.');
        }

        // Content
        $mail->isHTML(true);       // Set email format to HTML
        $mail->Subject = 'New Enquiry - Kaushik Vishwas Contact Form';
        $mail->Body = '<h3>Hello You Got a New Enquiry</h3>
            <h3>Name : ' . $name . '</h3>
            <h3>Age : ' . $age . '</h3>
            <h3>Gmail : ' . $email . '</h3>
            <h3>Message : ' . $message . '</h3>';

        if ($mail->send()) {
            $_SESSION['status'] = "Thank you for contacting us - Kaushik Vishwas";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    header('Location: index.php');
    exit(0);
}
?>