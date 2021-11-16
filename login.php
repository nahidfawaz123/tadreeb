<?php session_start();
require("db.php");



if (isset($_SESSION['id_t'])){
    header("Location: index.php");
}
if (isset($_SESSION['id_p'])){
    header("Location: home_provider.php");
}
if (isset($_SESSION['id_A'])){
    header("Location: dashboard.php");
}


if (isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

        $query = "SELECT * FROM trainess WHERE username='$username' and password = md5('$password')";
        $result = $con->query($query);

        if($result->num_rows >0){

            $row = $result->fetch_assoc();
            $_SESSION['id_t'] = $row['id_trainess'];
            $_SESSION['username_t'] = $row['username'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");

        }

        $query = "SELECT * FROM workshop_provider WHERE username ='$username' and password = md5('$password') and status=1";
        $result = $con->query($query);

        $query_stopped = "SELECT * FROM workshop_provider WHERE username ='$username' and password = md5('$password') and status=0";
        $result_stopped = $con->query($query_stopped);

        if($result->num_rows >0){
            $row = $result->fetch_assoc();
            $_SESSION['id_p'] = $row['id_provider'];
            $_SESSION['username_p'] = $row['username'];
            header("Location: home_provider.php");

        }

        $query = "SELECT * FROM admin WHERE username ='$username' and password = md5('$password')";
        $result = $con->query($query);

        if($result->num_rows >0){
            $row = $result->fetch_assoc();
            $_SESSION['id_A'] = $row['id_admin'];
            $_SESSION['username_A'] = $row['username'];
            header("Location: dashboard.php");

        }
        
        if($result_stopped->num_rows >0){
            echo "<script> alert(' تم منع حسابك تواصل معنا لحل المشكلة ');</script>; ";
        }else{
            echo " <script> alert(' إسم المستخدم او كلمة المرور غير صحيحة ');</script>; ";
        }
       
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/home_provider_style.css">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/registeration_requist.css">
    <link rel="stylesheet" href="css/registration_style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/workshop_info_style.css">
</head>

<body onload="document.getElementById('u_name').value=''; document.getElementById('u_pass').value='';">
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
    <section>
        <div class="login_div">
            <div class="text-right login_header" style="background-color:#104e41; ">

                <p style="padding: 13px;padding-right: 23px;font-size: 21px;font-family: Abel, sans-serif;color: white;"><strong>تسجيل دخول</strong></p>
            </div>
            <div class="login_content">
                <form action="login.php" method="post" name="login" class="text-right login_form">

                    <label style="margin-top: 22px;font-size: 15px;">أسم المستخدم</label>
                    <input class="form-control" type="text" id="u_name" name="username" required>

                    <label style="margin-top: 14px;font-size: 15px;">كلمة المرور</label>
                    <input class="form-control" type="password" id="u_pass"name="password" required>
                    <a href="registration.php" style="margin-top:5px;">حساب جديد</a>  <div style="clear:both"></div>
                    <center>
                        <button class="btn btn-primary" type="submit" style="margin-top: 50px;width: 85px;background-color: #104e41;">دخول</button>
                        <a class="btn btn-primary" href="index.php" style="margin-top: 50px;width: 85px;background-color: #104e41;">إلغاء</a>
                    </center>
                </form>
            </div>
        </div>
    </section>
    <br>
    <br>
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