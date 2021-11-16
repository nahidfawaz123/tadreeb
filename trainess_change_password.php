<?php session_start();

    require('db.php');
    

    if(isset($_GET['update_btn'])){

        if($_REQUEST['new_password'] == $_REQUEST['re_new_password']){

            $query = "select * from trainess where  password = md5('".$_GET['current_password']."') ";
            $result = mysqli_query($con , $query);
            if(mysqli_num_rows($result) >0){
               
                $username = $_REQUEST['username'];
                $password = $_REQUEST['new_password'];
    
                    $query = "update trainess set username = '$username',password = md5('$password') where id_trainess = ".$_REQUEST['id_trainess']."";
                    $result = mysqli_query($con,$query);
                    if($result){
        
                        echo "<script> alert('تم التعديل بنجاح'); window.location='index.php'; </script>";  
        
                    }else{
                        echo "<script> alert('لم تتم عملية تحديث المعلومات بنجاح   '); !!</center>";
                    }

                }else{
                    
                    echo "
                        <script> alert('كلمة المرور الحالية غير صحيحة');</script>;
                    ";
                }

            }else{
                echo "
                    <script> alert('كلمة المرور غير متطابقة');</script>;
                ";
            }

            unset($_GET['update_btn']);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Trainess Profile</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/home_provider_style.css">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/registeration_requist.css">
    <link rel="stylesheet" href="css/registration_style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/workshop_info_style.css">
    <link rel="stylesheet" href="css/trainess_profile.css">
</head>

<body>
    <section class="header">
        <div class="text-center logo_div"><img class="logo_image" src="images/logo.png">
            <p class="text-center site_name"><strong>موقع تدريب</strong></p>
            <p style="font-size: 14px;color: rgb(249,249,249);"><strong>جامعة الإمام محمد بن سعود الإسلامية</strong></p>
        </div>
    </section>
    <section style="margin-bottom: 73px;">
        <div class="profile_div">
            <div>
                <form name="trainess_profile_form" method = "get" action = "trainess_change_password.php" class="text-right">

                    <?php
                        if(isset($_GET['id_trainess'])){

                            $query = "SELECT * FROM trainess where id_trainess = ".$_GET['id_trainess']."";
                            $result = $con->query($query);
                            $row = $result->fetch_assoc();
                        }
                    ?>

                    <p class="text-center" style="margin-bottom: 0px;color: #104e41;font-size: 21px;">   تعديل الملف الشخصي</p>
                    
                    <input class="form-control" type="hidden" name="id_trainess" value="<?php if(isset($_GET['id_trainess'])) echo $row['id_trainess']; ?>" required />

                    <label style="margin-top: 14px;font-size: 15px;">إسم المستخدم :</label>
                    <input class="form-control" type="username" name="username" value="<?php if(isset($_GET['id_trainess'])) echo $row['username']; ?>" required />

                    <label style="margin-top: 14px;font-size: 15px;">كلمة المرور الحالية :</label>
                    <input class="form-control" type="password" name="current_password" value="" required />
                   
                    <label style="margin-top: 14px;font-size: 15px;">كلمة المرور الجديدة :</label>
                    <input class="form-control" type="password" name="new_password" value="" required />
                   
                    <label style="margin-top: 14px;font-size: 15px;">تأكيد كلمة المرور :</label>
                    <input class="form-control" type="password" name="re_new_password" value="" required />
                   
                    <button name="update_btn" class="btn btn-primary" type="submit" style="margin-top: 50px;width: 85px;background-color: #104e41;">حفظ</button>
                    <a name="cancel_btn" href="trainess_profile.php?id_trainess=<?php echo $_GET['id_trainess']; ?>" class="btn btn-primary" type="link" style="margin-top: 50px;width: 85px;background-color:#104e41;">رجوع</a>

                </form>
            </div>
        </div>
    </section>
    <section class="footer"><div class="text-center logo_div" >

           <br>

        
       </div></section>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>