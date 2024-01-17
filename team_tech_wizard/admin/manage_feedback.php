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
 
 $email_id1=$_SESSION['email_id'];

 
 }
 

?>

	

<!DOCTYPE html>
<html lang="en">

<body>



    

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>



    <div class="container">
		<div class="main-body">
            <!--list product-->

			<div class="row">
                <div class="col-lg-9 pl-5">
					<!--card form-->
					<div class="card"  style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="manage_feedback.php" method="POST">
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Search complaint Id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"  name="complaint_id" id="complaint_id" required>
								</div>
							</div>					
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Search">
								</div>
							</div>
						</div>
						</form>
					</div>
					
				</div>
	        </div>

            <div class='row'>
                <!--fetch product-->
                <?php



if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    $complaint_id = $_POST["complaint_id"];
 
 $select_display="SELECT 
        application_request.complaint_id,
        application_request.full_name,
        application_request.email_id,
        application_request.incident_date,
        application_request.complaint_date,
        application_request.police_station_user,
        application_request.police_station,
        application_request.registered_by,
        application_request.complaint_assigned_to,
        application_request.feedback,
        application_request.permission,
        application_request.feedback_permission,
        admin.email
    FROM 
        application_request
    LEFT JOIN 
        admin ON application_request.police_station = admin.police_station
    WHERE 
        application_request.permission = 0 
        AND application_request.feedback_permission = 0 and application_request.complaint_id='$complaint_id'" ;
    $sql1 = mysqli_query($conn,$select_display);
                   

                    while($row=mysqli_fetch_assoc($sql1)){
                        $complaint_id=$row['complaint_id'];
                        $full_name=$row['full_name'];
                        $email_id=$row['email_id'];
                        $incident_date=$row['incident_date'];
                        $complaint_date=$row['complaint_date'];
                        $police_station_user=$row['police_station_user'];
                        $police_station=$row['police_station'];
                        $registered_by=$row['registered_by'];
                        $complaint_assigned_to=$row['complaint_assigned_to'];
                        $feedback=$row['feedback'];
                        $permission=$row['permission'];
                        $feedback_permission=$row['feedback_permission'];
                    }
                    
                 

                   
                                                                      
   

echo "
<div class='col-lg-4'>

<div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
<div class='card-body'>
    <div class='d-flex flex-column align-items-center text-center'>
        <img src='images/feedback.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110'>
        <div class='mt-3'>
        <table>
        <tr>
        <th>Complaint  Id:</th> 
        <td>$complaint_id</td>
        
    </tr>
    <tr>
        <th>victim email id:</th> 
        <td>$email_id</td>

    </tr>

    

    <tr>
        <th>Incident Date:</th> 
        <td>$incident_date</td>
        
    </tr>
    <tr>
        <th>Complaint Date:</th> 
        <td>$complaint_date</td>
        
    </tr>
    <tr>
        <th>Police Station:</th> 
        <td>$police_station_user</td>
        
    </tr>

    <tr>
        <th>Police email Id:</th> 
        <td>$police_station</td>
        
    </tr>
    
    
    <tr>
    <th>Complaint Assigned To:</th> 
    <td>$complaint_assigned_to</td>
    
</tr>";

if($registered_by!=null){
    echo "
    <tr>
    <th>Registered email:</th> 
    <td>$registered_by</td>
    
</tr>";

}


if($feedback!=null){
    echo "
    <tr>
    <th>Feedback:</th> 
    <td>$feedback</td>
    
</tr>";

}
else{
    echo"
    <tr>
    <th>Feedback:</th> 
    <td>feedback Awaited</td>
    
</tr>";

}

echo"</table>
    
        
        <div><br><br></div>
       
        <a class='btn btn-primary' href='send_email.php?complaint_id=$complaint_id'>send reminder mail</a>
        ";

      

     
                            echo"
            
                                       
                                     
            
        </div>
    </div>
    
</div>
</div>
</div>
";


}

			     

    
else{
         
  $select_display = "
    SELECT 
        application_request.complaint_id,
        application_request.full_name,
        application_request.email_id,
        application_request.incident_date,
        application_request.complaint_date,
        application_request.police_station_user,
        application_request.police_station,
        application_request.registered_by,
        application_request.complaint_assigned_to,
        application_request.feedback,
        application_request.permission,
        application_request.feedback_permission,application_request.email_sent,
        admin.email
    FROM 
        application_request
    LEFT JOIN 
        admin ON application_request.police_station = admin.police_station
    WHERE 
        application_request.permission = 0 
        AND application_request.feedback_permission = 0 AND application_request.email_sent=0";
                   $sql1 = mysqli_query($conn,$select_display);
                   while($row=mysqli_fetch_assoc($sql1)){

                    $complaint_id=$row['complaint_id'];
                    $full_name=$row['full_name'];
                    $email_id=$row['email_id'];
                    $incident_date=$row['incident_date'];
                    $complaint_date=$row['complaint_date'];
                    $police_station_user=$row['police_station_user'];
                    $police_station=$row['police_station'];
                    $registered_by=$row['registered_by'];
                    $complaint_assigned_to=$row['complaint_assigned_to'];
                    $feedback=$row['feedback'];
                    $permission=$row['permission'];
                    $feedback_permission=$row['feedback_permission'];
                   }
                        echo "
                        <div class='col-lg-4'>
                    
                        <div class='card'style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
                            <div class='card-body'>
                            <div class='d-flex flex-column align-items-center text-center'>
                            <img src='images/feedback.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

                                    <div class='mt-3'>
                                    <table>
                                    <tr>
        <th>Complaint  Id:</th> 
        <td>$complaint_id</td>
        
    </tr>
    <tr>
        <th>victim email id:</th> 
        <td>$email_id</td>

    </tr>

    

    <tr>
        <th>Incident Date:</th> 
        <td>$incident_date</td>
        
    </tr>
    <tr>
        <th>Complaint Date:</th> 
        <td>$complaint_date</td>
        
    </tr>
    <tr>
        <th>Police Station:</th> 
        <td>$police_station_user</td>
        
    </tr>

    <tr>
        <th>Police email Id:</th> 
        <td>$police_station</td>
        
    </tr>
    
    
    <tr>
    <th>Complaint Assigned To:</th> 
    <td>$complaint_assigned_to</td>
    
</tr>";

if($registered_by!=null){
    echo "
    <tr>
    <th>Registered email:</th> 
    <td>$registered_by</td>
    
</tr>";

}


if($feedback!=null){
    echo "
    <tr>
    <th>Feedback:</th> 
    <td>$feedback</td>
    
</tr>";

}
else{
    echo"
    <tr>
    <th>Feedback:</th> 
    <td>feedback Awaited</td>
    
</tr>";
}
echo "

                               
                                </table>

                                <div><br><br></div>
                                <a class='btn btn-primary' href='send_email.php?complaint_id=$complaint_id'>send reminder mail</a>
                                ";

      

                            echo"
            
                                        
                                      
                                   
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    ";


                }
            
        
                ?>
                </div>
				
				
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
    background-color: #fff;
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
</style>




   
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>
