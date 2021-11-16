

<?php
    require('db.php');

    if (isset($_REQUEST['username'])){

        if($_REQUEST['password'] == $_REQUEST['re_password']){

          
            $q = "select * from trainess where email = '".$_REQUEST['email']."'";
            $res = $con->query($q);
            if($res->num_rows >0){
                echo "<script>alert('   عذراً يبدو أن البريد الالكتروني  مستخدم سابقاً');</script>";
            }else{
               
                $fullname = stripslashes($_REQUEST['fullname']);
                $username = stripslashes($_REQUEST['username']);
                $password = stripslashes($_REQUEST['password']);
                $email = stripslashes($_REQUEST['email']);
                
               
                $fullname = mysqli_real_escape_string($con, $fullname); 
                $username = mysqli_real_escape_string($con, $username); 
                $password = mysqli_real_escape_string($con, $password);
                $email = mysqli_real_escape_string($con, $email);

                $query = "INSERT into trainess (username, fullname, password, email) VALUES ('$username','$fullname', md5('$password') , '$email')";
                $result = mysqli_query($con,$query);
                if($result){

                    echo "<script> alert('تم التسجيل بنجاح'); window.location='index.php'; </script>"; 
                    
                }else{

                    echo "<script> alert('لم تتم عملية التسجيل  بنجاح   ');</script>";  
                }

            }
        }else{
                    
            echo " <script> alert('كلمة المرور غير متطابقة');</script>; ";
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>تسجيل متدرب جديد</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/home_provider_style.css">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/registeration_requist.css">
    <link rel="stylesheet" href="css/registration_style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/workshop_info_style.css">

    
    <script type="text/javascript" src="QR_Code/js/jquery.js"></script>
	<script type="text/javascript" src="QR_Code/js/qrcode.js"></script>
    <script src="QR_Code/js/html2canvas.js"></script>
    
</head>

<body>
    <section class="header">
        <div class="text-center logo_div"><img class="logo_image" src="images/logo.png">
            <p class="text-center site_name"><strong>موقع تدريب</strong></p>
            <p style="font-size: 14px;color: rgb(249,249,249);"><strong>جامعة الإمام محمد بن سعود الإسلامية</strong></p>
        </div>
    </section>
    
    <section class="text-right menu">
    <div>
       
       <a href="login.php" class="btn btn-primary menu_button" type="button">دخول</a> 
       <a href="index.php" class="btn btn-primary menu_button" type="button"> الصفحة الرئسية </a> 
       
       </div> 

    
    
 </section>
    <section style="margin-bottom: 90px; ">
        <div class="registeration_div">
            <div class="text-right registeration_header "style="background-color:#104e41; padding: 50px;">
                
        
                <p style="padding: -200px;padding-right: -100px;font-size: 21px;font-family: Abel, sans-serif;color: white;"><strong>تسجيل متدرب جديد</strong></p>
            </div >
            <div class="riegisteration_content">
                <form  name="registration" action="registration.php" method="post" class="text-right registeration_form" style="background-color: white;">
                    <p style="margin-bottom: 0px;color: #104e41;font-size: 16px;"><br> ارجوا كتابة الأسم بشكل صحيح كما تريد أن يظهر في الشهادة.<br></p>
                    
                    <label style="color: #104e41; margin-top: 4px;font-size: 15px;padding-top: 7px;">الإسم الثلاثي</label>
                    <input id="fullname" class="form-control" type="text" name="fullname" placeholder="أدخل أسمك الثلاثي" required>
                    
                    <label style="color: #104e41; margin-top: 14px;font-size: 15px;">البريد الإلكتروني </label>
                    <input id="email" class="form-control" type="email" name="email"  placeholder="أدخل البريد الالكتروني " required>
                   
                    <label style="color: #104e41; margin-top: 14px;font-size: 15px;">أسم المستخدم </label>
                    <input id="username" class="form-control" type="text" name="username" placeholder="أدخل أسم المستخدم" required>
                    
                    <label style="color: #104e41; margin-top: 14px;font-size: 15px;">كلمة المرور </label>
                    <input id="password" class="form-control" type="password" name="password" placeholder="كلمة المرور"required>
                   
                    <label style="color: #104e41; margin-top: 14px;font-size: 15px;">تأكيد كلمة المرور </label>
                    <input id="re_password" class="form-control" type="password" name="re_password" placeholder="تأكيد كلمة المرور" required>
                    <center>
                             
                            <button class="btn btn-primary" type="submit" style="margin-top: 50px;width: 85px;background-color: #104e41;">تسجيل</button>
                            <a  href="index.php" class="btn btn-primary" type="button" style="margin-top: 50px;width: 85px;background-color: #104e41;">إلغاء</a>
                    </center>
                </form>
               
            </div>
        </div>
    </section>
    <section class="footer"><div class="text-center logo_div" >


   
           
           <br>

           <p class="text-center site_name">تواصل معنا</p>
          
           <a href="contact_us/contact_us.php">
        <img  class="text-center site_name" src="images/email.png"
        width ="30" height = "30"></a>
       </div></section>


    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>


</body>

</html>