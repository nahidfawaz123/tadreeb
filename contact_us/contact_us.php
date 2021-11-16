<?php session_start();
    require('../db.php');

    if(isset($_POST['submit'])){

        //recive info from form
        $name = $_POST["name"];               // إسم المرسل ;
        $email = $_POST["email"];             // بريد المرسل 
        $subject = $_POST["subject"];         // عنوان الرسالة 
        $message = $_POST["message"]; 

        $mail_to = "imamutadreeb@gmail.com";     // بريد المستقبل  وهو هنا بريد الموقع;

        $msg = "Name: " . $name . "\n";
        $msg .= "Email: " . $email . "\n";
        $msg .= "Subject: " . $subject . "\n";
        $msg .= "Message: " . $message . "\n";


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
        //$mail->AddAttachment($img);      // attachment
        //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
        
        if(!$mail->Send()) {
        
        echo "<center><h4>Mailer Error: " . $mail->ErrorInfo."</h4></center>";
        
        } else {
        
            echo "<center><h4>Message sent!<h4></center><br>";
        
        }
    }


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>تواصل معنا</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <link rel="stylesheet" href="../css/home_provider_style.css">
    <link rel="stylesheet" href="../css/login_style.css">
    <link rel="stylesheet" href="../css/registeration_requist.css">
    <link rel="stylesheet" href="../css/registration_style.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/workshop_info_style.css">
</head>

<body dir="ltr">
<center>
    <br>
    <div class="container" >
			<div class="row">
                <?php

                    if(isset($_SESSION['id_t'])){
                        $query = "select * from trainess where id_trainess = ".$_SESSION['id_t']."";
                        $result = $con->query($query);
                        $row = $result->fetch_assoc();

                    }else if(isset($_SESSION['id_p'])){
                        $query = "select * from workshop_provider where id_provider = ".$_SESSION['id_p']."";
                        $result = $con->query($query);
                        $row = $result->fetch_assoc();
                    }

                ?>
				<div class="col-md-8" style="margin:0 auto; float:none;">
					<h3 align="center">تواصل معنا</h3>
					<br />
					<form name="sendEmail" method="post" action="contact_us.php" style="border:1px solid #aaa; border-radius:5px; padding:30px; box-shadow:0px 0px 10px #999;">
						<div class="form-group">
							<label>إسم المرسل :</label>
							<input type="text" name="name" placeholder="إدخل الإسم" class="form-control" style="text-align:center;" value="<?php if(isset($_SESSION['id_t'])){ echo $row['fullname']; } else if(isset($_SESSION['id_p'])){echo $row['department_name']; } ?>" />
						</div>
						<div class="form-group ">
							<label>البريد الإلكتروني للمرسل :</label>
							<input type="text" name="email" class="form-control" placeholder="أدخل البريد الإلكتروني" style="text-align:center;" value="<?php if(isset($_SESSION['id_t']) || isset($_SESSION['id_p'])){echo $row['email']; } ?>"  />
						</div>
						<div class="form-group">
							<label>موضوع الرسالة :</label>
							<input type="text" name="subject" class="form-control" placeholder="أدخل موضوع الرسالة" value="" required/>
						</div>
						<div class="form-group">
							<label>نص الرسالة :</label>
							<textarea name="message" class="form-control" placeholder="تص الرسالة" required></textarea>
						</div>
						<div class="form-group" align="center">
							<input type="submit" name="submit" value=" إرسال " class="btn btn-info" style="margin-left:10px;" /><a href="../index.php" class="btn btn-primary" style="color:white"> رجوع </a>
        
						</div>
					</form>
				</div>
			</div>
		</div>

</center>
 


    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>


</body>

</html>