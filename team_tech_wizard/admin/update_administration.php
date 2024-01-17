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
 $admin_id=$_GET['admin_id'];
 $select_display= "select full_name,police_station,email_id,gender,admin_role_type from admin where admin_id='$admin_id'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
	
    $full_name1=$row1[0];
    $police_station1=$row1[1];
	$admin_role_type1=$row1[4];
	$email_id1=$row1[2];
    $gender1=$row1[3];
    
 }
 $select_display="select * from police_station_list INNER JOIN admin on admin.police_station=police_station_list.police_email_id where admin_id='$admin_id'" ;
                   $sql1 = mysqli_query($conn,$select_display);
                   while($row=mysqli_fetch_assoc($sql1)){

                    $police_station_id=$row['police_station_id'];
                    $police_station_name =$row['police_station_name'];
                    $police_station_pincode=$row['police_station_pincode'];    
   


}
 }

?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $admin_id=$_GET['admin_id'];
    
    $admin_role_type=$_POST['admin_role_type'];
    $police_station=$_POST['police_station'];

  
   $sql_police = "SELECT * FROM `admin` WHERE police_station = '$police_station' and admin_role_type='$admin_role_type'";
   $result_police=mysqli_query($conn, $sql_police) or die (mysqli_error($conn));
   $numExistRows2 = mysqli_num_rows($result_police);

   if($numExistRows2 > 0){
    // $exists = true;
    $errors['police'] = "police station is already assign with the same admin role type";
}



if (empty($errors)) {
	  
	  $update1 = "UPDATE admin SET admin_role_type='$admin_role_type', police_station='$police_station' where admin_id='$admin_id'";
	  $sql2=mysqli_query($conn,$update1);
	   $update2 = "UPDATE admin_profile SET police_station='$police_station' where admin_id='$admin_id'";
	  $sql3=mysqli_query($conn,$update2);
if($sql2)
	  { 
	      
		  $showAlert=true;
          header("location:manage_administration.php");

          
		 
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
								$avatarUrl = ($gender1 === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
								?>
   								<img src="<?php echo $avatarUrl; ?>" alt="User Avatar" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
		
									 <h4><?php echo $full_name1?></h4>
									<p class="text-secondary mb-1"><?php echo $admin_role_type1?></p>
									<p class="text-secondary mb-1"><?php echo $police_station_name.' '.$police_station_pincode?></p>
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
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $full_name1?>" name="full_name"id="full_name" disabled>
								</div>
		
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $email_id1?>" disabled>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Admin Role type</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<select name="admin_role_type" class="form-control" id="admin_role_type" required>
                                	<?php 
									if ($admin_role_type=='admin'){

									$sql_option="select * from admin_role where role_available='available'";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row4 = mysqli_fetch_assoc($select_sql2)){?>
									
										 <option value= "<?php echo $row4['admin_role_type']?>"><?php echo $row4['admin_role_type']?></option>;
									
									<?php
									}
								}
								else{
									$sql_option="select * from admin_role where admin_role_type!='admin' and admin_role_type!='station-admin'";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row4 = mysqli_fetch_assoc($select_sql2)){?>
									
										 <option value= "<?php echo $row4['admin_role_type']?>"><?php echo $row4['admin_role_type']?></option>;
										 <?php

								}
							}
									?>
								
         							</select>
								</div>
							</div>


							

							
							

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">police station</h6>
								</div>
							 	<div class="col-sm-9 text-secondary">
                                 <select name="police_station" class="form-control" id="police_station" required>
                                	<?php 
									$sql_option3="select distinct police_email_id, police_station_pincode,police_station_name from police_station_list order by police_station_pincode";

									$select_sql5 = mysqli_query($conn,$sql_option3);
									while($row4 = mysqli_fetch_assoc($select_sql5)){
                                        $police_station_pincode=$row4['police_station_pincode'];
                                        $police_email_id=$row4['police_email_id'];
                                        $police_station_name=$row4['police_station_name'];?>
										 <option value= "<?php  echo $police_email_id ?>"><?php  echo $police_station_name.' '.$police_station_pincode ; ?></option>;
									
									<?php
									}
									?>
								
         							</select>
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
