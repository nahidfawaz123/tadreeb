

<?php
    require('db.php');
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>شهادة المتدرب</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="QR_Code/js/html2canvas.js"></script>

    
    <script>

        function doCapture(){

            window.scrollTo(0, 0);

            html2canvas(document.getElementById("Certificate")).then(function (canvas) {

               
                var ajax = new XMLHttpRequest();
                
                
                ajax.open("POST", "save-capture.php", true);

               
                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                
                var Certificate_name = document.getElementById("fullname").value;
                    Certificate_name += "_" + document.getElementById("id_trainess").value;
                    Certificate_name += "_" + document.getElementById("id_workshop").value;


                ajax.send("image=" + canvas.toDataURL("image/jpeg", 1)+"&name="+Certificate_name+"&type=certificate");
                

                
                ajax.onreadystatechange = function () {

                    
                    if (this.readyState == 4 && this.status == 200) {
                        
                        
                        console.log(this.responseText);
                        document.getElementById("certificate_image_path").value = this.responseText;
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
   
    
     <?php
        if(isset($_REQUEST['show_certificate'])){

            echo'
                <input id="fullname"  type="hidden" name="fullname" placeholder="أدخل أسمك الثلاثي" value="'.$_REQUEST['trainess_name'].'"> 
                <input id="id_trainess" type="hidden" name="id_trainess"  placeholder="رقم المتدرب " value="'.$_REQUEST['id_trainess'].'">
                <input id="id_workshop" type="hidden" name="id_workshop"  placeholder="رقم الدورة " value="'.$_REQUEST['id_workshop'].'">
            ';

            
            $query = "select * from workshop where id_workshop = ".$_REQUEST['id_workshop']."";
            $result = $con->query($query);
            $row = $result->fetch_assoc();
            echo'

            <div id="Certificate" style="border:2px solid #bbb; width:705px; height: 505px; background-color: azure; font-size: 15px;">
                <div id="container" style="position:relative;">
                    <img style="width:700px; height:500px;" src="images/certificate.jpg"> 
                    <h2  style="position:absolute; top:180px; left:-160px; width:100%">
                        <span style="font-size:16px; text-decoration:underline; color:#666;">'.$_REQUEST['trainess_name'].'</span> 
                    </h2>   
                    <h2  style="position:absolute; top:220px; left:-50px; width:100%">
                        <span style="font-size:16px; text-decoration:underline; color:#666;">'.$row['title'].'</span> 
                    </h2>   
                    <h2  style="position:absolute; top:255px; left:-20px; width:100%">
                        <span style="font-size:16px; text-decoration:underline; color:#666;">'.$row['date_workshop'].'</span> 
                    </h2>      
                </div>
            </div>
            ';
        }
    ?>

    <!-- -->         


    <br>

    <button class="btn btn-primary" onClick="window.print();">print</button>
    <a class="btn btn-primary" style="color:white; cursor:pointer;" onclick="doCapture();" >Send to Email</a>
    <a href="workshop_trainess.php?id_workshop=<?php echo $_REQUEST['id_workshop']; ?>" class="btn btn-primary" style="color:white">back</a>

    <br>
    <form id="sendForm" name="sendForm" method="post" action="send_to_email\contact.php?id_workshop=<?php echo $_REQUEST['id_workshop']; ?>" style="width:250px;">
        <div class="form-group">
            <input type="hidden" name="sender_name" placeholder="Enter Name" value="tadreeb website" class="form-control"  />
        </div>
        <div class="form-group">
            <input type="hidden" name="email" class="form-control" placeholder="Enter Email" value="imamutadreeb@gmail.com" />
        </div>
        <div class="form-group">
            <input type="hidden" name="subject" class="form-control" placeholder="Enter Subject" value="workshop Certificate" />
        </div>
        <div class="form-group">
            <input type="hidden" name="message" class="form-control" placeholder="Enter Message" value="this is your workshop Certificate" />
        </div>
        <div class="form-group">
            <input type="hidden" name="trainess_email" class="form-control" placeholder="trainess email" value="<?php echo $_REQUEST['trainess_email']; ?>" />
        </div>
        <div class="form-group" align="center">
            <input id="certificate_image_path"  type="hidden" name="certificate_image_path" value="" style="width:250px; text-align:left">
        </div>
        
        <div class="form-group" align="center">
           
        </div>
        
    </form>

    </center>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.js"></script>


</body>

</html>