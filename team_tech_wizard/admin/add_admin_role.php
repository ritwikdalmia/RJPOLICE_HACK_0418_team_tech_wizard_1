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
$admin_role_type=$row1[2];

}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $admin_role_type = $_POST["admin_role_type"];
    $description=$_POST["description"];
	$email_id=$_POST["email_id"];
	date_default_timezone_set('Asia/Kolkata');
	$timestamp = date("Y-m-d H:i:s");
   

        // $exists = false; 
		$sql_role = "SELECT * FROM `admin_role` WHERE admin_role_type = '$admin_role_type'";
		$result_role=mysqli_query($conn, $sql_role) or die (mysqli_error($conn));
		$numExistRows = mysqli_num_rows($result_role);

		if($numExistRows > 0){
			// $exists = true;
			$showError=true;
		}
		else{
			$sql = "INSERT INTO `admin_role`(`admin_role_type`,`description`,`email_id`,`create_datetime`) VALUES ('$admin_role_type', '$description','$email_id','$timestamp')";
            
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
<?php

if ($admin_role_type === 'admin') {
  include('nav.php');
} elseif ($admin_role_type === 'moderator') {
  include('nav_moderator.php');
}?>  
        

<?php
if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! role added</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
	if($showError){
		echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>admin role that you have entered is already exist!</strong> 
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div> ';
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
							<img src="images/add_role.png" alt="Admin" class="rounded-circle bg-transparent"  height="200" width="200">
								
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
							<form action="add_admin_role.php" method="POST">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Admin Role Type</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter admin role type" name="admin_role_type" id="admin_role_type">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Description</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="description" id="description" placeholder="description">
								</div>
							</div>

							
							

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" style="display:none;">email_id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="hidden" class="form-control"   name="email_id" id="email_id" value="<?php echo $_SESSION['email_id']?>">
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="add role type">
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
        </div>
    </div>
<style>
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