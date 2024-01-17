
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

 $select_display= "select * from admin where email_id='$email_id'" ;
 $select_sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($select_sql1)){
 $email_id=$row1[3];
 $admin_role_type=$row1[2];
 
 }

 
 }
 

?>

	

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome </title>
</head>
<body>



    

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>
<?php if($admin_role_type!='feedback'){?>
    

<div class="container">
  <div class="main-body ">
    <h4 class="d-flex flex-column align-items-center text-center">Welcome to <span style='color: #FFD700;'>Tech Wizard Police Administration Portal</span></h4><br><br>

    <!--list product-->
    <div class="row">

      <div class='col-lg-4'>
        <div class='card' style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
          <div class='card-body'>
            <div class='d-flex flex-column align-items-center text-center'>
              <img src='images/manage_users.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110'>
              <div class='mt-3'>
                <h5 class="card-title">Manage Users</h5>
                <div>
                
                </div>
                <a class='btn btn-primary' href='manage_users.php'>Manage Users</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class='col-lg-4'>
        <div class='card' style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
          <div class='card-body'>
            <div class='d-flex flex-column align-items-center text-center'>
              <img src='images/manage_administration.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110'>
              <div class='mt-3'>
                <h5 class="card-title">Manage Administration</h5>
                <div>
                  
                </div>
                <a class='btn btn-primary' href='manage_administration.php'>Manage Admin</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class='col-lg-4'>
        <div class='card' style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
          -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
          <div class='card-body'>
            <div class='d-flex flex-column align-items-center text-center'>
              <img src='images/manage_police_station.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110'>
              <div class='mt-3'>
                <h5 class="card-title">Manage Police Station</h5>
                <div>
                
                </div>
                <a class='btn btn-primary' href='manage_police_station_list.php'>Manage</a>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class='col-lg-4'>
        <div class='card' style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
          <div class='card-body'>
            <div class='d-flex flex-column align-items-center text-center'>
               <img src='images/manage_complaint.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110'>
              <div class='mt-3'>
                <h5 class="card-title">Manage Complaint</h5>
                <div>
                  
                </div>
                <a class='btn btn-primary' href='manage_complaint_request.php'>Manage Complaint</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
}
else{?>
    
<div class="container">
  <div class="main-body ">
    <h4 class="d-flex flex-column align-items-center text-center">Welcome to <span style='color: #FFD700;'>Tech Wizard Police Administration Portal</span></h4><br><br>

    <!--list product-->
    <div class="row">

      

     





      <div class='col-lg-4'>
        <div class='card' style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
          <div class='card-body'>
            <div class='d-flex flex-column align-items-center text-center'>
               <img src='images/feedback.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110'>
              <div class='mt-3'>
                <h5 class="card-title">Manage feedback</h5>
                <div>
                  
                </div>
                <a class='btn btn-primary' href='manage_feedback.php'>Manage feedback</a>
              </div>
            </div>
          </div>
        </div>
      </div><?php
}?>
    </div>

    <br><br>

  </div>
</div>
</div>



</div>

				        

    

    <style type="text/css">
body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: white;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.table{
    border: 1px solid black;
    
}
td,th{ 
text-align: left;
  padding: 8px;
  
}
.me-2 {
    margin-right: .5rem!important;
}
.payment-icon-big {
  font-size: 60px;
  color: #FFD700;
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

