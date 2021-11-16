<?php session_start();
    require('db.php');
    

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>صفحة المدرب | الرئيسية | قائمة المتدربين في الدورة</title>
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
    <?php
        if(isset($_SESSION['username_P']) || isset($_SESSION['username_p'])){
            echo'
           <div class="dropdown" class="btn btn-primary menu_button" type="button" >
            <nav>
                 <button  class="btn btn-primary menu_button" type="button" > مرحبا بك ( '.$_SESSION['username_p'].' ) </button> 
                 <div class="dropdown-content">
                 <a href="logout.php">تسجيل خروج</a>
                 </div>
             </nav>    
             </div>
         ';
        }
    ?>
    </section>
    <section class="text-center content">
        <div class="workshop_div">
            <p class="section_header"><strong>المتدربين المسجلين في الدورة</strong></p>
            <div class="seprator_div" style="width:300px;"></div>
            <div class="text-right add_workshop_area">
                <a href="home_provider.php" class="btn btn-primary add_button" style="background-color: #104e41;">رجوع</a>
            </div>
            <div class="table-responsive text-nowrap" style="font-size: 15px;">
                <table class="table table-hover">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th>رقم</th>
                            <th>إسم المتدرب</th>
                            <th>البريد الإلكتروني</th>
                            <th>عرض الشهادة</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                            $count = 0;
                            $query = "select certification.id_trainess ,certification.id_workshop , trainess.id_trainess ,  trainess.fullname ,  trainess.email  from trainess join certification on trainess.id_trainess =  certification.id_trainess and certification.id_workshop  = ".$_GET["id_workshop"]."";
                            $result = $con->query($query);
                            while($row = $result->fetch_assoc()){
                             echo'
                                <tr>
                                    <td>'.$row['id_trainess'].'</td>
                                    <td>'.$row['fullname'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td><a href="certificate.php?show_certificate=true&id_workshop='.$row['id_workshop'].'&id_trainess='.$row['id_trainess'].'&trainess_name='.$row['fullname'].'&trainess_email='.$row['email'].'" class="btn btn-primary" type="button" style="background-color: #104e41;">عرض</a></td>
                                 </tr>                          
                            ';
                            $count++;
                            }
                       ?>
                    </tbody>
                </table>
                <?php
                    echo "<b> عدد المتدربين المسجلين في الدورة : ".$count."</b>";
                ?>
               
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