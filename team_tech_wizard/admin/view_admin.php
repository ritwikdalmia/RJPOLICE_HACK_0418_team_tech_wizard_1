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
 $admin_id=$_GET['admin_id'];


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
<title>view users</title>
<body>



    

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>



    <div class="container">
		<div class="main-body">
            <!--list product-->

			<div class="row">
                <!--fetch product-->
                <?php
    $select_display="select * from admin INNER JOIN police_station_list ON admin.police_station=police_station_list.police_email_id where admin.admin_id='$admin_id'" ;
    $sql1 = mysqli_query($conn,$select_display);
                                               while($row=mysqli_fetch_assoc($sql1)){
                                                $admin_id=$row['admin_id'];
                                                $full_name=$row['full_name'];
                                                $email_id=$row['email_id'];
                                                $admin_role_type=$row['admin_role_type'];
                                                $gender=$row['gender'];
                                                $police_station_name=$row['police_station_name'];
                                                $police_station_pincode=$row['police_station_pincode'];
                                              
                                               
                                                $head_of_station=$row['head_of_station'];  
                                                $police_email_id=$row['police_email_id'];      
                                                $disabled_account=$row['disabled_account'];
                                                $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
                            
                                                       
                               
                               
                
                        
                        echo "<div class='col-lg-6'>
                    
                        <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
                            <div class='card-body'>
                                <div class='d-flex flex-column align-items-center text-center'>
                                    <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                                    <div class='mt-3'>
                                    <table>
                                    <tr>
                                    <th>admin Id:</th> 
                                    <td>$admin_id</td>
                                    
                                </tr>
                                <tr>
                                    <th>full name:</th> 
                                    <td>$full_name</td>
                                    
                                </tr>
                                <tr>
                                    <th>email Id::</th> 
                                    <td>$email_id</td>
                                </tr>

                                <tr>
                                    <th>Admin role:</th> 
                                    <td>$admin_role_type</td>
                                    
                                </tr>

                                <tr>
                                    <th>police station Name:</th> 
                                    <td>$police_station_name</td>
                                    
                                </tr>

                                <tr>
                                    <th>police station Pincode:</th> 
                                    <td>$police_station_pincode</td>
                                    
                                </tr>

                                <tr>
                                    <th>head of station:</th> 
                                    <td>$head_of_station</td>
                                    
                                </tr>

                                <tr>
                                <th>police email Id:</th> 
                                <td>$police_email_id</td>
                                
                            </tr>

                           

                                                  
                                    
                                </table>
            
                                        
                                      
                                        
                                        
                                  
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>";


                }
                ?>
				
				
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
table{
    width:100%;
}
tr ,th{
text-align: left;
  padding: 8px;
  
}

@media (max-width: 350px) {
    .card{
        font-size:9px !important;
    }
 }
 
@media ( min-width:375px) {
    .card{
        font-size:11px !important;
    }
 }
 @media ( min-width:1024px) {
    .card{
        font-size:9px !important;
    }
 }
 @media ( min-width:1440px) {
    .card{
        font-size:15px !important;
    }
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