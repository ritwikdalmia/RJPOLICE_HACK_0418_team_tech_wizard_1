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

		

            <div class='row'>
                <!--fetch product-->
                <?php



    
         
    $select_display="select * from police_station_list where  police_email_id='$police_email_id'" ;
                   $sql1 = mysqli_query($conn,$select_display);
                   while($row=mysqli_fetch_assoc($sql1)){

                     $police_station_id =$row['police_station_id'];
                    $police_station_name =$row['police_station_name'];
                    $police_station_address=$row['police_station_address'];    
                    $police_station_pincode=$row['police_station_pincode'];  
                    $police_station_incharge =$row['police_station_incharge'];
                    $police_station_number =$row['police_station_number'];
                    $emergency_no =$row['emergency_no'];
                    $head_of_station=$row['head_of_station'];  
                    $police_email_id=$row['police_email_id'];      
                        
                                                       
                               
                               
                
                        
                        echo "
                        <div class='col-lg-6'>
                    
                        <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
                            <div class='card-body'>
                                <div class='d-flex flex-column align-items-center text-center'>
                                <img src='images/manage_police_station.png' alt='Admin' class='rounded-circle p-1 border border-5 border-primary' width='110' height='110'>
                                <div class='mt-3'>
                                    <table>
                                   
                                    
                                <tr>
                                    <th>name:</th> 
                                    <td>$police_station_name</td>
                                    
                                </tr>

                                <tr>
                                    <th>address:</th> 
                                    <td>$police_station_address</td>
                                    
                                </tr>
                                
                                <tr>
                                    <th>pincode:</th> 
                                    <td>$police_station_pincode</td>
                                    
                                </tr>
                                <tr>
                                    <th>incharge:</th> 
                                    <td>$police_station_incharge</td>
                                    
                                </tr>
                                <tr>
                                    <th>Contact number:</th> 
                                    <td>$police_station_number</td>
                                    
                                </tr>

                                <tr>
                                <th>Emergency Number:</th> 
                                <td>$emergency_no</td>
                                
                                </tr>
                                <tr>
                                <th>Head of station:</th> 
                                <td>$head_of_station</td>
                                
                                 </tr>

                                <tr>
                                    <th>official email id :</th> 
                                    <td>$police_email_id</td>
                                </tr>
                                
                                 <tr>
                                    <th>Ratings :</th>
                                    
                                            <td><a class='btn btn-warning' href='feedback_rating.php?police_station_id=$police_station_id'>See rating</a></td>

                                   </tr>
                         

                               
                                </table>

                                <div><br><br></div>";
                                echo" <a class='btn btn-primary' href='welcome.php'>Back</a>
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
				<p>
        </p>
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
