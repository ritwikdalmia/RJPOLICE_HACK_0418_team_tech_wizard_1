<?php
$showAlert=false;
$showError=false;
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
else{
    include "dbconnect.php";
 
    $email_id=$_SESSION['email_id'];
	$complaint_id=$_GET['complaint_id'];

   
    $select_display= "select * from admin where email_id='$email_id'" ;
    $select_sql1 = mysqli_query($conn,$select_display);
    while($row1 = mysqli_fetch_array($select_sql1)){
    $email_id=$row1[3];
    $admin_role_type=$row1[2];
    
    }
	$select_display1="SELECT complaint_id,police_station_user,police_station FROM application_request where complaint_id='$complaint_id'";
    $select_sql1 = mysqli_query($conn,$select_display1);

	while($row1 = mysqli_fetch_array($select_sql1)){
	
	
		$complaint_id=$row1[0];
		$police_station_user=$row1[1];
		$police_station1=$row1[2];
		
		
	 }
   
    
    
}




?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $complaint_id=$_GET['complaint_id'];
    
    $complaint_assigned_to=$_POST['complaint_assigned_to'];

  
   $sql_police = "SELECT * FROM application_request INNER JOIN admin ON application_request.police_station = admin.police_station
   where application_request.complaint_id='$complaint_id'";
   	$result_police=mysqli_query($conn, $sql_police) or die (mysqli_error($conn));
	

  
   if($result_police){
	$update1 = "UPDATE application_request SET complaint_assigned_to='$complaint_assigned_to',permission=1 where complaint_id='$complaint_id'";
	$sql2=mysqli_query($conn,$update1);
	if($sql2)
	  { 

		//   $showAlert=true;
        //   header("location:manage_complaint_request.php");
		
		$headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
		'X-Mailer: PHP/' . phpversion()."\r\n" ;
$headers="reply-to:dalmiaritwik@gmail.com "."\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "$email_id";
$additional_parameters = '-fsupport@smilewellnessfoundation.org';
$subject = "Process update complaint Id:- $complaint_id";
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
		
										Welcome to  <span style='color: #FFD700;'>Team Tech Wizard </span>
		
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
		
Your complaint has been assigned to $complaint_assigned_to for complaint id :- $complaint_id </div>
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
		
			
			</table>
			<!-- end section -->

		<table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='ffffff' class='bg_color'>
		
  
						<tr>
							<td align='center'>
								<table border='0' align='center' width='160' cellpadding='0' cellspacing='0' bgcolor='5caad2' style=''>
		
									
		
									<tr>
										<td align='center' style='color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;'>
		
		
											<div style='line-height: 26px;'>
												<a href='https://smilewellnessfoundation.org/team_tech_wizard/welcome.php' style='color: #ffffff; text-decoration: none;'>See Updates</a>
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
		  
		  header('location:manage_complaint_request.php');
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
   





?>
	

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="wrapper">
<?php require 'nav.php' ?>
<?php


    

    if($showAlert){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Profile Update Successfully!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
        if($showError){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Something went Wrong</strong> '. $showError.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
         
    ?>
    
<br><br><br>

<div class="container box-km">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4 box-km">
					<div class="card" style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<?php
								// $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
								?>
   								<img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User Avatar" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
		
									 <h4><?php echo $police_station_user?></h4>
									<p class="text-secondary mb-1"><?php echo $police_station1?></p>
									
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm box-km">
					<div class="card" style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="" method="post">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">complaint Id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $complaint_id?>" name="complaint_id"id="complaint_id" disabled>
								</div>
		
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Police station</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $police_station_user?>" disabled>
								</div>
							</div>
							
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Police station email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $police_station1?>" disabled>
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Complaint assigned to</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="complaint_assigned_to" id="complaint_assigned_to" placeholder="enter the name who handle complaint">
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="update"  required>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
		</div>

<style type="text/css">
body{
    background: #f7f7ff !important;
   
}

.me-2 {
    margin-right: .5rem!important;
}


@media (max-width: 768px) {
		.box-lm{
			margin-top:5% !important;
		}
}

@media (max-width: 350px) {
		.box-km{
			padding-left:0px !important;
			padding-right:0px !important;
		}
}
</style>


	

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>
