<?php
// Include PHPMailer library files
require 'C:/xampp/htdocs/document_generator/phpmailer/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/document_generator/phpmailer/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/document_generator/phpmailer/PHPMailer-master/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the recipient's email address
    $recipient_email = "snehaullurappa432002@gmail.com"; // Change this to your recipient's email address

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'snehau4302@gmail.com'; // SMTP username
        $mail->Password   = 'kyyoymuisuaofeej'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Sender and recipient settings
        $mail->setFrom('snehau4302@gmail.com', 'Sneha');
        $mail->addAddress('snehaullurappa432002@gmail.com'); // Add a recipient

        // Email subject and body
        $mail->isHTML(true);
        $mail->Subject = 'Internship Offer';

        // Get the content from the dynamic HTML
        ob_start();
        include 'C:/xampp/htdocs/document_generator/preview.php';
        $html_content = ob_get_clean();

        $mail->Body = $html_content;

        // Send email
        $mail->send();
        echo 'Email has been sent successfully!';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
