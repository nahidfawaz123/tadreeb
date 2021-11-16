
<?php


    //recive info from form
    $name = $_POST["sender_name"];               // إسم المرسل  وهو هنا إسم الموقع;
    $email = $_POST["email"];             // بريد المرسل و هو هنا بريد الموقع
    $subject = $_POST["subject"];         // عنوان الرسالة ---  بطاقة الدورة
    $message = $_POST["message"];          //  نص الرسالة ---  هذه بطاقة الدورة الخاصة بك
    

    //للتفريق هل الصورة قادمة من صفحة البطاقة أم من صفحة الشهادة
    $img = "../";
    if(isset($_POST["cart_image_path"])){
      $img .= $_POST["cart_image_path"];
    }
    if(isset($_POST["certificate_image_path"])){
      $img .= $_POST["certificate_image_path"];
    }
  
    //email configuration

    $mail_to = $_POST["trainess_email"];   // بريد المستقبل  وهو هنا بريد المتدرب;

    $msg = "Name: " . $name . "\n";
    $msg .= "Email: " . $email . "\n";
    $msg .= "Subject: " . $subject . "\n";
    $msg .= "Message: " . $message . "\n";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Send an Email on Form Submission using PHP with PHPMailer</title>
		<link rel="stylesheet" href="bootstrap.css" />
		<script src="bootstrap.min.js"></script>
	</head>
	<body>

        <?php

            require 'class.phpmailer.php';

            $mail             = new PHPMailer(); // defaults to using php "mail()"

            //$body             = file_get_contents('contents.html');
            //$body             = eregi_replace("[\]",'',$body);
            //$mail->AddReplyTo("name@yourdomain.com","First Last");
            $mail->SetFrom($email, 'Tadteeb Website');
            //$mail->AddReplyTo("name@yourdomain.com","First Last");         
            $address = $mail_to;
            $mail->AddAddress($address, "workshop trainess");
            $mail->Subject    = $subject;   
            //$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->MsgHTML($msg);
            //$img = "../Cards/Nahid_1_1_Card.jpeg";
            $mail->AddAttachment($img);      // attachment
            //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
            
            if(!$mail->Send()) {
            
              echo "Mailer Error: " . $mail->ErrorInfo;
            
            } else {
            
                echo "<center><h3>Message sent!<h3></center><br>";

                if(isset($_POST["cart_image_path"])){
                  echo '<br><center><a href="../my_workshop.php" class="btn btn-primary" style="color:white">back</a></center>';
                }
                if(isset($_POST["certificate_image_path"])){
                  echo '<br><center><a href="../workshop_trainess.php?id_workshop='.$_REQUEST['id_workshop'].'" class="btn btn-primary" style="color:white">back</a></center>';
                }
              
            }
        ?>

    </body>
</html>