<?php
session_start();

$showAlert = false;
$showError = false;
$showAlert1 = false;
$showError1 = false;
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
	$full_name = $_POST["full_name"];
    $email_id=$_POST["email_id"];
    $Mno=$_POST["Mno"];
    $age=$_POST["age"];
    $parrent_email_id = $_POST["parrent_email_id"];
    $aadhar_card=$_POST["aadhar_card"];
    $police_station=$_POST["police_station"];
    $password=$_POST["password"];
    $cpassword = $_POST["cpassword"];

    if (($email_id==$parrent_email_id)){
        $errors['parent_id'] = "parent id can not be same as registered email id";

    }
        
       
    if($password != $cpassword){
        $errors['password'] = "Confirm password not matched!";
}

    //Check whether this email exists
    $sql_email_id = "SELECT * FROM `users` WHERE email_id = '$email_id'";
    $sql_Mno = "SELECT * FROM `users` WHERE Mno = '$Mno'";
    $sql_aadhar_card = "SELECT * FROM `users` WHERE aadhar_card = '$aadhar_card'";
    if ($parrent_email_id !='') {
        $sql_parrent_email_id = "SELECT * FROM `users` WHERE parrent_email_id = '$parrent_email_id'";
        $result_parrent_email_id=mysqli_query($conn, $sql_parrent_email_id) or die (mysqli_error($conn));
        $numExistRows3 = mysqli_num_rows($result_parrent_email_id);
        if($numExistRows3 > 0){
            // $exists = true;
            $errors['parrent_email_id'] = "parent Email that you have entered is already exist!";
        }  


    }   
    $result_email_id=mysqli_query($conn, $sql_email_id) or die (mysqli_error($conn));
    $result_Mno=mysqli_query($conn, $sql_Mno) or die (mysqli_error($conn));
    $result_aadhar_card=mysqli_query($conn, $sql_aadhar_card) or die (mysqli_error($conn));
    // $result_parrent_email_id=mysqli_query($conn, $sql_parrent_email_id) or die (mysqli_error($conn));
    $numExistRows = mysqli_num_rows($result_email_id);
    $numExistRows1 = mysqli_num_rows($result_Mno);
    $numExistRows2 = mysqli_num_rows($result_aadhar_card);
    
    if($numExistRows > 0){
        // $exists = true;
        $errors['email_id'] = "Email that you have entered is already exist!";
    }
    if($numExistRows1 > 0){
        // $exists = true;
        $errors['Mno'] = "Mobile Number that you have entered is already exist!";
    }
    if($numExistRows2 > 0){
        // $exists = true;
        $errors['aadhar_card'] = "aadhar_card that you have entered is already exist!";
    }
    
?>
           
                 
        
    <?php
   

   if (empty($errors)) {
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $token= rand(999999, 111111);
            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("Y-m-d H:i:s");
            $aadhar_card= chunk_split($aadhar_card, 4, ' ');
            $ip_address = $_SERVER['REMOTE_ADDR'];

            if ($age>=18){
                $sql = "INSERT INTO `users` ( `full_name`, `email_id`,`Mno`,`age`,`aadhar_card`,`police_station`,`password`, `create_account_time`,`token`,`ip_address`) VALUES ('$full_name','$email_id','$Mno','$age','$aadhar_card','$police_station','$hash', '$timestamp','$token','$ip_address')";
                $result = mysqli_query($conn, $sql);
                 if ($result){
                    $sql_profile ="INSERT INTO profile (`full_name`, `email_id`,`Mno`,`age`,`aadhar_card`,`police_station`) SELECT `full_name`,`email_id`,`Mno`,`age`,`aadhar_card`,`police_station` from users WHERE NOT EXISTS (SELECT `email_id` FROM profile WHERE profile.email_id= users.email_id) LIMIT 1";
                    $result_profile = mysqli_query($conn, $sql_profile);
                 }
                    if($result_profile){



                        $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
                        'X-Mailer: PHP/' . phpversion()."\r\n" ;
    $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = "$email_id";
    $additional_parameters = '-fsupport@smilewellnessfoundation.org';
    $subject = "Email Verification Code";
                        $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                        <html xmlns:v='urn:schemas-microsoft-com:vml'>
                        
                        <head>
                            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                            <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                            <!--[if !mso]--><!-- -->
                            <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                            <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                            <!-- <![endif]-->
                        
                            <title>apply with us</title>
                        
                            <style type='text/css'>
                                body {
                                    width: 100%;
                                    background-color: #ffffff;
                                    margin: 0;
                                    padding: 0;
                                    -webkit-font-smoothing: antialiased;
                                    mso-margin-top-alt: 0px;
                                    mso-margin-bottom-alt: 0px;
                                    mso-padding-alt: 0px 0px 0px 0px;
                                }
                        
                                p,
                                h1,
                                h2,
                                h3,
                                h4 {
                                    margin-top: 0;
                                    margin-bottom: 0;
                                    padding-top: 0;
                                    padding-bottom: 0;
                                }
                        
                                span.preheader {
                                    display: none;
                                    font-size: 1px;
                                }
                        
                                html {
                                    width: 100%;
                                }
                        
                                table {
                                    font-size: 14px;
                                    border: 0;
                                }
                                /* ----------- responsivity ----------- */
                        
                                @media only screen and (max-width: 640px) {
                                    /*------ top header ------ */
                                    .main-header {
                                        font-size: 20px !important;
                                    }
                                    .main-section-header {
                                        font-size: 28px !important;
                                    }
                                    .show {
                                        display: block !important;
                                    }
                                    .hide {
                                        display: none !important;
                                    }
                                    .align-center {
                                        text-align: center !important;
                                    }
                                    .no-bg {
                                        background: none !important;
                                    }
                                    /*----- main image -------*/
                                    .main-image img {
                                        width: 440px !important;
                                        height: auto !important;
                                    }
                                    /* ====== divider ====== */
                                    .divider img {
                                        width: 440px !important;
                                    }
                                    /*-------- container --------*/
                                    .container590 {
                                        width: 440px !important;
                                    }
                                    .container580 {
                                        width: 400px !important;
                                    }
                                    .main-button {
                                        width: 220px !important;
                                    }
                                    /*-------- secions ----------*/
                                    .section-img img {
                                        width: 320px !important;
                                        height: auto !important;
                                    }
                                    .team-img img {
                                        width: 100% !important;
                                        height: auto !important;
                                    }
                                }
                        
                                @media only screen and (max-width: 479px) {
                                    /*------ top header ------ */
                                    .main-header {
                                        font-size: 18px !important;
                                    }
                                    .main-section-header {
                                        font-size: 26px !important;
                                    }
                                    /* ====== divider ====== */
                                    .divider img {
                                        width: 280px !important;
                                    }
                                    /*-------- container --------*/
                                    .container590 {
                                        width: 280px !important;
                                    }
                                    .container590 {
                                        width: 280px !important;
                                    }
                                    .container580 {
                                        width: 260px !important;
                                    }
                                    /*-------- secions ----------*/
                                    .section-img img {
                                        width: 280px !important;
                                        height: auto !important;
                                    }
                                }
                            </style>
                            <!-- [if gte mso 9]><style type=”text/css”>
                                body {
                                font-family: arial, sans-serif!important;
                                }
                                </style>
                            <![endif]-->
                        </head>
                        
                        
                        <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                            <!-- pre-header -->
                            <table style='display:none!important;'>
                                <tr>
                                    <td>
                                        <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                            Pre-header for the newsletter template
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <!-- pre-header end -->
                            <!-- header -->
                            <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
                        
                                <tr>
                                    <td align='center'>
                                        <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                                            <tr>
                                                <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                            </tr>
                        
                                            <tr>
                                                <td align='center'>
                        
                                                    <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                                                        <tr>
                                                            <td align='center' height='70' style='height:17px;'>
                                                                <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/team_tech_wizard/images/logo1.png' alt='' /></a>
                                                            </td>
                                                        </tr>
                        
                                                       
                                                    </table>
                                                </td>
                                            </tr>
                        
                                            
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- end header -->
                        
                            <!-- big image section -->
                            <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
                        
                                <tr>
                                    <td align='center'>
                                        <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                            
                                            <tr>
                                                <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                                    class='main-header'>
                        
                        
                                                    <div style='line-height: 35px'>
                        
                                                        Welcome to  <span style='color: #FFD700;'>Team Tech Wizard ".$full_name."</span>
                        
                                                    </div>
                                                </td>
                                            </tr>
                        
                                            <tr>
                                                <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                            </tr>
                        
                                            <tr>
                                                <td align='center'>
                                                    <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                                        <tr>
                                                            <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                        
                                            <tr>
                                                <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                            </tr>
                        
                                            <tr>
                                                <td align='center'>
                                                    <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                                        <tr>
                                                            <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                        
                        
                                                                <div style='line-height: 24px'>
                        
                                                                   Thank you for signing with us !!! Verification code is  ".$token." and  Ip address is ".$ip_address."  at time ".$timestamp." <br>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                        
                                            <tr>
                                                <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                            </tr>
                        
                                           
                        
                                        </table>
                        
                                    </td>
                                </tr>
                        
                                
                                <tr>
                                    <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                                </tr>
                        
                            </table>
                            <!-- end section -->
         
                        <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
                        
                  
                                        <tr>
                                            <td align='center'>
                                                <table border='0' align='center' width='160' cellpadding='0' cellspacing='0' bgcolor='5caad2' style=''>
                        
                                                    <tr>
                                                        <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td align='center' style='color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;'>
                        
                        
                                                            <div style='line-height: 26px;'>
                                                                <a href='https://smilewellnessfoundation.org/team_tech_wizard/login.php' style='color: #ffffff; text-decoration: none;'>LOGIN NOW</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                    </tr>
                        
                                                </table>
                                            </td>
                                        </tr>
                        
                        
                                    </table>
                        
                                </td>
                            </tr>
                        
                            
                            
                        
                        </table>
                        
                        <table>
                            <tr>
                                <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                            </tr>
                        </table>
                        
                            <!-- footer ====== -->
                            <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
                        
                                <tr>
                                    <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                </tr>
                        
                                <tr>
                                    <td align='center'>
                        
                                        <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                                            <tr>
                                                <td>
                                                    <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                                        class='container590'>
                                                        <tr>
                                                            <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                                <div style='line-height: 24px;'>
                        
                                                                    <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
                        
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                        
                                                    
                                                   
                                                </td>
                                            </tr>
                        
                                        </table>
                                    </td>
                                </tr>
                        
                                
                        
                            </table>
                            <!-- end footer ====== -->
                        
                        </body>
                        
                        </html>";
                        
                        
    
    
    
    
                        if (mail($to,$subject,$message,$headers,$additional_parameters)){
                          //echo "Your Mail is sent successfully.";
                          $info = "We've sent a verification code to your email - $email_id";
                                        $_SESSION['info'] = $info;
                                        $_SESSION['email_id'] = $email_id;
                                        $_SESSION['password'] = $password;
                          header('location:user-otp.php');
                        }
                        else{
                          //echo "Your Mail is not sent. Try Again.";
                          $errors['mail'] = "mail not send";
                        }
                        //     $slowAlert1=false;
                        //     $showError1 = false;
                        // }

                   
            }
        }
            else{
                $sql = "INSERT INTO `users` ( `full_name`, `email_id`,`Mno`,`age`,`aadhar_card`,`parrent_email_id`,`police_station`,`password`, `create_account_time`,`token`,`ip_address`) VALUES ('$full_name','$email_id','$Mno','$age','$aadhar_card','$parrent_email_id','$police_station','$hash', '$timestamp','$token','$ip_address')";
                $result = mysqli_query($conn, $sql);
                 if ($result){
                    $sql_profile ="INSERT INTO profile (`full_name`, `email_id`,`Mno`,`age`,`aadhar_card`,`police_station`) SELECT `full_name`,`email_id`,`Mno`,`age`,`aadhar_card`,`police_station` from users WHERE NOT EXISTS (SELECT `email_id` FROM profile WHERE profile.email_id= users.email_id) LIMIT 1";
                    $result_profile = mysqli_query($conn, $sql_profile);
                 }
                    if($result_profile){


                    $parrent_token= bin2hex(random_bytes(15));
                    $sql = "UPDATE users SET parrent_token='$parrent_token', parrent_status=0 WHERE email_id='$email_id'";
                    $result1 = mysqli_query($conn, $sql);
                    if ($result1){
                        $parrent_token= bin2hex(random_bytes(15));
                        $sql = "UPDATE users SET parrent_token='$parrent_token', parrent_status=0 WHERE email_id='$email_id'";
                        $result1 = mysqli_query($conn, $sql);
                        if ($result1){
                            $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .'X-Mailer: PHP/' . phpversion()."\r\n" ;
                            $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $to2 = "$parrent_email_id";
                            $additional_parameters = '-fsupport@smilewellnessfoundation.org';
                            $subject = "Parrent email verification";
                        
                            $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                                <html xmlns:v='urn:schemas-microsoft-com:vml'>
                        
                                <head>
                                    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                    <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                                    <!--[if !mso]--><!-- -->
                                    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                                    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                                    <!-- <![endif]-->
                        
                                    <title>Material Design for Bootstrap</title>
                        
                                    <style type='text/css'>
                                        body {
                                            width: 100%;
                                            background-color: #ffffff;
                                            margin: 0;
                                            padding: 0;
                                            -webkit-font-smoothing: antialiased;
                                            mso-margin-top-alt: 0px;
                                            mso-margin-bottom-alt: 0px;
                                            mso-padding-alt: 0px 0px 0px 0px;
                                        }
                        
                                        p,
                                        h1,
                                        h2,
                                        h3,
                                        h4 {
                                            margin-top: 0;
                                            margin-bottom: 0;
                                            padding-top: 0;
                                            padding-bottom: 0;
                                        }
                        
                                        span.preheader {
                                            display: none;
                                            font-size: 1px;
                                        }
                        
                                        html {
                                            width: 100%;
                                        }
                        
                                        table {
                                            font-size: 14px;
                                            border: 0;
                                        }
                                        /* ----------- responsivity ----------- */
                        
                                        @media only screen and (max-width: 640px) {
                                            /*------ top header ------ */
                                            .main-header {
                                                font-size: 20px !important;
                                            }
                                            .main-section-header {
                                                font-size: 28px !important;
                                            }
                                            .show {
                                                display: block !important;
                                            }
                                            .hide {
                                                display: none !important;
                                            }
                                            .align-center {
                                                text-align: center !important;
                                            }
                                            .no-bg {
                                                background: none !important;
                                            }
                                            /*----- main image -------*/
                                            .main-image img {
                                                width: 440px !important;
                                                height: auto !important;
                                            }
                                            /* ====== divider ====== */
                                            .divider img {
                                                width: 440px !important;
                                            }
                                            /*-------- container --------*/
                                            .container590 {
                                                width: 440px !important;
                                            }
                                            .container580 {
                                                width: 400px !important;
                                            }
                                            .main-button {
                                                width: 220px !important;
                                            }
                                            /*-------- secions ----------*/
                                            .section-img img {
                                                width: 320px !important;
                                                height: auto !important;
                                            }
                                            .team-img img {
                                                width: 100% !important;
                                                height: auto !important;
                                            }
                                        }
                        
                                        @media only screen and (max-width: 479px) {
                                            /*------ top header ------ */
                                            .main-header {
                                                font-size: 18px !important;
                                            }
                                            .main-section-header {
                                                font-size: 26px !important;
                                            }
                                            /* ====== divider ====== */
                                            .divider img {
                                                width: 280px !important;
                                            }
                                            /*-------- container --------*/
                                            .container590 {
                                                width: 280px !important;
                                            }
                                            .container590 {
                                                width: 280px !important;
                                            }
                                            .container580 {
                                                width: 260px !important;
                                            }
                                            /*-------- secions ----------*/
                                            .section-img img {
                                                width: 280px !important;
                                                height: auto !important;
                                            }
                                        }
                                    </style>
                                    <!-- [if gte mso 9]><style type=”text/css”>
                                        body {
                                        font-family: arial, sans-serif!important;
                                        }
                                        </style>
                                    <![endif]-->
                                </head>
                        
                        
                                <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                                    <!-- pre-header -->
                                    <table style='display:none!important;'>
                                        <tr>
                                            <td>
                                                <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                                    Pre-header for the newsletter template
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- pre-header end -->
                                    <!-- header -->
                                    <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
                        
                                        <tr>
                                            <td align='center'>
                                                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                                                    <tr>
                                                        <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td align='center'>
                        
                                                            <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                                                                <tr>
                                                                    <td align='center' height='70' style='height:17px;'>
                                                                        <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/team_tech_wizard/images/logo1.png' alt='' /></a>
                                                                    </td>
                                                                </tr>
                        
                                                            
                                                            </table>
                                                        </td>
                                                    </tr>
                        
                                                    
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- end header -->
                        
                                    <!-- big image section -->
                                    <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
                        
                                        <tr>
                                            <td align='center'>
                                                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                                    
                                                    <tr>
                                                        <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                                            class='main-header'>
                        
                        
                                                            <div style='line-height: 35px'>
                        
                                                                Welcome to  <span style='color: #FFD700;'>Tech Wizard Police Administration </span>
                        
                                                            </div>
                                                        </td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td align='center'>
                                                            <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                                                <tr>
                                                                    <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td align='center'>
                                                            <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                                            <tr>
                                                            <td align='center'>
                                                                <table border='0' align='center' width='160' cellpadding='0' cellspacing='0' bgcolor='5caad2' style=''>
                                        
                                                                    <tr>
                                                                        <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                                    </tr>
                                        
                                                                    <tr>
                                                                        <td align='center' style='color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;'>
                                        
                                        
                                                                            <div style='line-height: 26px;'>
                                                                                <a href='http://www.smilewellnessfoundation.org/team_tech_wizard/parrent_activate.php?parrent_token=".$parrent_token."' style='color: #ffffff; text-decoration: none;'>Verification </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                        
                                                                    <tr>
                                                                        <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                                    </tr>
                                        
                                                                </table>
                                                            </td>
                                                        </tr>
                                        
                                                            </table>
                                                        </td>
                                                    </tr>
                        
                                                    <tr>
                                                        <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                                    </tr>
                        
                                                
                        
                                                </table>
                        
                                            </td>
                                        </tr>
                        
                                        <tr class='hide'>
                                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                                        </tr>
                        
                                    </table>
                                    <!-- end section -->
                        
                        
                                    <!-- footer ====== -->
                                    <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
                        
                                        <tr>
                                            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                        </tr>
                        
                                        <tr>
                                            <td align='center'>
                        
                                                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                        
                                                    <tr>
                                                        <td>
                                                            <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                                                class='container590'>
                                                                <tr>
                                                                    <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                                        <div style='line-height: 24px;'>
                        
                                                                            <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
                        
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                        
                                                            
                                                        
                                                        </td>
                                                    </tr>
                        
                                                </table>
                                            </td>
                                        </tr>
                        
                                        
                        
                                    </table>
                                    <!-- end footer ====== -->
                        
                                </body>
                        
                                </html>";
                              
                            if (mail($to2,$subject,$message,$headers,$additional_parameters)){
                                $_SESSION['parrent_email_id'] = $parrent_email_id;
                            //echo "Your Mail is sent successfully.";
                                $showAlert = true;
                            
                            
                                $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
                                'X-Mailer: PHP/' . phpversion()."\r\n" ;
                                $headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
                                $to = "$email_id";
                                $additional_parameters = '-fsupport@smilewellnessfoundation.org';
                                $subject = "Application Verification Code";
                                $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                                                        <html xmlns:v='urn:schemas-microsoft-com:vml'>
                            
                            <head>
                                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;' />
                                <!--[if !mso]--><!-- -->
                                <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
                                <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
                                <!-- <![endif]-->
                            
                                <title>apply with us</title>
                            
                                <style type='text/css'>
                                    body {
                                        width: 100%;
                                        background-color: #ffffff;
                                        margin: 0;
                                        padding: 0;
                                        -webkit-font-smoothing: antialiased;
                                        mso-margin-top-alt: 0px;
                                        mso-margin-bottom-alt: 0px;
                                        mso-padding-alt: 0px 0px 0px 0px;
                                    }
                            
                                    p,
                                    h1,
                                    h2,
                                    h3,
                                    h4 {
                                        margin-top: 0;
                                        margin-bottom: 0;
                                        padding-top: 0;
                                        padding-bottom: 0;
                                    }
                            
                                    span.preheader {
                                        display: none;
                                        font-size: 1px;
                                    }
                            
                                    html {
                                        width: 100%;
                                    }
                            
                                    table {
                                        font-size: 14px;
                                        border: 0;
                                    }
                                    /* ----------- responsivity ----------- */
                            
                                    @media only screen and (max-width: 640px) {
                                        /*------ top header ------ */
                                        .main-header {
                                            font-size: 20px !important;
                                        }
                                        .main-section-header {
                                            font-size: 28px !important;
                                        }
                                        .show {
                                            display: block !important;
                                        }
                                        .hide {
                                            display: none !important;
                                        }
                                        .align-center {
                                            text-align: center !important;
                                        }
                                        .no-bg {
                                            background: none !important;
                                        }
                                        /*----- main image -------*/
                                        .main-image img {
                                            width: 440px !important;
                                            height: auto !important;
                                        }
                                        /* ====== divider ====== */
                                        .divider img {
                                            width: 440px !important;
                                        }
                                        /*-------- container --------*/
                                        .container590 {
                                            width: 440px !important;
                                        }
                                        .container580 {
                                            width: 400px !important;
                                        }
                                        .main-button {
                                            width: 220px !important;
                                        }
                                        /*-------- secions ----------*/
                                        .section-img img {
                                            width: 320px !important;
                                            height: auto !important;
                                        }
                                        .team-img img {
                                            width: 100% !important;
                                            height: auto !important;
                                        }
                                    }
                            
                                    @media only screen and (max-width: 479px) {
                                        /*------ top header ------ */
                                        .main-header {
                                            font-size: 18px !important;
                                        }
                                        .main-section-header {
                                            font-size: 26px !important;
                                        }
                                        /* ====== divider ====== */
                                        .divider img {
                                            width: 280px !important;
                                        }
                                        /*-------- container --------*/
                                        .container590 {
                                            width: 280px !important;
                                        }
                                        .container590 {
                                            width: 280px !important;
                                        }
                                        .container580 {
                                            width: 260px !important;
                                        }
                                        /*-------- secions ----------*/
                                        .section-img img {
                                            width: 280px !important;
                                            height: auto !important;
                                        }
                                    }
                                </style>
                                <!-- [if gte mso 9]><style type=”text/css”>
                                    body {
                                    font-family: arial, sans-serif!important;
                                    }
                                    </style>
                                <![endif]-->
                            </head>
                            
                            
                            <body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
                                <!-- pre-header -->
                                <table style='display:none!important;'>
                                    <tr>
                                        <td>
                                            <div style='overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;'>
                                                Pre-header for the newsletter template
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- pre-header end -->
                                <!-- header -->
                                <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff'>
                            
                                    <tr>
                                        <td align='center'>
                                            <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                            
                                                <tr>
                                                    <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                                </tr>
                            
                                                <tr>
                                                    <td align='center'>
                            
                                                        <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                            
                                                            <tr>
                                                                <td align='center' height='70' style='height:17px;'>
                                                                    <a href='' style='display: block; border-style: none !important; border: 0 !important;'><img width='400' border='0' style='display: block; width: 400px;' src='http://smilewellnessfoundation.org/team_tech_wizard/images/logo1.png' alt='' /></a>
                                                                </td>
                                                            </tr>
                            
                                                           
                                                        </table>
                                                    </td>
                                                </tr>
                            
                                                
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- end header -->
                            
                                <!-- big image section -->
                                <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
                            
                                    <tr>
                                        <td align='center'>
                                            <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                                                
                                                <tr>
                                                    <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align='center' style='color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;'
                                                        class='main-header'>
                            
                            
                                                        <div style='line-height: 35px'>
                            
                                                            Welcome to  <span style='color: #FFD700;'>Team Tech Wizard ".$full_name."</span>
                            
                                                        </div>
                                                    </td>
                                                </tr>
                            
                                                <tr>
                                                    <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                </tr>
                            
                                                <tr>
                                                    <td align='center'>
                                                        <table border='0' width='40' align='center' cellpadding='0' cellspacing='0' bgcolor='eeeeee'>
                                                            <tr>
                                                                <td height='2' style='font-size: 2px; line-height: 2px;'>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                            
                                                <tr>
                                                    <td height='20' style='font-size: 20px; line-height: 20px;'>&nbsp;</td>
                                                </tr>
                            
                                                <tr>
                                                    <td align='center'>
                                                        <table border='0' width='400' align='center' cellpadding='0' cellspacing='0' class='container590'>
                                                            <tr>
                                                                <td align='center' style='color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                            
                            
                                                                    <div style='line-height: 24px'>
                            
                                                                       Thank you for Signing with us !!! Verification code is  ".$token." and  Ip address is ".$ip_address."  at time ".$timestamp." <br>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                            
                                                <tr>
                                                    <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                                </tr>
                            
                                               
                            
                                            </table>
                            
                                        </td>
                                    </tr>
                            
                                    
                                    <tr>
                                        <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                                    </tr>
                            
                                </table>
                                <!-- end section -->
                            
                      
                            <br>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
                            
                      
                                            <tr>
                                                <td align='center'>
                                                    <table border='0' align='center' width='160' cellpadding='0' cellspacing='0' bgcolor='5caad2' style=''>
                            
                                                        <tr>
                                                            <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                        </tr>
                            
                                                        <tr>
                                                            <td align='center' style='color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;'>
                            
                            
                                                                <div style='line-height: 26px;'>
                                                                    <a href='https://smilewellnessfoundation.org/team_tech_wizard/login.php' style='color: #ffffff; text-decoration: none;'>LOGIN NOW</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                            
                                                        <tr>
                                                            <td height='10' style='font-size: 10px; line-height: 10px;'>&nbsp;</td>
                                                        </tr>
                            
                                                    </table>
                                                </td>
                                            </tr>
                            
                            
                                        </table>
                            
                                    </td>
                                </tr>
                            
                                
                                
                            
                            </table>
                            
                            <table>
                                <tr>
                                    <td height='40' style='font-size: 40px; line-height: 40px;'>&nbsp;</td>
                                </tr>
                            </table>
                            
                                <!-- footer ====== -->
                                <table border='0' width='100%' cellpadding='10' cellspacing='0' bgcolor='f4f4f4'>
                            
                                    <tr>
                                        <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                                    </tr>
                            
                                    <tr>
                                        <td align='center'>
                            
                                            <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                            
                                                <tr>
                                                    <td>
                                                        <table border='0' align='left' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'
                                                            class='container590'>
                                                            <tr>
                                                                <td align='left' style='color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;'>
                                                                    <div style='line-height: 24px;'>
                            
                                                                        <span style='color: #333333;'>CopyRight @Team Tech Wizard </span>
                            
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                            
                                                        
                                                       
                                                    </td>
                                                </tr>
                            
                                            </table>
                                        </td>
                                    </tr>
                            
                                    
                            
                                </table>
                                <!-- end footer ====== -->
                            
                            </body>
                            
                            </html>";
                            
                            
        
        
        
        
                            if (mail($to,$subject,$message,$headers,$additional_parameters)){
                              //echo "Your Mail is sent successfully.";
                              $info = "We've sent a verification code to your email - $email_id";
                                            $_SESSION['info'] = $info;
                                            $_SESSION['email_id'] = $email_id;
                                            $_SESSION['password'] = $password;
                              header('location:user-otp.php');
                            }
                            else{
                              //echo "Your Mail is not sent. Try Again.";
                              $errors['mail'] = "mail not send";
                            }
                            //     $slowAlert1=false;
                            //     $showError1 = false;
                            // }
                        }
                    
        
        
          
                    }
                        
                        
    
    
    
    
                    }
                
    
    
      
                }
    }
            
           
     
        }
       
    
    }
    
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>user Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<script>
  $(document).ready(function() {
    $("#age").change(function() {
      if ($(this).val() < 18) {
        $("#parentEmailGroup").show();
        $("#parrent_email_id").prop("required", true);
      } else {
        $("#parentEmailGroup").hide();
        
      }
    });
  });
</script>
<body class="pt-2 pl-3" style="background:wheatwhite">
<?php           
    include 'dbconnect.php';

                 
                 if(count($errors) == 1){
                     ?>
                     <div class="alert alert-danger text-center">
                         <?php
                         foreach($errors as $showerror){
                             echo $showerror;
                         }
                         ?>
                     </div>
                     <?php
                 }elseif(count($errors) > 1){
                     ?>
                     <div class="alert alert-danger">
                         <?php
                         foreach($errors as $showerror){
                             ?>
                             <li><?php echo $showerror; ?></li>
                             <?php
                         }
                         ?>
                     </div>
                     <?php
                 }
                 ?>
<?php
     
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! Account created Sucessfully</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
   

    if($showAlert1){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Email send succesfully!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
        
    ?>
    <h1 class="mb-0" style="text-align: center;">SIGNUP PAGE</h1>
    <br>
<!--card started outer 1-->
<!-- <div class="card col-lg-12 ml-1 pb-5 " style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" > -->

<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
			-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
							<img src="images/logo1.png" alt="Admin" class="rounded-circle bg-transparent"  height="200" width="200">
								<div class="mt-3">
		
									 <h4>Rajasthan Police </h4>
									<p class="text-secondary mb-1">Administration</p>
									<p class="text-muted font-size-sm">Sign Up</p>
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="signup.php" method="POST">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter full name" name="full_name" id="full_name" required>
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control" name="email_id" id="email_id" placeholder="example@gmail.com">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mobile Number</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="Mno" id="Mno" placeholder="enter your number" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number." required  >
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Age</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="age" id="age" placeholder="enter your age" pattern="[0-9]{2}" required  >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">confirm password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="cpassword" id="cpassword" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8">
								</div>
							</div>
                            <div class="row mb-3" id="parentEmailGroup">
								<div class="col-sm-3">
									<h6 class="mb-0">parrent email id </h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control" name="parrent_email_id" id="parrent_email_id" placeholder="example@gmail.com">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">aadhar card</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="aadhar_card" id="aadhar_card" pattern="[0-9]{12}" title="Please enter a valid 12-aadhar card number." placeholder="aadhar card without space" required>
								</div>
							</div>

                           <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station</h6>
								</div>
							 	<div class="col-sm-9 text-secondary">
                                 <select name="police_station" class="form-control" id="police_station" required>
                                	<?php 
																	$sql_option3="select distinct police_station_pincode,police_station_name from police_station_list order by police_station_pincode";

									$select_sql5 = mysqli_query($conn,$sql_option3);
									while($row4 = mysqli_fetch_assoc($select_sql5)){
                                        $police_station_pincode=$row4['police_station_pincode'];
                                        $police_station_name=$row4['police_station_name'];?>
										 <option value= "<?php  echo $police_station_name ?>"><?php  echo $police_station_name.' '.$police_station_pincode ; ?></option>;
									
									<?php
									}
									?>
								
         							</select>
								</div>
							</div>

							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Sign Up">
								</div>
							</div>
						</div>
						</form>
						<p class = "text-center">Already Have An Account?? <a href="login.php">login Here</a></p>
					</div>
					
				</div>
			</div>
			<!--row ended-->
		</div>
	</div>

<br><br>

<style type="text/css">
body{

    margin-top:20px;
}


	@media (max-width: 768px) {
		.box-lm{
			margin-top:5% !important
		}
}
</style>


<script type="text/javascript">

</script>
</body>
</html>