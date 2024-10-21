<?php
// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $carbranch = htmlspecialchars($_POST['car-branch']);
    $cartype = htmlspecialchars($_POST['car-type']);
    $spz = htmlspecialchars($_POST['spz']);
    $descruction = htmlspecialchars($_POST['flexRadio']);
    $insurance = htmlspecialchars($_POST['combo-select-insurance']);
    $insuranceOther = htmlspecialchars($_POST['insurance-name']);
    $insuranceNumber = htmlspecialchars($_POST['insurance-number']);
    $repairPlace = htmlspecialchars($_POST['repair-place']);
    $notice = htmlspecialchars($_POST['notice']);

    $descructionOther = isset($_POST['dest-description']) ? htmlspecialchars($_POST['dest-description']) : '';
    
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
        $mail->setFrom('jakub.zykl@jazzyki.cz', 'Poptavka - Vinicars');
        $mail->addAddress('jakub.zykl@gmail.com', 'Recipient'); // Add a recipient
        $mail->addAddress('info@vinicars.cz', 'Recipient'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Poptávka servisu - Vinicars';
        $mail->Body    = "Jméno: $name<br>
                          Příjmení: $surname<br>
                          Telefon: $phone<br>
                          E-mail: $email<br>
                          Značka automobilu: $carbranch<br>
                          Typ automobilu: $cartype<br>
                          SPZ: $spz<br>
                          Typ poškození: $descruction<br>
                          Jiné poškození: $descructionOther<br>
                          Pojišťovna: $insurance<br>
                          Pojišťovna (jiná): $insuranceOther<br>
                          ČPU: $insuranceNumber<br>
                          Místo opravy: $repairPlace<br>
                          Poznámka: $notice";
        $mail->AltBody = "Jméno: $name\n
                          Příjmení: $surname\n
                          Telefon: $phone\n
                          E-mail: $email\n
                          Značka automobilu: $carbranch\n
                          Typ automobilu: $cartype\n
                          SPZ: $spz\n
                          Typ poškození: $descruction\n
                          Jiné poškození: $descructionOther\n
                          Pojišťovna: $insurance\n
                          Pojišťovna (jiná): $insuranceOther\n
                          ČPU: $insuranceNumber\n
                          Místo opravy: $repairPlace\n
                          Poznámka: $notice";

         // Handle file upload
        if (!empty($_FILES['file']['name'][0])) {
            foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['file']['name'][$key];
                $file_type = $_FILES['file']['type'][$key];
                $file_tmp_name = $_FILES['file']['tmp_name'][$key];
                $file_error = $_FILES['file']['error'][$key];
                $file_size = $_FILES['file']['size'][$key];

                // Debugging output
                echo "File name: $file_name<br>";
                echo "File type: $file_type<br>";
                echo "File temp name: $file_tmp_name<br>";
                echo "File error: $file_error<br>";
                echo "File size: $file_size<br>";

                if ($file_error === UPLOAD_ERR_OK) {
                    // Attach the file
                    $mail->addAttachment($file_tmp_name, $file_name);
                } else {
                    echo "Error uploading file: $file_name<br>";
                    switch ($file_error) {
                        case UPLOAD_ERR_INI_SIZE:
                            echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.<br>";
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.<br>";
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            echo "The uploaded file was only partially uploaded.<br>";
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            echo "No file was uploaded.<br>";
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            echo "Missing a temporary folder.<br>";
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            echo "Failed to write file to disk.<br>";
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            echo "A PHP extension stopped the file upload.<br>";
                            break;
                        default:
                            echo "Unknown upload error.<br>";
                            break;
                    }
                    exit;
                }
            }
        }

        $mail->send();
        echo "<script>alert('Zpráva byla odeslána. Děkujeme.'); window.location.href = 'poptavka.html';</script>";
        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
