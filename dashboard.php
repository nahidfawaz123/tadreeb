<?php session_start();

    require('db.php');
    


    if(isset($_GET['change_status'])){
        
        if($_GET['status'] == 0){
            $query = "update workshop_provider set status = 1 where id_provider = ".$_GET['id_provider']."";                                                                                                                                                                                                                                                              
            $result = mysqli_query($con,$query);
        }else{
            $query = "update workshop_provider set status = 0 where id_provider = ".$_GET['id_provider']."";                                                                                                                                                                                                                                                              
            $result = mysqli_query($con,$query);
        }
        echo "<script>alert('تمت العملية بنجاح');</script>";
    }


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard</title>
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
        
        if(isset($_SESSION['username_A'])){
            echo'
            <div class="dropdown" class="btn btn-primary menu_button" type="button" >
            <nav>
            
            <button  class="btn btn-primary menu_button" type="button" >  مرحبا بك ( '.$_SESSION['username_A'].' ) </button> 
            <div class="dropdown-content">
                 
              <a href="admin_profile.php?id_admin='.$_SESSION['id_A'].'">تعديل الملف الشخصي</a>
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
            <p class="section_header"><strong>   اعطاء صلاحية  للجهة التدريب   </strong></p>
            <div class="seprator_div"></div>
            <div class="table-responsive text-nowrap" style="font-size: 15px;">
                <table class="table table-hover" style="margin-top:20px;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th>اسم الجهه</th>
                            <th>البريد الإلكتروني</th>
                            <th>الحالة</th>
                            <th>سماح / منع</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "select * from workshop_provider";
                            $result = $con->query($query);
                            while($row=$result->fetch_assoc()){

                                echo'
                                    <tr>
                                       
                                        <td>'.$row['department_name'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'; echo ($row['status']==1)?"مسموح":"ممنوع"; echo '</td>
                                        <td><a  href="dashboard.php?change_status=true&id_provider='.$row['id_provider'].'&status='.$row['status'].'" class="btn btn-primary" type="button" style=" background-color: #104e41;";>'; echo ($row['status']==0)?"إسمح":"إمنع"; echo '</button></td>
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
    <section class="footer"></section>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>