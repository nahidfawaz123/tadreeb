<?php session_start();
    require('db.php');
    

    
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>موقع تدريب | دوراتي</title>
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
        <div class="text-center logo_div">
            <img class="logo_image" src="images/logo.png">
            <p class="text-center site_name"><strong>موقع تدريب</strong></p>
            <p style="font-size: 14px;color: rgb(249,249,249);"><strong>جامعة الإمام محمد بن سعود الإسلامية</strong></p>
        </div>
    </section>
    <section class="text-right menu">
    
    <?php
        
        if(isset($_SESSION['username_t']) ){
            echo'
           
            <div class="dropdown" class="btn btn-primary menu_button" type="button" >
            <nav>
                 <button  class="btn btn-primary menu_button" type="button" > مرحبا بك ( '.$_SESSION['fullname'].' ) </button> 
                 <div class="dropdown-content">
                 <a href="trainess_profile.php?id_trainess='.$_SESSION['id_t'].'">تعديل الملف الشخصي</a>
                 <a href="logout.php">تسجيل خروج</a>
                 </div>
             </nav>    
             </div>
         ';
        }else{
            echo '
                <a href="login.php" class="btn btn-primary menu_button" type="button">دخول</a> 
                <a href="registration.php" class="btn btn-primary menu_button" type="button">تسجيل متدرب</a> 
                <a href="registeration_requist.php" class="btn btn-primary menu_button" type="button">طلب تسجيل جهة تدريب</a> 
            ';

        }
    ?>
 
       </div> 

    
    
 </section>
    <section class="text-center content">

      
        
        <div class="workshop_div">
            <p class="section_header"><strong>دوراتي</strong></p>
            <div class="seprator_div"></div>
                <table class="table table-hover">
                    <thead style="background-color: white;">
                        <tr>
                            
                            <th>إسم الدورة</th>
                            <th> التاريخ</th>
                            <th>مكان الدورة</th>
                            <th>جهة التدريب</th>
                            <th>عرض البطاقة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $query = "select trainess.* , workshop.* , certification.* , workshop_provider.department_name from trainess, workshop, certification , workshop_provider where workshop.id_workshop = certification.id_workshop and trainess.id_trainess = certification.id_trainess and workshop_provider.id_provider = workshop.id_workshop_provider and trainess.id_trainess = ".$_SESSION['id_t'].";";

                            $result = $con->query($query);
                            while($row=$result->fetch_assoc()){
                                echo '
                                    <tr>
                                        
                                        <td>'.$row['title'].'</td>
                                        <td>'.$row['date_workshop'].'</td>
                                        <td>'.$row['location'].'-'.$row['section_location'].'-'.$row['section_number'].'</td>
                                        <td>'.$row['department_name'].'</td>
                                        <td><a href="trainess_card.php?show_card=true&id_trainess='.$_SESSION['id_t'].'&id_workshop='.$row['id_workshop'].'" class="btn btn-primary" type="button" style="padding: 3px;padding-top: 0px;width: 52px;font-size: 15px;height: 30px;padding-bottom: 6px; background-color: #104e41;">عرض</a></td>
                                    </tr>
                                    ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </section>

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