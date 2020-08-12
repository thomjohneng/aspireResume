<?php
    
//    $msg = "";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    
//    require './vender/autoload.php';
    
    include_once "PHPMailer/PHPMailer.php";
    include_once "PHPMailer/Exception.php";
    include_once "PHPMailer/SMTP.php";

    
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != "") {
            $file = "attachment/" . basename($_FILES['attachment']['name']);
            move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
        } else
            $file ="";
        
        $messageString = nl2br("Name: $name \r\n Email: $email \r\n\r\n $message");
        
        //send via SMTP
        $mail = new PHPMailer;
        
        $mail->isSMTP();
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = "aspire.resume.reviews@gmail.com";
        $mail->Password = "AspireResume123!";
//        $mail->SMTPSecure = "ssl"; //TLS
//        $mail->Port = 465; //587
        
        $mail->addAddress('aspire.resume.reviews@gmail.com');
        $mail->setFrom($email);
        $mail->Subject = "New Interested Resume Consultant Submission from: {$name}";
        
//        $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        
//        $mail->AltBody = 'This is a plain-text message body';
        
        $mail->isHTML(true);
        $mail->Body = $messageString;
//        $mail->Body = "Name: {$name} \r\n Email: {$email} \r\n\r\n {$message}";
        $mail->addAttachment($file);
        
        if (!$mail->send()) {
            echo "Message could not be sent. ";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
//            $msg = "Your email has been sent, thank you!";
        } else
//            $msg = "Please try again!"
//            echo 'Message Sent!';
            header("Location:confirmationPage.html");
        
        unlink($file);
    }
    
?>

