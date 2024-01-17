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
 $police_email_id=$row1[7];

 
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

       <style>
        .star {
            color: gray;
            font-size: 24px;
        }

        .yellow {
            color: yellow;
        }
    </style>
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>
    <div class="container">
		<div class="main-body">
            <!--list product-->

			<div class="row">
                
					<!--card form-->
					
						
						
						
							<p style="color:red;"><b>Reviews</b></p>
					</div>
					
				

            <div class='row'>
                <!--fetch product-->
                <?php


    $select_display2="SELECT * FROM application_request INNER JOIN police_station_list ON application_request.police_station = police_station_list.police_email_id WHERE application_request.shareability = 'yes' ORDER BY application_request.complaint_id DESC" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){

        $complaint_date=$row['complaint_date'];
       
        $full_name=$row['full_name'];
        $police_station_user=$row['police_station_user'] ;
        $police_station_address=$row['police_station_address'];

        $feedback=$row['feedback'];
        $shareability=$row['shareability'];
        $user_rating=$row['user_rating'];
       
       
                  
        echo "
                        <div class='col-lg-4'>
                    
                       <div class='card'  style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                            <div class='card-body' >
                                <div class='d-flex flex-column align-items-center text-center'>
                                <img src='images/feedback.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110'>
                                <div class='mt-3'>
                                    <table>
                                    <tr>
                                    <th>Complaint Date:</th> 
                                    <td>$complaint_date</td>

                                </tr>
                                   
                                <tr>
                                    <th>full name:</th> 
                                    <td>$full_name</td>

                                </tr>

                        <tr>
                            <th>police station :</th> 
                            <td>$police_station_user</td>

                        </tr>
                        <tr>
                        <th>police station Address :</th> 
                        <td>$police_station_address</td>

                    </tr>
                    
                     <th>Rating:</th>
      <td>";

// Assume user_rating is a variable containing the user's rating (between 1 and 5)

// Loop to display stars
for ($i = 1; $i <= 5; $i++) {
    if ($i <= $user_rating) {
        echo '<span class="star yellow">&#9733;</span>';
    } else {
        echo '<span class="star">&#9733;</span>';
    }
}

echo "
      </td>
   </tr>
   
                                <tr>
                                    <th>feedback:</th> 
                                    <td>$feedback</td>
                                    </tr>
                                    
                               

                                </table>
                                <div><br><br></div>
                                <a class='btn btn-primary' href='welcome.php' >Back</a>
            
                                        
                                      
                                   
                                        
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