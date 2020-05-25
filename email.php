<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sub=$_POST['subject'];
$email=$_POST['email'];
$con=$_POST['content'];
$name=$_POST['name'];
$sub= "=?UTF-8?B?".base64_encode($sub)."?=";
$name="=?UTF-8?B?".base64_encode($name)."?=";
$te='高雄水資源平台';
$te= "=?UTF-8?B?".base64_encode($te)."?=";
$op='已收到您的意見';
$op= "=?UTF-8?B?".base64_encode($op)."?=";

// Load Composer's autoloader
//require 'vendor/autoload.php';
require '/PHPMailer/src/Exception.php';
require '/PHPMailer/src/PHPMailer.php';
require '/PHPMailer/src/SMTP.php';
// I/nstantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail2 = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'stukwater@gmail.com';                    // SMTP username
    $mail->Password   = 'waterhunter';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('stukwater@gmail.com', $name);
    $mail->addAddress('stukwater@gmail.com', $te);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = nl2br($con);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header("refresh:1;url=contact.html");

    $mail2->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail2->isSMTP();                                            // Set mailer to use SMTP
    $mail2->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail2->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail2->Username   = 'stukwater@gmail.com';                    // SMTP username
    $mail2->Password   = 'waterhunter';                               // SMTP password
    $mail2->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail2->Port       = 465;                                    // TCP port to connect to
    $mail2->setFrom('stukwater@gmail.com', $te);
    $mail2->addAddress($email, $name);
    //$mail2->addReplyTo('info@example.com', 'Information');
    //$mail2->addCC('cc@example.com');
    //$mail2->addBCC('bcc@example.com');
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $op;
    $mail2->Body    = nl2br('感謝您寶貴的意見，我們會參考並進行改進');
    $mail2->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail2->send();


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
<script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
    
</script>