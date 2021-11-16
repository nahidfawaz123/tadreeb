<?php session_start();
    require('db.php');
    




    if(isset($_POST['add_workshop'])){

        $query = "insert into workshop (id_workshop_provider, title, description, presenter, date_workshop, time_workshop, location, section_location, section_number, seats, reserved_seats)
        values (".$_SESSION['id_p']." , '".$_POST['title']."' , '".$_POST['description']."' , '".$_POST['presenter']."' , '".$_POST['date_workshop']."', '".$_POST['time_workshop']."', ".$_POST['location'].", '".$_POST['section_location']."' , '".$_POST['section_number']."', ".$_POST['seats'].", 0)";
        $result = mysqli_query($con,$query);
        if($result){
              
            
            $q_max = "select max(id_workshop) as new_workshop_id from workshop";
            $res_max = mysqli_query($con,$q_max);
            $row_max = mysqli_fetch_array($res_max);
            
           
            if(is_array($_POST['target_group'])){
                foreach($_POST['target_group'] as $class){
                    $q_insert = "insert into workshop_target_class (id_workshop , id_class) values(".$row_max['new_workshop_id']." , ".$class.")";
                    $res_insert = mysqli_query($con,$q_insert);
                }
            }
            
            echo "<script> alert('تم الاضافة بنجاح'); window.location='home_provider.php';</script>"; 
        }else{
            echo "error";
        }

    }

    
    if(isset($_POST['update_workshop'])){
        $query = "update workshop set id_workshop_provider = ".$_SESSION['id_p'].", title = '".$_POST['title']."', description = '".$_POST['description']."', presenter = '".$_POST['presenter']."', date_workshop = '".$_POST['date_workshop']."', time_workshop = '".$_POST['time_workshop']."', location = ".$_POST['location'].", section_location = '".$_POST['section_location']."', section_number = '".$_POST['section_number']."' , seats = ".$_POST['seats']." where id_workshop = ".$_POST['id_workshop']."";                                                                                                                                                                                                                                                              
        $result = mysqli_query($con,$query);
        if($result){
 
            $q_delete = "delete from workshop_target_class where id_workshop = ".$_POST['id_workshop']." ";
            $res_delete = mysqli_query($con,$q_delete);

            if(is_array($_POST['target_group'])){
                foreach($_POST['target_group'] as $class){
                    $q_insert = "insert into workshop_target_class (id_workshop , id_class) values(".$_POST['id_workshop']." , ".$class.")";
                    $res_insert = mysqli_query($con,$q_insert);
                }
            }
            echo "<script> alert('تم التعديل بنجاح'); window.location='home_provider.php';</script>"; 
            
        }else{
            echo "error";
        }
    }


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ورشة العمل</title>
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
                <?php
                    if(isset($_GET['add_new_workshop'])){  
                        echo '
                            <form name="workshop_form" method="post" action="workshop.php" class="text-right">

                            <p class="text-center" style="margin-bottom: 0px;color: #104e41; font-size: 21px;">بيانات الدورة التدريبية</p>
                        
                            <input class="form-control" type="hidden" name="id_workshop" value="">
        
                            <label style="margin-top: 4px;font-size: 15px;padding-top: 7px;">عنوان الدورة </label>
                            <input class="form-control" type="text" name="title" value="" >
                            
                            <label class="workshop_info">وصف الدورة </label>
                            <textarea class="form-control" style="height: 130px;" name="description" ></textarea>
                            
                            <label class="workshop_info">مقدم الدورة  </label>
                            <input class="form-control" type="text" name="presenter" value="" >
                            
                            <label class="workshop_info">الوقت و التاريخ &nbsp;</label>
                            <input class="form-control" type="date" name="date_workshop" value=""  />
                            <input class="form-control" type="time" name="time_workshop" style="margin-top:5px;"value=""  />
                            
                            <label class="workshop_info">رقم المبنى</label>
                            <select class="form-control" name="location" >
                                <option value="320">320</option>
                                <option value="321">321</option>
                                <option value="322">322</option>
                                <option value="323">323</option>
                                <option value="324">324</option>
                                <option value="325">325</option>
                                <option value="326">326</option>
                                <option value="411">411</option>
                             </select>

                            <label class="workshop_info">جهة القاعة </label>
                            <select class="form-control" name="section_location" >
                                    <option value="إدارية">إدارية</option>
                                    <option value="تعليمية">تعليمية</option>
                            </select>
                            
                            <label class="workshop_info">رقم القاعة</label>
                            <input class="form-control" type="text" name="section_number" value="" >
                            
                            <label class="workshop_info">الفئة المستهدفة</label>
                            <div>
                            ';
                                 
                                $q_target = "select * from target_class";
                                $res_target = mysqli_query($con , $q_target);

                                while($row_target=mysqli_fetch_array($res_target)){

                                    echo'
                                        <label>'.$row_target['class_name'].'</label> <input type="checkbox" name="target_group[]" value="'.$row_target['class_id'].'" >&nbsp;&nbsp;&nbsp;&nbsp;
                                    ';
                                }

                            echo'
                            </div>
                            
                            <label class="workshop_info" >عدد المقاعد</label>
                            <input class="form-control" type="text"  name="seats" value="" >
        
                          
                           <button name="add_workshop" class="btn btn-primary" type="submit" style="margin-top: 50px;width: 85px;background-color:#104e41;">إضافة</button>  
                           <a name="cancel" href="home_provider.php" class="btn btn-primary" style="margin-top: 50px;width: 85px;background-color:#104e41;">الغاء</a>

                        </form>                        
                        ';

                        }else if(isset($_GET['fill_update_form'])){  

                                $query_w = "select * from workshop where id_workshop = ".$_GET['id_workshop']."";                                                                                                                                                                                                                                                              
                                $result_w = mysqli_query($con,$query_w);
                                $row_w = $result_w->fetch_assoc();

                            echo '
                                <form name="workshop_form" method="post" action="workshop.php" class="text-right">
                                    <p class="text-center" style="margin-bottom: 0px;color: ##104e41;font-size: 21px;">بيانات الدورة  التدريبية</p>
                                
                                    <input class="form-control" type="hidden" name="id_workshop" value="'.$row_w['id_workshop'].'">
                
                                    <label style="margin-top: 4px;font-size: 15px;padding-top: 7px;">عنوان الدورة </label>
                                    <input class="form-control" type="text" name="title" value="'.$row_w['title'].'" required>
                                    
                                    <label class="workshop_info">وصف الدورة </label>
                                    <textarea class="form-control" style="height: 130px;" name="description" required>'.$row_w['description'].'</textarea>
                                    
                                    <label class="workshop_info">مقدم الدورة  </label>
                                    <input class="form-control" type="text" name="presenter" value="'.$row_w['presenter'].'" required>
                                    
                                    <label class="workshop_info">الوقت و التاريخ &nbsp;</label>
                                    <input class="form-control" type="date" name="date_workshop" value="'.$row_w['date_workshop'].'" required />
                                    <input class="form-control" type="time" name="time_workshop" style="margin-top:5px;"value="'.$row_w['time_workshop'].'" required />
                                    
                                    <label class="workshop_info">رقم المبنى </label>
                                    <select class="form-control" name="location" required>
                                        <option value="320" '; echo ($row_w['location']=="320")?"selected":""; echo ' >320</option>
                                        <option value="321" '; echo ($row_w['location']=="321")?"selected":""; echo ' >321</option>
                                        <option value="322" '; echo ($row_w['location']=="322")?"selected":""; echo ' >322</option>
                                        <option value="323" '; echo ($row_w['location']=="323")?"selected":""; echo ' >323</option>
                                        <option value="324" '; echo ($row_w['location']=="324")?"selected":""; echo ' >324</option>
                                        <option value="325" '; echo ($row_w['location']=="325")?"selected":""; echo ' >325</option>
                                        <option value="326" '; echo ($row_w['location']=="326")?"selected":""; echo ' >326</option>
                                        <option value="411" '; echo ($row_w['location']=="411")?"selected":""; echo ' >411</option>
                                    </select>

                                    <label class="workshop_info">جهة القاعة</label>
                                    <select class="form-control" name="section_location" required>
                                            <option value="إدارية" '; echo ($row_w['section_location']=="إدارية")?"selected":""; echo '>إدارية</option>
                                            <option value="تعليمية" ';  echo ($row_w['section_location']=="تعليمية")?"selected":""; echo '>طلابية</option>
                                    </select>
                                    
                                    <label class="workshop_info">رقم القاعة</label>
                                    <input class="form-control" type="text" name="section_number" value="'.$row_w['section_number'].'" required>
                                    
                                    <label class="workshop_info">الفئة المستهدفة</label>
                                    <div>
                                    ';

                                   
                                    $q_target = "select * from target_class";
                                    $res_target = mysqli_query($con , $q_target);

                                    while($row_target=mysqli_fetch_array($res_target)){
                                        
                                        $q_check = "select * from workshop_target_class where id_workshop =".$_GET['id_workshop']." and id_class=".$row_target['class_id']."";
                                        $res_check = mysqli_query($con , $q_check);
                                        $selected_or_not = "";
                                        if(mysqli_num_rows($res_check) > 0) 
                                              $selected_or_not = "checked";

                                        echo'
                                            <label>'.$row_target['class_name'].'</label> <input type="checkbox" name="target_group[]" value="'.$row_target['class_id'].'" '.$selected_or_not.'>&nbsp;&nbsp;&nbsp;&nbsp;
                                          ';
                                    }

                                    echo'
                                    </div>
                                    
                                    <label class="workshop_info" >عدد المقاعد</label>
                                    <input class="form-control" type="text"  name="seats" value="'.$row_w['seats'].'" required>
                
                                    <button name="update_workshop" class="btn btn-primary" type="submit" style="margin-top: 50px;width: 85px;background-color: #104e41;">حفظ</button>
                                    <a name="cancel" href="home_provider.php" class="btn btn-primary" style="margin-top: 50px;width: 85px;background-color:#104e41;">الغاء</a>
                               
                             </form>                           
                            ';
                        }
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