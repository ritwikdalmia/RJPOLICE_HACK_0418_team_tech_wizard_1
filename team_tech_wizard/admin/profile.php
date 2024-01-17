<?php
 session_start();

$showAlert=false;
$showError=false;

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
	header("location:login.php");
     exit;
 }
 else{
    
 include "dbconnect.php";
 $email_id=$_SESSION['email_id'];
 $select_display= "select admin_id,full_name,email_id,Mno,police_station,gender,address,state,city,zip from admin_profile where email_id='$email_id'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
    $admin_id=$row1[0];
	$full_name=$row1[1];
	$email_id=$row1[2];
	$Mno=$row1[3];
	$police_station=$row1[4];
    $gender=$row1[5];
 	$address1=$row1[6];
 	$state=$row1[7];
 	$city=$row1[8];
 	$zip=$row1[9];
 }
 
}

?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $email_id=$_SESSION['email_id'];
   
   $address=$_POST['address'];
   $state=$_POST['state'];
   $city=$_POST['city'];
   $zip=$_POST['zip'];


   //$email=$_POST['email'];
   if($address1!='NULL'){
    $showError=true;
 }
 else{

 
  
  
  
	$update = "update admin_profile set address='$address',state='$state',city='$city',zip='$zip' where email_id='$email_id'";
		$sql2=mysqli_query($conn,$update);
  if($sql2)
		{ 
			$showAlert=true;
		   
		}
		else
		{
			//$showError=true;
		   
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
                <strong>profile cannot be edited please go to settings</strong> 
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
				<div class="col-lg-4 box-km">
					<div class="card" style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<?php
								$avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
								?>
   								<img src="<?php echo $avatarUrl; ?>" alt="User Avatar" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
		
									 <h4><?php echo $full_name?></h4>
									<p class="text-secondary mb-1"><?php echo $email_id?></p>
									<p class="text-muted font-size-sm"><?php echo $Mno?></p>
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm box-km">
					<div class="card" style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="profile.php" method="post">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $full_name?>" name="full_name"id="full_name" disabled>
								</div>
		
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $email_id?>" disabled>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mobile</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $Mno?>"  name="Mno" id="Mno" disabled>
								</div>
							</div>

							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Gender</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $gender?>"  name="gender" id="gender" disabled>
								</div>
							</div>

							
							

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station</h6>
								</div>
								<div class="col-sm-9 text-secondary">

								<?php 
									$sql_option3 = "
    SELECT DISTINCT police_station_pincode, police_station_name, police_email_id
    FROM police_station_list
    JOIN admin_profile ON admin_profile.police_station = police_station_list.police_email_id
    WHERE police_station_list.police_email_id = admin_profile.police_station";


									$select_sql5 = mysqli_query($conn,$sql_option3);
									while($row4 = mysqli_fetch_assoc($select_sql5)){
                                        $police_station_pincode=$row4['police_station_pincode'];
                                        $police_email_id=$row4['police_email_id'];
                                        $police_station_name=$row4['police_station_name'];
										
									
								
									}
									?>
									<input type="text" class="form-control" value="<?php  echo $police_station_name.' '.$police_station_pincode ; ?>" name="police_station" id="police_station" disabled>

								
									</div>
							</div>










							<?php 
							$sql_option3 = "
							SELECT address from admin_profile where email_id='$email_id'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$address =$row4['address'];
	
}
if ($address!='NULL'){
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>Address</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $address' name='address' id='address' disabled>
</div>
</div>";}
else{
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>Address</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter address' name='address' id='address'  required>
								</div>
							</div>";

}

							?>







							<?php 
							$sql_option3 = "
							SELECT state from admin_profile where email_id='$email_id'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$state =$row4['state'];
	
}
if ($state!='NULL'){
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>state</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $state' name='state' id='state' disabled>
</div>
</div>";}
else{
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>state</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter state' name='state' id='state'  required>
								</div>
							</div>";

}

							?>
							


							<?php 
							$sql_option3 = "
							SELECT city from admin_profile where email_id='$email_id'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$city =$row4['city'];
	
}
if ($city!='NULL'){
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>city</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $city' name='city' id='city' disabled>
</div>
</div>";
}
else{
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>city</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter city' name='city' id='city'  required>
								</div>
							</div>";

}

							?>
							

							<?php 
							$sql_option3 = "
							SELECT zip from admin_profile where email_id='$email_id'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$zip =$row4['zip'];
	
}
if ($zip!=0){
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>zip</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $zip' name='zip' id='zip' disabled>
</div>
</div>";}
else{
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>zip</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter zip' name='zip' id='zip' pattern='[0-9]{6}' title='Please enter a valid 6-digit zip number.'  required>
								</div>
							</div>";

}

							?>
							
							
                            
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
