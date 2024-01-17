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
    $gender=$_POST["gender"];
    $police_station=$_POST["police_station"];
    $password=$_POST["password"];
    $cpassword = $_POST["cpassword"];
    $admin_role_type = $_POST["admin_role_type"];
    // $exists=false;

    //Check whether this email exists
    $sql_email_id = "SELECT * FROM `admin` WHERE email_id = '$email_id'";
    $result_email_id=mysqli_query($conn, $sql_email_id) or die (mysqli_error($conn));
    $numExistRows = mysqli_num_rows($result_email_id);

    
    if($password != $cpassword){
        $errors['password'] = "Confirm password not matched!";
}

    
    if($numExistRows > 0){
        // $exists = true;
        $errors['email_id'] = "Email that you have entered is already exist!";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $token= rand(999999, 111111);
            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("Y-m-d H:i:s");
            $ip_address = $_SERVER['REMOTE_ADDR'];

            
            $sql = "INSERT INTO `admin` ( `full_name`,`admin_role_type`,`email_id`,`Mno`,`gender`,`police_station`,`password`, `account_creation_time`,`token_email`,`ip_address`) VALUES ('$full_name','$admin_role_type','$email_id','$Mno','$gender','$police_station','$hash', '$timestamp','$token','$ip_address')";
            $result = mysqli_query($conn, $sql);
            if($result){
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
                
                                                           Thank you for choosing us !!! Verification code is  ".$token." and  Ip address is ".$ip_address."  at time ".$timestamp." <br>
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
                  header('location:admin-otp.php');
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
    <h1 class="mb-0" style="text-align: center;">ADMIN SIGNUP PAGE</h1>
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
									<p class="text-secondary mb-1">Admin</p>
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
									<h6 class="mb-0">Admin Role type</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<select name="admin_role_type" class="form-control" id="admin_role_type" required>
                                	<?php 
									$sql_option="select * from admin_role where role_available='available'";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row4 = mysqli_fetch_assoc($select_sql2)){?>
									
										 <option value= "<?php echo $row4['admin_role_type']?>"><?php echo $row4['admin_role_type']?></option>;
									
									<?php
									}
									?>
								
         							</select>
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
									<h6 class="mb-0">Gender</h6>
								</div>
								<div class="col-sm-9 text-secondary">
																		<input type="text" class="form-control"  name="gender" id="gender" pattern="male|female" title="Please enter either 'male' or 'female'" required>

								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="police_station" id="police_station"  required>
								</div>
							</div>
                            
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password" >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">confirm password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="cpassword" id="cpassword" >
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