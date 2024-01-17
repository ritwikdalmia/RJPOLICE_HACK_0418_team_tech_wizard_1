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

 $select_display= "select * from users where email_id='$email_id'" ;
 $select_sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($select_sql1)){
 $email_id=$row1[2];
 
 }
 
 $select_display= "select gender from profile where email_id='$email_id'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
	$gender=$row1[0];
    $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';


 }


 
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
                
					<!--card form-->
					
						
						
						
							<p style="color:red;"><b>Pending Requests</b></p>
					</div>
					
				

            <div class='row'>
                <!--fetch product-->
                <?php


    $select_display2="select * from application_request where registered_by='$email_id' and permission=2" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
        $complaint_id=$row['complaint_id'];
        $full_name=$row['full_name'];
        $incident_date=$row['incident_date'];
        $complaint_date=$row['complaint_date'];  
        $police_station_user=$row['police_station_user'];
        $description_complaint=$row['description_complaint'];
        $permission=$row['permission'];
        if($permission==0){
            $permission='Completed';
        }
        else if($permission==1){

            $permission='Ongoing';
        }
        else{
            $permission='Pending';
        }
                  
        echo "
                        <div class='col-lg-4'>
                    
                        <div class='card'  style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                            <div class='card-body' >
                                <div class='d-flex flex-column align-items-center text-center'>
                                    <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                                    <div class='mt-3'>
                                    <table>
                                    <tr>
                                    <th>Complaint Id:</th> 
                                    <td>$complaint_id</td>
                                    
                                </tr>
                                <tr>
                                    <th>full name:</th> 
                                    <td>$full_name</td>

                                </tr>

                                <tr>
                                <th>incident date:</th> 
                                <td>$incident_date</td>

                            </tr>

                            <tr>
                            <th>Complaint date:</th> 
                            <td>$complaint_date</td>

                        </tr>
                                <tr>
                                    <th>police station:</th> 
                                    <td>$police_station_user</td>
                                    
                                </tr>
                                <tr>
                                <th>Complaint Description:</th> 
                                <td>$description_complaint</td>
                                
                            </tr>
                                <tr>
                                <th>Status:</th> 
                                <td>$permission</td>
                                
                            </tr>

                                </table>
                                <div><br><br></div>
                                <a class='btn btn-secondary' href='request_pending_user.php'>Pending</a>
            
                                        
                                      
                                   
                                        
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




        <!-- okie -->


        <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Ongoing Requests</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php

$select_display2="select * from application_request where registered_by='$email_id' and permission=1" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
         
        $complaint_id=$row['complaint_id'];
        $full_name=$row['full_name'];
        $incident_date=$row['incident_date'];
        $complaint_date=$row['complaint_date'];  
        $police_station_user=$row['police_station_user'];
        $complaint_assigned_to=$row['complaint_assigned_to'];
        $permission=$row['permission'];
        if($permission==0){
            $permission='Completed';
        }
        else if($permission==1){

            $permission='Ongoing';
        }
        else{
            $permission='Pending';
        }
                  
              
    echo "
                    <div class='col-lg-4'>
                
                    <div class='card'  style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                        <div class='card-body'>
                            <div class='d-flex flex-column align-items-center text-center'>
                                <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                                <div class='mt-3'>
                                <table>
                                <tr>
                                    <th>Complaint Id:</th> 
                                    <td>$complaint_id</td>
                                    
                                </tr>
                                <tr>
                                    <th>full name:</th> 
                                    <td>$full_name</td>

                                </tr>

                                <tr>
                                <th>incident date:</th> 
                                <td>$incident_date</td>

                            </tr>

                            <tr>
                            <th>Complaint date:</th> 
                            <td>$complaint_date</td>

                        </tr>
                                <tr>
                                    <th>police station:</th> 
                                    <td>$police_station_user</td>
                                    
                                </tr>
                                <tr>
                                <th>complaint assigned:</th> 
                                <td>$complaint_assigned_to</td>
                                
                            </tr>
                                <tr>
                                <th>status:</th> 
                                <td>$permission</td>
                                
                            </tr>

                            </table>
                            <div><br><br></div>
                            <a class='btn btn-success' href='request_ongoing_user.php'>Know more</a>
        
                                    
                                  
                               
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                ";


            }
        
            ?>
            </div>
            
            



        <!-- okie -->



        
			<div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Completed</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php


$select_display2="select * from application_request where registered_by='$email_id' and permission=0" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
         
        $complaint_id=$row['complaint_id'];
        $full_name=$row['full_name'];
        $incident_date=$row['incident_date'];
        $complaint_date=$row['complaint_date'];  
        $police_station_user=$row['police_station_user'];
        $complaint_assigned_to=$row['complaint_assigned_to'];
        $feedback_permission=$row['feedback_permission'];
       
        $permission=$row['permission'];
        if($permission==0){
            $permission='Completed';
        }
        else if($permission==1){

            $permission='Ongoing';
        }
        else{
            $permission='Pending';
        }
                  
    echo "
                    <div class='col-lg-4'>
                
                    <div class='card'  style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                        <div class='card-body'>
                            <div class='d-flex flex-column align-items-center text-center'>
                                <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                                <div class='mt-3'>
                                <table>
                                <tr>
                                <th>Complaint Id:</th> 
                                <td>$complaint_id</td>
                                
                            </tr>
                            <tr>
                                <th>full name:</th> 
                                <td>$full_name</td>

                            </tr>

                            <tr>
                            <th>incident date:</th> 
                            <td>$incident_date</td>

                        </tr>

                        <tr>
                        <th>Complaint date:</th> 
                        <td>$complaint_date</td>

                    </tr>
                            <tr>
                                <th>police station:</th> 
                                <td>$police_station_user</td>
                                
                            </tr>

                            <tr>
                                <th>complaint resolved:</th> 
                                <td>$complaint_assigned_to</td>
                                
                            </tr>
                        
                            <tr>
                            <th>Status:</th> 
                            <td>$permission</td>
                            
                        </tr>

                            </table>
                            <div><br><br></div>";
                            if($feedback_permission==0){
                                echo "<a class='btn btn-primary' href='feedback_valuable.php?complaint_id=$complaint_id'>feedback</a>";
                               
                            }
                            else{
                                echo "<a class='btn btn-primary' href='request_thank_you.php'>thank you</a>";

                            }
                            
                          
        
                                    
                                  
                               
                                    echo "
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











        <!-- okie -->
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