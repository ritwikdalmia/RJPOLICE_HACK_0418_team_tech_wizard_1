<?php
session_start();
$errors = array();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include "dbconnect.php";
$email_id=$_SESSION['email_id'];


$select_display= "select * from users where email_id='$email_id'" ;
$select_sql1 = mysqli_query($conn,$select_display);
while($row1 = mysqli_fetch_array($select_sql1)){
$email_id=$row1[2];

}
$select_profile= "select email_id,Mno,full_name,address,state,city,zip,gender from profile where email_id='$email_id'" ;
 $sql_profile = mysqli_query($conn,$select_profile);
 while($row2 = mysqli_fetch_array($sql_profile)){
  
 $email_id=$row2[0];
 $Mno1=$row2[1];
 $full_name1=$row2[2];
 $address=$row2[3];
 $state=$row2[4];
 $city=$row2[5];
 $zip=$row2[6];
 $gender=$row2[7];
 
 }


if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email_id = $_POST["email_id"];
    $full_name=$_POST["full_name"];
    $Mno=$_POST["Mno"];
    $incident_date=$_POST["incident_date"];
    $address=$_POST["address"];
    $state=$_POST["state"];
    $city=$_POST["city"];
    $zip=$_POST["zip"];
	$police_station_user=$_POST['police_station_user'];
    $police_station=$_POST['police_station'];
    $registered_by=$_POST['registered_by'];
	$description_complaint=$_POST['description_complaint'];
    
    
    if (($email_id==$registered_by)){
        $errors['registered_by'] = "User id and victims email can not be same please change victim email id";

    }
	  
    if (($Mno==$Mno1)){
        $errors['Mno'] = "Mobile Number should be of your friend";

    }
	if (($full_name==$full_name1)){
        $errors['full_name'] = "full name should be of your friend";

    }

	

	


	

        // $exists = false; 
     
        $ip_address = $_SERVER['REMOTE_ADDR'];     
        date_default_timezone_set('Asia/Kolkata');
		$complaint_date = date("Y-m-d H:i:s");
     

       
        if (empty($errors)) {
      
            $sql = "INSERT INTO `application_request`(`email_id`,`permission`, `full_name`, `Mno`,`incident_date`,`address`,`state`,`city`,`zip`,`police_station`,`police_station_user`,`complaint_date`,`registered_by`,`ip_address`,`description_complaint`) values('$email_id', '2', '$full_name','$Mno','$incident_date','$address','$state','$city','$zip','$police_station','$police_station_user','$complaint_date','$registered_by','$ip_address','$description_complaint')";
            
            $result = mysqli_query($conn, $sql);
           
				

			

				

				
            echo 'successfull';
			header('location:Requested_applications_user.php');
            
            
		}
    }
		
   


    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>register for someone else</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<!-- fontawesome icons
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://kit.fontawesome.com/2715ab056d.js" crossorigin="anonymous"></script>

</head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>

<body>

<div class="wrapper">
<?php include 'nav.php';?>
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
        
	<!--container start-->
<div class="container ">
		<div class="main-body">
			<div class="row">
				
					<!--card image card -->
					
					<div class="col-lg-4">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<?php
								$avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
								?>
   								<img src="<?php echo $avatarUrl; ?>" alt="User Avatar" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
		
									 <h4><?php echo $full_name1?></h4>
									<p class="text-secondary mb-1"><?php echo $email_id?></p>
									<p class="text-muted font-size-sm"><?php echo $Mno1?></p>
								
				
									
								</div>
							</div>
						</div>
					</div>
</div>
					
				
				<!--card style ended-->
				<div class="col-lg-8">
					<!--card form-->
					<div class="card"  style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="register_for_someone_else.php" method="POST">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Victim Email Id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"   name="email_id" id="email_id" placeholder="enter victim email id"   required>
								</div>
							</div>



							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">full name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="full_name" id="full_name"  placeholder="enter the name of your friend" required  >
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mno</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="Mno" id="Mno"  placeholder="enter Mobile number of your friend" pattern="[0-9]{10}" title="Please enter a valid 10-digit zip number." required >
								</div>
							</div>


							<script>
								<?php
// Get the current server date
$currentDate = date("Y-m-d");
?>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the current date in JavaScript
            var currentDate = new Date("<?php echo $currentDate; ?>");
            
            // Calculate the minimum date allowed (7 days ago)
            var minDate = new Date();
            minDate.setDate(currentDate.getDate() - 7);
            
            // Set the minimum date in the date input field
            document.getElementById('incident_date').min = minDate.toISOString().split('T')[0];
            
            // Set the maximum date in the date input field (today)
            document.getElementById('incident_date').max = currentDate.toISOString().split('T')[0];
        });
    </script>

                            

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">incident date</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="date" class="form-control "  name="incident_date" id="incident_date"  required>
								</div>
							</div>
						
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" placeholder="enter the address" name="address"id="address" required >
								</div>
							</div>
                            
                            
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">State</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter the state" name="state" id="state" required> 
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">City</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter the city" name="city" id="city" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">zip</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter the zip" name="zip" id="zip" pattern="[0-9]{6}" title="Please enter a valid 6-digit zip number." required>
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
    JOIN profile ON profile.police_station = police_station_list.police_email_id
    WHERE police_station_list.police_email_id = profile.police_station";


									$select_sql5 = mysqli_query($conn,$sql_option3);
									while($row4 = mysqli_fetch_assoc($select_sql5)){
                                        $police_station_pincode=$row4['police_station_pincode'];
                                        $police_email_id=$row4['police_email_id'];
                                        $police_station_name=$row4['police_station_name'];
										
									
								
									}
									?>
									<input type="text" class="form-control" value="<?php  echo $police_station_name.' '.$police_station_pincode ; ?>" name="police_station_user" id="police_station_user" readonly>
									<input type="hidden" class="form-control" value="<?php  echo $police_email_id; ?>" name="police_station" id="police_station">

								
									</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Complaint Description</h6>
								</div>
							<div class="col-sm-9 text-secondary">
									<textarea class="form-control" rows='3' placeholder="enter your complaint" name="description_complaint" id="description_complaint" required></textarea>
								</div>
							</div>
                            


                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" style="display:none" >Registered email id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="hidden" class="form-control"   name="registered_by" id="registered_by" value="<?php echo $_SESSION['email_id']?>">
								</div>
							</div>


							
                            

             
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="send request">
								</div>
							</div>
						</div>
						</form>
                        <p class="text-muted font-size-sm">&nbsp;&nbsp;please enter the full name , email id , Mobile number of victim person and complaint lodge at users police station details only</p>
						
						
					</div>
					
				</div>
			</div>
			<!--row ended-->
		</div>
	</div>

</div>
<br><br>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

 
</body>

</html>