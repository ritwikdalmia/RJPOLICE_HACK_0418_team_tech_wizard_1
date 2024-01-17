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
$select_profile= "select email_id,address,state,city,zip,police_station,gender from profile where email_id='$email_id'" ;
 $sql_profile = mysqli_query($conn,$select_profile);
 while($row2 = mysqli_fetch_array($sql_profile)){
  
 $email_id=$row2[0];
 
 $address=$row2[1];
 $state=$row2[2];
 $city=$row2[3];
 $zip=$row2[4];
 $police_station=$row2[5];
 $gender=$row2[6];
 
 }




$select_display= "select * from change_address where email_id='$email_id' and permission=2" ;
    $result_email_id=mysqli_query($conn, $select_display) or die (mysqli_error($conn));
    $numExistRows = mysqli_num_rows($result_email_id);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email_id1 = $_POST["email_id"];
    $address1=$_POST["address"];
    $state1=$_POST["state"];
    $city1=$_POST["city"];
    $zip1=$_POST["zip"];
    $police_station1=$_POST['police_station'];
     $file_upload = $_FILES['pdf_file']['name'];
    

	if (($address1==$address)){
        $errors['address'] = "New address cannot be same as current address ";

    }
     if($numExistRows > 0){
        // $exists = true;
        $errors['data'] = "You already applied for profile update";
    }
    
	if (empty($errors)) {
   


	

    
 if (isset($_FILES['pdf_file']['name'])) {
    // If the ‘pdf_file’ field has an attachment
    $file_upload = $_FILES['pdf_file']['name'];
    $file_tmp = $_FILES['pdf_file']['tmp_name'];
    $unique_id = time();
    $file_upload = $unique_id . '_' . $file_upload;

    // Check if the file has a PDF extension
    $file_extension = strtolower(pathinfo($file_upload, PATHINFO_EXTENSION));
    if ($file_extension == 'pdf') {
        // Move the uploaded PDF file into the pdf folder
        move_uploaded_file($file_tmp, "./users_images/" . $file_upload);
        $sql = "INSERT INTO `change_address`(`email_id`,`address`,`state`,`city`,`zip`,`police_station`,`file_upload`,`permission`) values('$email_id','$address1','$state1','$city1','$zip1','$police_station','users_images/$file_upload','2')";
            
            $result = mysqli_query($conn, $sql);
			
           
				

			

				

				
            echo 'successfull';
			header('location:change_address_request.php');
       
    } else {
         $errors['file_type'] = "Invalid file type. Only PDF files are allowed.";
    }
}
                           

	


	

        // $exists = false; 
     
     
       
       
      
           
            
            
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
									<p class="text-muted font-size-sm"><?php echo $Mno?></p>
								
				
									
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
							<form action="change_address.php" method="POST" enctype="multipart/form-data">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email Id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"   name="email_id" id="email_id" value=<?php echo "$email_id"?>   disabled>
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
									<input type="text" class="form-control" value="<?php  echo $police_station_name.' '.$police_station_pincode ; ?>" name="police_station" id="police_station" disabled>

								
									</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Upload proof</h6>
								</div>
							<div class="col-sm-9 text-secondary">
							<input type="file" name="pdf_file" id="pdf_file" class="form-control" accept=".pdf" required/>	
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