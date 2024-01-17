<?php
 session_start();
 $errors = array();

$showAlert=false;
$showError=false;

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
	header("location:login.php");
     exit;
 }
 else{
    
 include "dbconnect.php";
//  $email_id=$_SESSION['email_id'];
 $police_station_id=$_GET['police_station_id'];
 $select_display= "select police_station_name,police_station_address,police_station_pincode,police_station_incharge,head_of_station,police_email_id from police_station_list where police_station_id='$police_station_id'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
	
    $police_station_name=$row1[0];
    $police_station_address=$row1[1];
	$police_station_pincode=$row1[2];
	$police_station_incharge=$row1[3];
    $head_of_station=$row1[4];
    $police_email_id=$row1[5];
    
 }
}

?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $police_station_id=$_GET['police_station_id'];
    
    $head_of_station=$_POST['head_of_station'];
    $police_station_incharge=$_POST['police_station_incharge'];

  
	  $update1 = "UPDATE police_station_list SET police_station_incharge='$police_station_incharge', head_of_station='$head_of_station' where police_station_id='$police_station_id'";
	  $sql2=mysqli_query($conn,$update1);
if($sql2)
	  { 
		  $showAlert=true;
          header("location:manage_police_station_list.php");

          
		 
	  }
	  else
	  {
		  //$showError=true;
		 
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
    <div class="alert alert-danger ">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
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
   								<img src="images/manage_police_station.png" alt="User Avatar" class="rounded-circle p-1 border border-5 border-primary" width="110">
								<div class="mt-3">
		
									 <h4>Head: <?php echo $head_of_station?></h4>
									<p class="text-secondary mb-1">Incharge: <?php echo $police_station_incharge?></p>
									<p class="text-secondary mb-1"><?php echo $police_station_pincode?></p>
									
								
				
									
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
									<h6 class="mb-0">police_station_name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $police_station_name?>" name="police_station_name"id="police_station_name" disabled>
								</div>
		
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station pincode</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $police_station_pincode?>" name="police_station_pincode" disabled>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station incharge</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control"  name="police_station_incharge" id="police_station_incharge" placeholder="enter the police station incharge">

								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Head of station</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control"  name="head_of_station" id="head_of_station" placeholder="enter the head of station">

								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station email id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="email" class="form-control"  name="police_email_id" id="police_email_id" value="<?php echo $police_email_id?>" disabled>

								</div>
							</div>
							
                            
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Save Changes"  required>
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
