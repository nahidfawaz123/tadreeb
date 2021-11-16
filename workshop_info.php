<?php session_start();
    
    require('db.php');
    


    if(isset($_GET["registering"])){

        if(!isset($_SESSION['username_t'])){

            echo'<script> if(confirm("يجب تسجيل الدخول من أجل حجز مقعد \n هل تريد تسجيل الدخول؟")) window.location = "login.php";</script>';
        
        }else{

            $query = "select * from workshop where id_workshop=".$_GET['id_workshop']."";
            $result = $con->query($query);
            $row = $result->fetch_assoc();
            
            if($row['reserved_seats'] < $row['seats']){

                $q = "select * from certification where id_workshop=".$row['id_workshop']." and id_trainess = ".$_SESSION['id_t']."";
                $res = $con->query($q);
                if($res->num_rows >0){

                    echo "<script>alert('    تم التسجيل مسبقاً  ');</script>";
                }else{
                   
                    $id_trainess = $_SESSION["id_t"];
                    $query = "insert into certification (id_trainess , id_workshop , attended) values('$id_trainess' , ".$_GET['id_workshop']." , 0)";
                    $con->query($query) or die ("<center> <span id='error-message-login' class=' text-danger alert-dark p-1 rounded'>all seats in this workshop are reserved !!! </span></center>");
                   
                    $query = "update workshop set seats = seats - 1 , reserved_seats = reserved_seats + 1 where  id_workshop = ".$_GET['id_workshop']."";
                    $con->query($query);
                    
                    echo"<script>alert('تم التسجيل بنجاح في هذه الدورة');</script>";
                }

    
            }else{
                echo"<script>alert('جميع المقاعد محجوزة ');</script>";
            }
    
        }

    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>معلومات الدورة</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/home_provider_style.css">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/registeration_requist.css">
    <link rel="stylesheet" href="css/registration_style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/workshop_info_style.css">
</head>

<body dir="rtl">
    <section class="header">
        <div class="text-center logo_div"><img class="logo_image" src="images/logo.png">
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
            }
        ?>
     
           
           </div> 
    
        
        
     </section>
    <section class="text-center content">
        <div class="workshop_info_div">
            <p class="section_header"><strong>معلومات الدورة التدريبية</strong></p>
            <div class="seprator_div" style="margin-bottom: 22px;"></div>

            <?php
                if(isset($_GET['id_workshop'])){
                $id_workshop= $_GET['id_workshop'];
                $sql = "SELECT * FROM workshop where id_workshop='$id_workshop'";
                $result = mysqli_query($con,$sql);
                $row =mysqli_fetch_array($result);
                
                echo '
                    <div style="width: 80%;margin-right: auto;margin-left: auto;margin-top: 3px;">
                        <div class="info_title">
                            <span ><strong>عنوان الدورة التدريبية :</strong><br></span>
                        </div>
                        <div class="info_content">
                            <span style="width: 100%;font-size: 16px;">'.$row['title'].'<br></span>
                        </div>
                    </div>
                    <div class="info_div">
                        <div class="info_title">
                            <span ><strong>وصف الدورة التدريبية :</strong><br></span>
                        </div>
                        <div class="info_content">
                            <span style="width: 100%;font-size: 16px;">'.$row['description'].'</span>
                        </div>
                    </div>
                    <div class="info_div">
                        <div class="info_title">
                            <span ><strong>مكان إقامة الدورة التدريبية :</strong><br></span>
                        </div>
                        <div class="info_content">
                            <span style="width: 100%;font-size: 16px;">'.$row['location'].'-'.$row['section_location'].'-'.$row['section_number'].'<br></span>
                        </div>
                    </div>
                    <div class="info_div">
                        <div class="info_title">
                            <span ><strong>المدرب / مقدم الدورة :</strong><br></span>
                        </div>
                        <div class="info_content">
                            <span style="width: 100%;font-size: 16px;">'.$row['presenter'].'<br></span>
                        </div>
                    </div>
                    <div class="info_div">
                        <div class="info_title">
                            <span ><strong>الفئات المستهدفة :</strong><br></span>
                        </div>
                        <div class="info_content">
                        ';
                            $qq = "select target_class.* , workshop_target_class.* from target_class, workshop_target_class where target_class.class_id = workshop_target_class.id_class and workshop_target_class.id_workshop = ".$_GET['id_workshop']."";
                            $rr = mysqli_query($con,$qq);
                            while($roww =mysqli_fetch_array($rr)){
                                echo '<span style="width: 100%;font-size: 16px;">'.$roww['class_name'].'</span> <br>';
                            }

                        echo'
                           
                        </div>
                    </div>
                    <div class="info_div">
                        <div class="info_title">
                            <span ><strong>المقاعد :</strong><br></span>
                        </div>
                        <div class="info_content">
                            <span style="width: 100%;font-size: 17px;"><strong>عدد المقاعد  : '.$row['seats'].' مقعد <br></span>
                            <span style="width: 100%;font-size: 17px;"><strong>عدد المقاعد المحجوزة : '.$row['reserved_seats'].'  مقعد</span>
                        </div>
                    </div>
                    <div class="info_div">
                        <div class="info_content">
                        ';

                            if(isset($_SESSION["username_t"])){

                                $qq = "select * from certification where id_trainess = ".$_SESSION['id_t']." and id_workshop = ".$_GET['id_workshop']."";
                                $ress = mysqli_query($con , $qq);
                                if(mysqli_num_rows($ress) > 0){
                                    echo '<h4><b>انت مسجل فعلاً في هذه الدورة</b></h3>';
                                }else{
                                    echo '
                                        <a href="workshop_info.php?registering=true&id_workshop='.$row['id_workshop'].'" class="btn btn-primary" type="button " style="margin-top: 5px;background-color: #104e41; ">التسجيل في الدورة</a>
                                        <a href="index.php?" class="btn btn-primary" type="button " style="margin-top: 5px;background-color: #104e41; ">إلغاء  </a>
                                    ';
                                }
                                
                            }
    
                        echo'
                        </div>
                    </div>
                ';
              }
            ?>

        </div>
    </section>
    <section class="footer"></section>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>