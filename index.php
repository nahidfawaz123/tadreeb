<?php session_start();
    require('db.php');
    
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>موقع تدريب | الرئيسية</title>
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
                 <a href="my_workshop.php">دوراتي</a>
                 <a href="logout.php">تسجيل خروج</a>
                 </div>
             </nav>    
             </div>
         ';
        }else if(isset($_SESSION['username_p']) ){
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
            <p class="section_header"><strong>إعلانات ورش العمل</strong></p>
            <div class="seprator_div"></div>
            <form name="search" method="get" action="index.php">
                <div class="text-right search_area">
                    <input type="text" class="search_input" id="search_word" name="search_word" placeholder="إدخل كلمة البحث هنا" value="<?php if(isset($_GET['search_btn'])) echo $_GET['search_word']; ?>"><button name="search_btn" class="btn btn-primary search_button">بحث</button> <button name="show_all" class="btn btn-primary search_button" style="width:100px;">عرض الكل</button></div>
                    
                    <div class="dropdown" class="btn btn-primary menu_button" type="button" style="float:left; margin-top:-50px; margin-left:15px;" >
                    <nav>
                        <button  class="btn btn-primary menu_button" type="button" >ترتيب حسب التاريخ</button> 
                        <div class="dropdown-content">        
                            <a href="index.php?order=true&order_type=Asc">ترتيب تصاعدي</a>
                            <a href="index.php?order=true&order_type=Desc">ترتيب تنازلي</a>
                        </div>
                    </nav>    
                    </div>

                <div class="table-responsive text-nowrap" style="font-size: 15px;">
            </form>
                <table class="table table-hover">
                    <thead style="background-color: white;">
                        <tr>
                            
                            <th>إسم الدورة</th>
                            <th>التاريخ </th>
                            <th>مكان الدورة</th>
                            <th>جهة التدريب</th>
                            <th>عرض التفاصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $now_date = date('Y-m-d');
                            
                            if(isset($_GET['order'])){

                                if($_GET['order_type']=="Asc"){

                                    if(isset($_GET['search_btn'])){
                                        $query = "select workshop.* , workshop_provider.department_name from workshop join workshop_provider where workshop.id_workshop_provider = workshop_provider.id_provider and ( workshop.title like '%".$_GET['search_word']."%' or workshop.description like '%".$_GET['search_word']."%' or workshop.presenter like '%".$_GET['search_word']."%'  or workshop.location like '%".$_GET['search_word']."%' or workshop.target_group like '%".$_GET['search_word']."%') order by date_workshop asc";
                                    }else{
                                        $query = "select workshop.* , workshop_provider.department_name from workshop join workshop_provider where workshop.id_workshop_provider = workshop_provider.id_provider and date_workshop >='".$now_date."' order by date_workshop asc";
                                    }

                                }else{

                                    if(isset($_GET['search_btn'])){
                                        $query = "select workshop.* , workshop_provider.department_name from workshop join workshop_provider where workshop.id_workshop_provider = workshop_provider.id_provider and ( workshop.title like '%".$_GET['search_word']."%' or workshop.description like '%".$_GET['search_word']."%' or workshop.presenter like '%".$_GET['search_word']."%'  or workshop.location like '%".$_GET['search_word']."%' or workshop.target_group like '%".$_GET['search_word']."%') order by date_workshop desc";
                                    }else{
                                        $query = "select workshop.* , workshop_provider.department_name from workshop join workshop_provider where workshop.id_workshop_provider = workshop_provider.id_provider and date_workshop >='".$now_date."' order by date_workshop desc";
                                    }
                                }

                            }else{

                                if(isset($_GET['search_btn'])){
                                    $query = "select workshop.* , workshop_provider.department_name from workshop join workshop_provider where workshop.id_workshop_provider = workshop_provider.id_provider and ( workshop.title like '%".$_GET['search_word']."%' or workshop.description like '%".$_GET['search_word']."%' or workshop.presenter like '%".$_GET['search_word']."%'  or workshop.location like '%".$_GET['search_word']."%' or workshop.target_group like '%".$_GET['search_word']."%')";
                                }else{
                                    $query = "select workshop.* , workshop_provider.department_name from workshop join workshop_provider where workshop.id_workshop_provider = workshop_provider.id_provider and date_workshop >='".$now_date."'";
                                }
                            }


                            $result = $con->query($query);
                            while($row=$result->fetch_assoc()){
                                echo '
                                    <tr>
                                        
                                        <td>'.$row['title'].'</td>
                                        <td>'.$row['date_workshop'].'</td>
                                        <td>'.$row['location'].'-'.$row['section_location'].'-'.$row['section_number'].'</td>
                                        <td>'.$row['department_name'].'</td>
                                        <td><a href="workshop_info.php?id_workshop='.$row['id_workshop'].'" class="btn btn-primary" type="button" style="padding: 3px;padding-top: 0px;width: 52px;font-size: 15px;height: 30px;padding-bottom: 6px; background-color: #104e41;">عرض</a></td>
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