<?php session_start();
    require('db.php');
    

    if(isset($_GET['delete_workshop']) and $_GET['delete_workshop']=='true'){
        $query = "delete from workshop where id_workshop = ".$_GET['id_workshop']."";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<script> alert('تم الحذف بنجاح');</script>"; 
        }

        unset($_GET['delete_workshop']);
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>صفحة المدرب | الرئيسية </title>
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
            <p class="section_header"><strong>إعلاناتي</strong></p>
            <div class="seprator_div"></div>
            <div class="text-right add_workshop_area">
                <a href="workshop.php?add_new_workshop=true" class="btn btn-primary add_button" style="background-color: #104e41;">إضافة إعلان جديد</a>
            </div>
            <div class="table-responsive text-nowrap" style="font-size: 15px;">
                <table class="table table-hover">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th>رقم</th>
                            <th>عنوان الدورة</th>
                            <th>تاريخ إقامة الدورة</th>
                            <th>مكان الدورة</th>
                            <th>المدرب</th>
                            <th style="width:30px;">العمليات</th>
                            <th style="width:30px;">المسجلين <br>في الدورة</th>
                            <th style="width:30px;">تسجيل<br>الحضور</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                            $query = "select * from workshop where id_workshop_provider = ".$_SESSION["id_p"]."";
                            $result = $con->query($query);
                            while($row = $result->fetch_assoc()){
                             echo'
                                <tr>
                                    <td>'.$row['id_workshop'].'</td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['date_workshop'].'</td>
                                    <td>'.$row['location'].'-'.$row['section_location'].'-'.$row['section_number'].'</td>
                                    <td>'.$row['presenter'].'</td>
                                    <td>
                                        <div class="dropdown" class="btn btn-primary menu_button" type="button" >
                                            <nav>
                                                <button  class="btn btn-primary menu_button" type="button" style="width:100px;" >العمليات</button> 
                                                <div class="dropdown-content">
                                                    <a onClick=\'if(confirm("هل أنت متأكد من حذف ورشة العمل؟ ")) window.location = "home_provider.php?delete_workshop=true&id_workshop='.$row['id_workshop'].'";\'  type="button"><strong>حذف</strong><br></a>
                                                    <a href="workshop.php?fill_update_form=true&id_workshop='.$row['id_workshop'].'" >تعديل</a>
                                                </div>
                                            </nav>    
                                        </div>
                                    </td>
                                    <td><a href="workshop_trainess.php?id_workshop='.$row['id_workshop'].'" class="btn btn-primary" type="button" style="background-color: #104e41;">عرض</a></td>
                                    <td><a href="QR_Code\Read_QR_Code\readqr.php?id_workshop='.$row['id_workshop'].'" class="btn btn-primary" type="button" style="background-color: #104e41;">تحضير</a></td>
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