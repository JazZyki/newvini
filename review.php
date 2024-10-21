<?php
// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $cartype = htmlspecialchars($_POST['car-type']);
    $date = htmlspecialchars($_POST['repair-date']);
    $notice = htmlspecialchars($_POST['review']);

   
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }
 
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.jazzyki.cz'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'jakub.zykl@jazzyki.cz'; // SMTP username
        $mail->Password = 'janicka2009'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('jakub.zykl@jazzyki.cz', 'Recenze - Vinicars');
        $mail->addAddress('jakub.zykl@gmail.com', 'Příjemce'); // Add a recipient
        $mail->addAddress('info@vinicars.cz', 'Recipient'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Recenze na webu Vinicars';
        $mail->Body    = "Jméno: $name<br>
                          E-mail: $email<br>
                          Datum opravy: $date<br>
                          Typ automobilu: $cartype<br>
                          Poznámka: $notice";
        $mail->AltBody = "Jméno: $name\n
                          E-mail: $email\n
                          Datum opravy: $date\n
                          Typ automobilu: $cartype\n
                          Poznámka: $notice";

        $mail->send();
        echo "<script>alert('Zpráva byla odeslána. Děkujeme.'); window.location.href = 'recenze.html';</script>";
        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
