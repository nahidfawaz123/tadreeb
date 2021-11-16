<?php
    require('../../db.php');
?>


<?php 

    if(isset($_GET['check_card_data'])){

        $trainess = $_GET['id_trainess'];
        $workshop = $_GET['id_workshop'];
        $current_workshop = $_GET['current_workshop'];

        if($workshop != $current_workshop){
            echo 'no';
            return;
        }else{
            $q = "select * from certification where id_trainess = ".$trainess." and id_workshop = ".$workshop."";
            $res = mysqli_query($con , $q);
            if(mysqli_num_rows($res) > 0){
    
                $q_update = "update certification set attended = 1 where id_trainess = ".$trainess." and id_workshop = ".$workshop."";
                $res_update = mysqli_query($con , $q_update);         
                echo 'yes';
            }else{
                echo 'no';
            }
        }


    }


    
    if(isset($_GET['get_attended_trainess'])){

        $workshop = $_GET['id_workshop'];

        $q = "select trainess.* , certification.* from trainess join certification on trainess.id_trainess = certification.id_trainess and certification.id_workshop = ".$workshop." and certification.attended = 1";
        $res = mysqli_query($con , $q);
        while($row = mysqli_fetch_array($res)){
          echo '
`              <tr>
                  <td style="padding:0px; text-align:center;">'.$row['id_trainess'].'</td>
                  <td style="padding:0px; text-align:center;">'.$row['fullname'].'</td>
                  <td style="padding:0px; text-align:center;">'.$row['email'].'</td>
              </tr> `
          ';
        }
    }


?>