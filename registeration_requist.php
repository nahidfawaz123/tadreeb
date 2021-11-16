<?php session_start();
    require('db.php');
    

    
    if(isset($_POST['registeration_requist'])){
            if($_REQUEST['password'] == $_REQUEST['password2']){

                                                 
                if(preg_match('/^([A-Za-z0-9])+[@]{1}(imamu\.edu\.sa){1}$/' , $_REQUEST['email']) == false) 
                { 
                    echo '<script>alert("يجب ان يكون البريد الإلكتروني بالتنسيق الصحيح   example@imamu.edu.sa");</script>';
                } else {

                    
                    if(preg_match('/^(imam_){1}([A-Za-z0-9])+$/' , $_REQUEST['username']) == false) 
                    {
                         echo '<script>alert(" يجب أن يبدأ إسم المستخدم بالكلمة   ( _imam )  ");</script>';
                    }else{
                          
                        $q = "select * from workshop_provider where email = '".$_REQUEST['email']."'";
                        $res = $con->query($q);
                        if($res->num_rows >0){
                            echo "<script>alert('عنوان البريد  مستخدم  ');</script>";
                        }else{
                                
                                $department_name = stripslashes($_REQUEST['department_name']);
                                $username = stripslashes($_REQUEST['username']);
                                $password = stripslashes($_REQUEST['password']);
                                $email = stripslashes($_REQUEST['email']);
                                
                               
                                $department_name = mysqli_real_escape_string($con,$department_name); 
                                $username = mysqli_real_escape_string($con, $username); 
                                $password = mysqli_real_escape_string($con, $password);
                                $email = mysqli_real_escape_string($con, $email);

                                 $query = "INSERT into workshop_provider (username, department_name , password, email , status) VALUES ('$username','$department_name', md5('$password') , '$email' , 0)";
                                $result = mysqli_query($con,$query);
                                if($result){

                                    echo "<script> alert('تم إرسال الطلب  يرجى تسجيل الدخول بعد 24 ساعة '); window.location='index.php'; </script>";  

                                }else{ 

                                    echo "<script> alert('لم تتم عملية تسجيل الدخول بنجاح   ');</script>";  
                                }
                          }
                    }

                } 
        }else{

            echo "
                 <script> alert('كلمة المرور غير متطابقة');</script>;
            ";
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Trainer Registeration Request</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/home_provider_style.css">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/registeration_requist.css">
    <link rel="stylesheet" href="css/registration_style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/workshop_info_style.css">
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
    <section>
        <div class="requist_div">
            <div class="text-right requist_header"; style="background-color: #104e41;">
                <p style="padding: 13px;padding-right: 23px;font-size: 21px;font-family: Abel, sans-serif;color: rgb(231,234,237);"><strong>طلب تسجيل جهة تدريب</strong></p>
            </div>
            <div class="requist_content">
                <form name="reqiseration_requist_form" method="post" action="registeration_requist.php" class="text-right requist_form">
                    <label style="margin-top: 14px;font-size: 15px;"> جهة التدريب :</label>
                    <select name="department_name" class="form-control">
                        <optgroup label="جهة التدريب ">
                                <option value="عمادة التقويم والجودة">عمادة التقويم والجودة</option>
                                <option value="عمادة تقنية المعلومات">عمادة تقنية المعلومات</option>
                                <option value="عمادة تطوير المهارات">عمادة تطوير المهارات</option>
                                <option value="مركز التخطيط الاستراتيجي">مركز التخطيط الاستراتيجي</option>
                                <option value="مركز الدراسات والمعلومات">مركز الدراسات والمعلومات</option>
                                <option value="الاداره العامة للامن والسلامه">الاداره العامة للامن والسلامه</option>
                                <option value="المعهد العالي للقضاء">المعهد العالي للقضاء</option>
                                <option value="كلية الشريعة">كلية الشريعة</option>
                                <option value="كلية اللغه العربيه">كلية اللغه العربيه</option>
                                <option value="كلية أصول الدين">كلية أصول الدين</option>
                                <option value="كلية العلوم الاجتماعيه">كلية العلوم الاجتماعيه</option>
                                <option value="المعهد العالي لدعوة والاحتساب">المعهد العالي لدعوة والاحتساب</option>
                                <option value="كلية اللغات والترجمة">كلية اللغات والترجمة</option>
                                <option value="كلية الاعلام والاتصال">كلية الاعلام والاتصال</option>
                                <option value="معهد تعليم اللغة العربية">معهد تعليم اللغة العربية</option>
                                <option value="كلية الاقتصاد والعلوم الادارية">كلية الاقصتاد والعلوم الادارية</option>
                                <option value="كلية علوم الحاسب والمعلومات">كلية علوم الحاسب والمعلومات</option>
                                <option value="كلية الطب">كلية الطب</option>
                                <option value="كلية العلوم">كلية العلوم</option>
                                <option value="كلية التربية">كلية التربية</option>
                                <option value="عمادة شؤون الطالبات">عمادة شؤون الطالبات</option>
                                <option value="عمادة البرامج التحضيرية">عمادة البرامج التحضيرية</option>
                                <option value="عمادة القبول والتسجيل">عمادة القبول والتسجيل</option>
                                <option value="عمادة التعليم الالكتروني والتعليم عن بعد">عمادة التعليم الالكتروني والتعليم عن بعد</option>
                                <option value="عمادة البحث العلمي">عمادة البحث العلمي</option>
                                <option value="معهد الملك عبدالله للترجمة والتعريب">معهد الملك عبدالله للترجمة والتعريب</option>
                                <option value="عمادة شؤون المكتبات">عمادة شؤون المكتبات</option>
                                <option value="مركز خدمة المجتمع والتعليم المستمر">مركز خدمة المجتمع والتعليم المستمر</option>
                                <option value="مركز دراسات سوق العمل">مركز دراسات سوق العمل</option>
                                <option value="عمادة الابتكار وريادة الاعمال">عمادة الابتكار وريادة الاعمال</option>
                                <option value="معهد الامير نايف للبحوث والخدمات الاستثمارية">معهد الامير نايف للبحوث والخدمات الابتكارية</option>
                        </optgroup>
                    </select>
                    <label style="margin-top: 22px;font-size: 15px;">إسم المستخدم:</label>
                    <input class="form-control" type="text" name="username"  placeholder="imam_username" required>

                    <label style="margin-top: 14px;font-size: 15px;">البريد الإلكتروني :</label>
                    <input class="form-control" type="email" name="email" placeholder="example@imamu.edu.sa" required>

                    <label style="margin-top: 14px;font-size: 15px;">كلمة المرور :</label>
                    <input class="form-control" type="password" name="password" required>

                    <label style="margin-top: 14px;font-size: 15px;">تأكيد كلمة المرور :</label>
                    <input class="form-control" type="password" name="password2" required>
                    <center>
                            <button name="registeration_requist" class="btn btn-primary" type="submit" style="margin-top: 27px;width: 85px;;background-color: #104e41;">تسجيل</button>
                            <a href="index.php" class="btn btn-primary" style="margin-top: 27px;width: 85px;;background-color: #104e41;">إلغاء</a>
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