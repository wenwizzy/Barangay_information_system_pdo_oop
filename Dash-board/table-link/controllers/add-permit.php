<?php
   // session_start();
    include_once('../Private/conn/db-connection.php');
    include_once('../Private/class/brgy-information-system.php');
      $brgy_stat = new Brgy_status();
        if(ISSET($_POST['add-permit'])){

               $residentFullname = trim($_POST['residentFullname']);
               $businessName = trim($_POST['businessName']);
               $businessAddress = trim($_POST['businessAddress']);
               $typeOfBusiness = trim($_POST['typeOfBusiness']);
               $orNo = trim($_POST['orNo']);
               $samount = trim($_POST['samount']);

             // ==========audit trail==================
               $user = trim($_POST['user']);
               if(!empty($_SERVER["HTTP_CLIENT_IP"])){
                     $ip = $_SERVER["HTTP_CLIENT_IP"];
                  }elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){ 
                     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                  }else{
                     $ip = $_SERVER["REMOTE_ADDR"];
                }
               $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
               date_default_timezone_set("asia/manila");
               $logdate =  date('M-d-Y h:i A', strtotime("+0 HOURS"));
               $action = "Added Permit";    
            // ==========end audit trail==============


               $brgy_stat->add_permit($residentFullname, $businessName, $businessAddress, $typeOfBusiness, $orNo, $samount, $user, $ip, $host,  $logdate, $action);
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Add Permit Successfully!","Message!","success");';
                  echo '}, 1000);</script>';
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function(){';
                  echo 'window.location = "/Barangay_Information_System/Dash-board/table-link/manage-permit.php"';
                  echo '},2000)';
                  echo '</script>';
             
        }
?>