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
 
 }

 $select_display= "select gender from profile where email_id='$email_id'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
	$gender=$row1[0];
    $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';


 }

 $sql_option3 = "
    SELECT DISTINCT police_station_pincode, police_station_name, police_email_id
    FROM police_station_list
    JOIN admin_change_address ON admin_change_address.police_station = police_station_list.police_email_id
    WHERE police_station_list.police_email_id = admin_change_address.police_station";


									$select_sql5 = mysqli_query($conn,$sql_option3);
									while($row4 = mysqli_fetch_assoc($select_sql5)){
                                        $police_station_pincode=$row4['police_station_pincode'];
                                        $police_email_id=$row4['police_email_id'];
                                        $police_station_name=$row4['police_station_name'];
										
									
								
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


    $select_display2="select * from admin_change_address where email_id='$email_id' and permission=2" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
        $address_id=$row['address_id'];
        $email_id=$row['email_id'];
        $address=$row['address'];
        $state=$row['state']; 
        $city=$row['city'];
        $zip=$row['zip']; 
        $police_station=$row['police_station'];
        $file_upload=$row['file_upload'];
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
                    
                        <div class='card' style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                            <div class='card-body' >
                                <div class='d-flex flex-column align-items-center text-center'>
                                    <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                                    <div class='mt-3'>
                                    <table>
                                    <tr>
                                    <th>address Id:</th> 
                                    <td>$address_id</td>
                                    
                                </tr>
                                <tr>
                                    <th>New address:</th> 
                                    <td>$address</td>

                                </tr>

                                <tr>
                                <th>state:</th> 
                                <td>$state</td>

                            </tr>

                            <tr>
                            <th>city:</th> 
                            <td>$city</td>

                          </tr>
                          <tr>
                            <th>Zip:</th> 
                            <td>$zip</td>

                            </tr>
                                <tr>
                                    <th>Current police station:</th> 
                                    <td>$police_station_name - $police_station_pincode</td>
                                    
                                </tr>
                               
                                <tr>
                                <th>permission:</th> 
                                <td>$permission</td>
                                
                            </tr>

                                </table>
                                <div><br><br></div>
                                <a class='btn btn-secondary' href='request_pending_user.php' >Pending</a>
                                <a class='btn btn-primary' href='admin_view_uploaded_files.php?address_id=$address_id' >view uploaded file</a>

            
                                        
                                      
                                   
                                        
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
                
                    
                    
                    
                        <p style="color:red;"><b>Requests Rejected</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php

$select_display2="select * from admin_change_address where email_id='$email_id' and permission=1" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
        $address_id=$row['address_id'];
        $email_id=$row['email_id'];
        $address=$row['address'];
        $state=$row['state'];  
        $city=$row['city'];
        $zip=$row['zip'];
        $police_station=$row['police_station'];
        $file_upload=$row['file_upload'];
        $permission=$row['permission'];
        
        $comment=$row['comment'];
        if($permission==0){
            $permission='Completed';
        }
        else if($permission==1){

            $permission='rejected';
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
                            <th>address Id:</th> 
                            <td>$address_id</td>
                            
                        </tr>
                        <tr>
                            <th>New address:</th> 
                            <td>$address</td>

                        </tr>

                        <tr>
                        <th>state:</th> 
                        <td>$state</td>

                    </tr>

                    <tr>
                    <th>city:</th> 
                    <td>$city</td>

                  </tr>
                  <tr>
                    <th>Zip:</th> 
                    <td>$zip</td>

                    </tr>
                        <tr>
                            <th>Current police station:</th> 
                            <td>$police_station_name - $police_station_pincode</td>
                            
                        </tr>
                       
                        <tr>
                        <th>permission:</th> 
                        <td>$permission</td>
                        
                    </tr>
                    <tr>
                    <th>Reason:</th> 
                    <td>$comment</td>
                    
                </tr>

                        </table>
                        <div><br><br></div>
                        <a class='btn btn-primary' href='admin_view_uploaded_files.php?address_id=$address_id' >view uploaded file</a>

    
                                
                              
                           
                                
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

$select_display2="select * from admin_change_address where email_id='$email_id' and permission=0" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
        $address_id=$row['address_id'];
        $email_id=$row['email_id'];
        $address=$row['address'];
        $state=$row['state'];  
        $city=$row['city'];
        $zip=$row['zip'];
        $police_station=$row['police_station'];
        $file_upload=$row['file_upload'];
        $permission=$row['permission'];
        
        $comment=$row['comment'];
        if($permission==0){
            $permission='Completed';
        }
        else if($permission==1){

            $permission='rejected';
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
                            <th>address Id:</th> 
                            <td>$address_id</td>
                            
                        </tr>
                        <tr>
                            <th>New address:</th> 
                            <td>$address</td>

                        </tr>

                        <tr>
                        <th>For More Details</th> 
                        <td>see profile</td>

                    </tr>

                       
                      
                    
                  

                        </table>
                        <div><br></div>
                        <a class='btn btn-primary' href='profile.php' >view profile</a>

    
                                
                              
                           
                                
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