<?php
    require('db.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>بطاقة المتدرب</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/home_provider_style.css">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/registeration_requist.css">
    <link rel="stylesheet" href="css/registration_style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/workshop_info_style.css">

   
    <script type="text/javascript" src="QR_Code/js/jquery.js"></script>
	<script type="text/javascript" src="QR_Code/js/qrcode.js"></script>
    <script src="QR_Code/js/html2canvas.js"></script>
   
<script>

    function doCapture() {

        window.scrollTo(0, 0);
        
        html2canvas(document.getElementById("Card")).then(function (canvas) {

           
            var ajax = new XMLHttpRequest();
            
            
            ajax.open("POST", "save-capture.php", true);

           
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

           
            
            var cart_name = document.getElementById("trainess_fullname").innerHTML;
                cart_name += "_" + document.getElementById("id_trainess").value;
                cart_name += "_" + document.getElementById("id_workshop").value;
            ajax.send("image=" + canvas.toDataURL("image/jpeg", 1)+"&name="+cart_name+"&type=card");
            

            
            ajax.onreadystatechange = function () {

               
                if (this.readyState == 4 && this.status == 200) {
                    
                   
                    console.log(this.responseText);
                    
                    document.getElementById("cart_image_path").value = this.responseText;
                    document.getElementById("sendForm").submit(); 
                }
            };
        });
    }

</script>
    
</head>

<body onload="generate();">
<center>
    
 </section>
    <section style="margin-bottom: 90px; ">

            <div>
                <form  onsubmit="generate();return false;">

                    <?php

                     if (isset($_REQUEST['show_card'])){

                        
                        $q_trainess = "select id_trainess , fullname , username , email from trainess where id_trainess = ".$_REQUEST['id_trainess']."";
                        $res_trainess = mysqli_query($con , $q_trainess);
                        $row_trainess = mysqli_fetch_array($res_trainess);

                        
                        $q_workshop = "select * from workshop where id_workshop = ".$_REQUEST['id_workshop']."";
                        $res_workshop = mysqli_query($con , $q_workshop);
                        $row_workshop = mysqli_fetch_array($res_workshop);

                        echo '
                            <input id="fullname"  type="hidden" name="fullname" placeholder="أدخل أسمك الثلاثي" value="'.$row_trainess['fullname'].'">               
                            <input id="email" type="hidden" name="email"  placeholder="أدخل البريد الالكتروني " value="'.$row_trainess['email'].'">
                            <input id="username"  type="hidden" name="username" placeholder="أدخل أسم المستخدم" value="'.$row_trainess['username'].'">
                            <br>
                            <input id="id_trainess" type="hidden" name="id_trainess"  placeholder="رقم المتدرب " value="'.$row_trainess['id_trainess'].'">
                            <input id="id_workshop" type="hidden" name="id_workshop"  placeholder="رقم الدورة " value="'.$row_workshop['id_workshop'].'">
                            <input id="title"  type="hidden" name="title" placeholder="إسم الدورة" value="'.$row_workshop['title'].'">
                        ';
                        }
                    ?>
                </form>
            </div>

    </section>
    
          
 	
     <div id="Card" style="border:2px solid #bbb; width:410px; padding: 8px; height: 230px; background-color: azure; font-size: 15px;">
        <div id="container" style="border:1px solid #eee; height: 100%; padding:2px;">
            <div style="width:60px;"><img style="width:60px; height:50px;" src="images/logo.png"></div> 
            <div id="qrResult" style="height: 130px;width: 130px; float: left; border:1px solid #ddd; padding: 5px; margin-top:-50px;">
			</div>
			<div style="height: 130px;width: 190px; float: right; padding: 5px; text-align: right;  margin-top:-30px;">
					<span style="font-weight: bold;">الإسم المتدرب الثلاثي :</span><br> <span id="trainess_fullname"></span><br>
					<span style="font-weight: bold;">الإيميل</span><br> <span id="trainess_email"></span><br>
                    <span style="font-weight: bold;">إسم الدورة</span><br> <span id="workshop_title"></span><br>
			</div>
			<div style="clear: both;"></div>
			<br>
			<span style="color:#555;">موقع تدريب</span>
			<br>
		</div>
	</div>
        


    <br>
    <br>
    <br>  
    <a  href="my_workshop.php" class="btn btn-primary" style="color:white">back</a>
    <a class="btn btn-primary" style="color:white; cursor:pointer;" onclick="doCapture();" >Send to Email</a>
    <button id="sendMessageBtn" class="btn btn-primary" onClick="window.print();">print</button><br>
    
    <br>

    <form id="sendForm" name="sendEmail" method="post" action="send_to_email\contact.php" style="width:250px;">
        <div class="form-group">
            <input type="hidden" name="sender_name" placeholder="Enter Name" value="tadreeb website" class="form-control"  />
        </div>
        <div class="form-group">
            <input type="hidden" name="email" class="form-control" placeholder="Enter Email" value="imamutadreeb@gmail.com" />
        </div>
        <div class="form-group">
            <input type="hidden" name="subject" class="form-control" placeholder="Enter Subject" value="workshop cart" />
        </div>
        <div class="form-group">
            <input type="hidden" name="message" class="form-control" placeholder="Enter Message" value="this is your workshop cart" />
        </div>
        <div class="form-group">
            <input type="hidden" name="trainess_email" class="form-control" placeholder="trainess email" value="<?php echo $row_trainess['email']; ?>" />
        </div>
        <div class="form-group" align="center">
            <input id="cart_image_path"  type="hidden" name="cart_image_path" value="" style="width:250px; text-align:left">
        </div>
        
        <div class="form-group" align="center">
          
        </div>
        
    </form>

    </center>
    
        <script type="text/javascript">

            var qrcode=new QRCode(document.getElementById('qrResult'),{
                width:120,
                height:120
            });

            function generate(){
               
                var id_trainess = document.getElementById('id_trainess');
                var id_workshop = document.getElementById('id_workshop'); 
                var username = document.getElementById('username');          
               

                document.getElementById("trainess_fullname").innerHTML = document.getElementById('fullname').value;
                document.getElementById("trainess_email").innerHTML = document.getElementById('email').value;
                document.getElementById("workshop_title").innerHTML = document.getElementById('title').value;

               
                qrcode.makeCode(id_trainess.value + "|" + id_workshop.value + "|" + username.value);
            
            }

        </script>





    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>


</body>

</html>