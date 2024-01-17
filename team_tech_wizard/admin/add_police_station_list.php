<?php
session_start();

$showAlert=false;
$showError=false;

$errors = array();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include "dbconnect.php";
$email_id=$_SESSION['email_id'];

$select_display= "select * from admin where email_id='$email_id'" ;
$select_sql1 = mysqli_query($conn,$select_display);
while($row1 = mysqli_fetch_array($select_sql1)){
$email_id=$row1[3];

}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $police_station_name=$_POST["police_station_name"];
	$police_station_pincode=$_POST["police_station_pincode"];
    $police_station_address=$_POST["police_station_address"];
	$police_station_incharge=$_POST["police_station_incharge"];
	$police_station_number=$_POST["police_station_number"];
	$emergency_no=$_POST["emergency_no"];
	$head_of_station=$_POST["head_of_station"];
	$email_id=$_POST["email_id"];
	$police_email_id=$_POST["police_email_id"];
	

        // $exists = false; 

		


		$sql_address = "SELECT * FROM `police_station_list` WHERE police_station_address = '$police_station_address'";
		$result_address=mysqli_query($conn, $sql_address) or die (mysqli_error($conn));
		$numExistRows = mysqli_num_rows($result_address);
		//police station number
		$sql_station_number = "SELECT * FROM `police_station_list` WHERE police_station_number = '$police_station_number'";
		$result_station_number=mysqli_query($conn, $sql_station_number) or die (mysqli_error($conn));
		$numExistRows1 = mysqli_num_rows($result_station_number);
		//emergency_no
		$sql_emergency_no= "SELECT * FROM `police_station_list` WHERE emergency_no= '$emergency_no'";
		$result_emergency_no=mysqli_query($conn, $sql_emergency_no) or die (mysqli_error($conn));
		$numExistRows2 = mysqli_num_rows($result_emergency_no);

		//emergency_no
		$sql_email_id = "SELECT * FROM `police_station_list` WHERE police_email_id = '$police_email_id'";
		$result_email_id=mysqli_query($conn, $sql_email_id) or die (mysqli_error($conn));
		$numExistRows3 = mysqli_num_rows($result_email_id);


		$sql_name = "SELECT * FROM `police_station_list` WHERE police_station_name = '$police_station_name' and police_station_pincode=$police_station_pincode";
		$result_name=mysqli_query($conn, $sql_name) or die (mysqli_error($conn));
		$numExistRows4 = mysqli_num_rows($result_name);


		if($numExistRows > 0){
			// $exists = true;
			$errors['police_station_address'] = "police station address that you have entered is already exist!";
		}
		if($numExistRows1 > 0){
			// $exists = true;
			$errors['station_number'] = "police station Number that you have entered is already exist!";
		}
		if($numExistRows2 > 0){
			// $exists = true;
			$errors['emergency_no'] = "emergency no that you have entered is already exist!";
		}
		if($numExistRows3 > 0){
			// $exists = true;
			$errors['police_email_id'] = "Email_id no that you have entered is already exist!";
		}

		if($numExistRows4 > 0){
			// $exists = true;
			$errors['station_name'] = "same station name already exist with same pincode no that you have entered is already exist!";
		}
		if (empty($errors)) {
            $sql = "INSERT INTO `police_station_list`( `police_station_name`, `police_station_address`, `police_station_pincode`, `police_station_incharge`, `police_station_number`, `emergency_no`, `head_of_station`, `police_email_id`, `email_id`) VALUES ('$police_station_name', '$police_station_address', '$police_station_pincode', '$police_station_incharge', '$police_station_number', '$emergency_no', '$head_of_station', '$police_email_id', '$email_id')";
            
            $result = mysqli_query($conn, $sql);
            if($result){
				$showAlert=true;
		}

}
}
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin role</title>

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
<?php       
include 'dbconnect.php';        
                         
    ?>
<div class="wrapper">
<?php include 'nav.php';?>
        
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
        <strong>Successfully added</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
	// if($showError){
	// 	echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
	// 		<strong>admin role that you have entered is already exist!</strong> 
	// 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 			<span aria-hidden="true">&times;</span>
	// 		</button>
	// 	</div> ';
	// 	}
   

  
        
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
							<img src="images/manage_police_station.png" alt="Admin" class="bg-transparent"  height="200" width="200">
								
							</div>
							
						</div>
					</div>
				</div>
				
				<!--card style ended-->
				<div class="col-lg-8 box-lm">
					<!--card form-->
					<div class="card"  style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="add_police_station_list.php" method="POST">
							

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="police_station_name" id="police_station_name" placeholder="police station name"  pattern="^(?!.*\bPolice Station\b).*$" title="dont add police station" required>
								</div>
							</div>

                            
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="police_station_address" id="police_station_address" placeholder="police station address" title="add police station at the end"  pattern=".*police station$">
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station pincode</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="police_station_pincode" id="police_station_pincode" placeholder="police station pincode" pattern="\d{6}" title="Please enter a valid 6-digit PIN code">
								</div>
							</div>
                            


							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station incharge</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="police_station_incharge" id="police_station_incharge" placeholder="police station incharge" required>
								</div>
							</div>


                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station number</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="police_station_number" id="police_station_number" placeholder="enter number without adding 0" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number."  required>
								</div>
							</div>

                            
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">emergency number</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="emergency_no" id="emergency_no" placeholder="enter number without adding 0" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number."  required>
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Head of station</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="head_of_station" id="head_of_station" placeholder="head of station" required>
								</div>
							</div>

					
							
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" >police email id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control"   name="police_email_id" id="police_email_id" placeholder="example@gmail.com" required>
								</div>
							</div>

                            
								<div class="col-sm-9 text-secondary">
									<input type="hidden" class="form-control"   name="email_id" id="email_id" value="<?php echo $_SESSION['email_id']?>">
								</div>

							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="add police station">
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
</div>
<br><br>

<style>
	@media (max-width: 768px) {
		.box-lm{
			margin-top:5% !important
		}
}
	</style>
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