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
	$complaint_id1=$_GET['complaint_id'];

   
    $select_display= "select * from users where email_id='$email_id'" ;
    $select_sql1 = mysqli_query($conn,$select_display);
    while($row1 = mysqli_fetch_array($select_sql1)){
    $email_id=$row1[3];
    
    
    }
	$select_display1="SELECT complaint_id,police_station_user,police_station,complaint_assigned_to,feedback FROM application_request where complaint_id='$complaint_id1'";
    $select_sql1 = mysqli_query($conn,$select_display1);

	while($row1 = mysqli_fetch_array($select_sql1)){
	
	
		$complaint_id1=$row1[0];
		$police_station_user=$row1[1];
		$police_station1=$row1[2];
        $complaint_assigned_to=$row1[3];
        $feedback=$row1[4];
		
		
	 }
   
    
    
}




?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $complaint_id=$_GET['complaint_id'];
    
    
    $shareability=$_POST['shareability'];
	
	

 
	$update1 = "UPDATE application_request SET shareability='$shareability'  where complaint_id='$complaint_id'";
	$sql2=mysqli_query($conn,$update1);
	if($sql2)
	  { 
		  $showAlert=true;
          header("location:request_completed_user.php");

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

<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<?php
								// $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
								?>
   								<img src="images/feedback.png" alt="User Avatar" class="rounded-circle p-1 border border-5 border-primary" width="110">
								<div class="mt-3">
		
									 <h4><?php echo $police_station_user?></h4>
									<p class="text-secondary mb-1"><?php echo $police_station1?></p>
									
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="" method="post">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">complaint Id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $complaint_id1?>"  disabled>
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
									<input type="text" class="form-control" value="<?php echo $complaint_assigned_to?>" disabled>
								</div>
							</div>
							
							
							
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Share to public </h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="shareability" id="shareability" placeholder="do you want to share your feedback yes or no" pattern="yes|no" title="Please enter either 'yes' or 'no" required>
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
			margin-top:5% !important
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
