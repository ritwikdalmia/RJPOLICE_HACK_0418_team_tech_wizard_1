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

 $select_display= "select * from admin where email_id='$email_id1'" ;
 $select_sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($select_sql1)){
 $email_id1=$row1[3];
 $admin_role_type=$row1[2];
 
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
                <div class="col-lg-9 pl-5">
					<!--card form-->
					<div class="card"  style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="manage_profile_updation.php" method="POST">
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Search Users</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"  name="email_id" id="email_id" required>
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

if ($admin_role_type=='admin'){


if($_SERVER["REQUEST_METHOD"] == "POST"){

   
  
    $email_id = $_POST["email_id"];
 
    $select_display="select profile.gender,profile.police_station,profile.address, profile.state,profile.city,profile.zip,change_address.address_id,change_address.address,change_address.state,change_address.city,change_address.zip,change_address.file_upload,change_address.comment,change_address.permission from profile INNER JOIN change_address ON change_address.email_id=profile.email_id where change_address.email_id='$email_id' " ;
                   $sql1 = mysqli_query($conn,$select_display);
                   while($row=mysqli_fetch_array($sql1)){

                    $gender=$row[0];
                    $current_police_station=$row[1];
                    $current_address=$row[2];
                    $current_state=$row[3];
                    $current_city=$row[4];
                    $current_zip=$row[5];
                    $address_id=$row[6];
                    $new_address=$row[7];
                    $new_state=$row[8];
                    $new_city=$row[9];
                    $new_zip=$row[10];
                    $file_upload=$row[11];
                    $comment=$row[12];
                    $permission=$row[13];
                    
                   
                    
                    $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';

                   
                                                                      
   

echo "
<div class='col-lg-4'>

<div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
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
                                        <th>current address:</th> 
                                        <td>$current_address</td>
                                        
                                    </tr>
                                    <tr>
                                    <th>current state:</th> 
                                    <td>$current_state</td>
                                    
                                </tr>
                                <tr>
                                <th>current city:</th> 
                                <td>$current_city</td>
                                
                            </tr>
                            <tr>
                            <th>current Zip:</th> 
                            <td>$current_zip</td>
                            
                        </tr>
                        <tr>
                        <th>current police station:</th> 
                        <td>$current_police_station</td>


                        
                    </tr>

                    <tr>
                    <th>new address:</th> 
                    <td>$new_address</td>
                    
                </tr>
                <tr>
                <th>new state:</th> 
                <td>$new_state</td>
                
            </tr>
            <tr>
            <th>new city:</th> 
            <td>$new_city</td>
            
        </tr>
        <tr>
        <th>new Zip:</th> 
        <td>$new_zip</td>
        
    </tr>
   
                                        <th>Email Id:</th> 
                                        <td>$email_id</td>
                                    </tr>

                                    
                                    
                                    
        </table>
        
        <div><br><br></div>
       
        <a class='btn btn-primary' href='view_uploaded_files.php?address_id=$address_id' target='_blank'>View file</a>";
                     
if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending_address_update.php?address_id=$address_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href=''>Rejected</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href=''>completed</a>
     ";}

      

      
                            echo"
            
                                       
                                     
            
        </div>
    </div>
    
</div>
</div>
</div>
";


}
			     
   

}
else{       
         
    $select_display="select profile.gender,profile.police_station,profile.address, profile.state,profile.city,profile.zip,change_address.address_id,change_address.address,change_address.state,change_address.city,change_address.zip,change_address.file_upload,change_address.comment,change_address.permission from profile INNER JOIN change_address ON change_address.email_id=profile.email_id where change_address.permission='2'" ;
    $sql1 = mysqli_query($conn,$select_display);
    while($row=mysqli_fetch_array($sql1)){

     $gender=$row[0];
     $current_police_station=$row[1];
     $current_address=$row[2];
     $current_state=$row[3];
     $current_city=$row[4];
     $current_zip=$row[5];
     $address_id=$row[6];
     $new_address=$row[7];
     $new_state=$row[8];
     $new_city=$row[9];
     $new_zip=$row[10];
     $file_upload=$row[11];
     $comment=$row[12];
     $permission=$row[13];
     
    
     
     $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';



       
     $sql_option3 = "
     SELECT DISTINCT police_station_pincode, police_station_name, police_email_id
     FROM police_station_list
     JOIN profile ON profile.police_station = police_station_list.police_email_id
     WHERE police_station_list.police_email_id = profile.police_station";
 
 
                                     $select_sql5 = mysqli_query($conn,$sql_option3);
                                     while($row4 = mysqli_fetch_assoc($select_sql5)){
                                         $police_station_pincode=$row4['police_station_pincode'];
                                         $police_email_id=$row4['police_email_id'];
                                         $police_station_name=$row4['police_station_name'];
                                         
                                     
                                 
                                     }
                                    
    
                                                       


echo "
<div class='col-lg-4'>

<div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
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
                         <th>current address:</th> 
                         <td>$current_address</td>
                         
                     </tr>
                     <tr>
                     <th>current state:</th> 
                     <td>$current_state</td>
                     
                 </tr>
                 <tr>
                 <th>current city:</th> 
                 <td>$current_city</td>
                 
             </tr>
             <tr>
             <th>current Zip:</th> 
             <td>$current_zip</td>
             
         </tr>
         <tr>
         <th>current police station:</th> 
         <td>$police_station_name - $police_station_pincode</td>


         
     </tr>

     <tr>
     <th>new address:</th> 
     <td>$new_address</td>
     
 </tr>
 <tr>
 <th>new state:</th> 
 <td>$new_state</td>
 
</tr>
<tr>
<th>new city:</th> 
<td>$new_city</td>

</tr>
<tr>
<th>new Zip:</th> 
<td>$new_zip</td>

</tr>

                         <th>Email Id:</th> 
                         <td>$email_id</td>
                     </tr>

                     
                     
                     
</table>

<div><br><br></div>

<a class='btn btn-primary' href='view_uploaded_files.php?address_id=$address_id' target='_blank'>View file</a>";

                 
if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending_address_update.php?address_id=$address_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href=''>Rejected</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href=''>completed</a>
     ";}




                   

             echo" 
                        
                      

</div>
</div>

</div>
</div>
</div>
                    ";


                }
            }
}
else{ 
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

   
  
        $email_id_user = $_POST["email_id"];
     
        $select_display="select profile.gender,profile.police_station,profile.address, profile.state,profile.city,profile.zip,change_address.address_id,change_address.address,change_address.state,change_address.city,change_address.zip,change_address.file_upload,change_address.comment,change_address.permission from profile INNER JOIN change_address ON profile.email_id=change_address.email_id inner join admin on admin.police_station=change_address.police_station where admin.email_id='$email_id1' and change_address.email_id='$email_id_user' order by change_address.address_id " ;
        $sql1 = mysqli_query($conn,$select_display);
    while($row=mysqli_fetch_array($sql1)){

     $gender=$row[0];
     $current_police_station=$row[1];
     $current_address=$row[2];
     $current_state=$row[3];
     $current_city=$row[4];
     $current_zip=$row[5];
     $address_id=$row[6];
     $new_address=$row[7];
     $new_state=$row[8];
     $new_city=$row[9];
     $new_zip=$row[10];
     $file_upload=$row[11];
     $comment=$row[12];
     $permission=$row[13];
     
    
     
     $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';



       
     $sql_option3 = "
     SELECT DISTINCT police_station_pincode, police_station_name, police_email_id
     FROM police_station_list
     JOIN profile ON profile.police_station = police_station_list.police_email_id
     WHERE police_station_list.police_email_id = profile.police_station";
 
 
                                     $select_sql5 = mysqli_query($conn,$sql_option3);
                                     while($row4 = mysqli_fetch_assoc($select_sql5)){
                                         $police_station_pincode=$row4['police_station_pincode'];
                                         $police_email_id=$row4['police_email_id'];
                                         $police_station_name=$row4['police_station_name'];
                                         
                                     
                                 
                                     }
                                    
    
                                                       


echo "
<div class='col-lg-4'>

<div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
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
                         <th>current address:</th> 
                         <td>$current_address</td>
                         
                     </tr>
                     <tr>
                     <th>current state:</th> 
                     <td>$current_state</td>
                     
                 </tr>
                 <tr>
                 <th>current city:</th> 
                 <td>$current_city</td>
                 
             </tr>
             <tr>
             <th>current Zip:</th> 
             <td>$current_zip</td>
             
         </tr>
         <tr>
         <th>current police station:</th> 
         <td>$police_station_name - $police_station_pincode</td>


         
     </tr>

     <tr>
     <th>new address:</th> 
     <td>$new_address</td>
     
 </tr>
 <tr>
 <th>new state:</th> 
 <td>$new_state</td>
 
</tr>
<tr>
<th>new city:</th> 
<td>$new_city</td>

</tr>
<tr>
<th>new Zip:</th> 
<td>$new_zip</td>

</tr>

                         <th>Email Id:</th> 
                         <td>$email_id</td>
                     </tr>

                     
                     
                     
</table>

<div><br><br></div>

<a class='btn btn-primary' href='view_uploaded_files.php?address_id=$address_id' target='_blank'>View file</a>";
                
if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending_address_update.php?address_id=$address_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href=''>Rejected</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href=''>completed</a>
     ";}

                   

             echo" 
                        
                      

</div>
</div>

</div>
</div>
</div>
                    ";

    
                            }
    }
    else{
                     
       
        $select_display="select profile.gender,profile.police_station,profile.address, profile.state,profile.city,profile.zip,change_address.address_id,change_address.address,change_address.state,change_address.city,change_address.zip,change_address.file_upload,change_address.comment,change_address.permission from profile INNER JOIN change_address ON profile.email_id=change_address.email_id inner join admin on admin.police_station=change_address.police_station where admin.email_id='$email_id1' and change_address.permission='2' order by change_address.address_id " ;
        $sql1 = mysqli_query($conn,$select_display);
    while($row=mysqli_fetch_array($sql1)){

     $gender=$row[0];
     $current_police_station=$row[1];
     $current_address=$row[2];
     $current_state=$row[3];
     $current_city=$row[4];
     $current_zip=$row[5];
     $address_id=$row[6];
     $new_address=$row[7];
     $new_state=$row[8];
     $new_city=$row[9];
     $new_zip=$row[10];
     $file_upload=$row[11];
     $comment=$row[12];
     $permission=$row[13];
     
    
     
     $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';



       
     $sql_option3 = "
     SELECT DISTINCT police_station_pincode, police_station_name, police_email_id
     FROM police_station_list
     JOIN profile ON profile.police_station = police_station_list.police_email_id
     WHERE police_station_list.police_email_id = profile.police_station";
 
 
                                     $select_sql5 = mysqli_query($conn,$sql_option3);
                                     while($row4 = mysqli_fetch_assoc($select_sql5)){
                                         $police_station_pincode=$row4['police_station_pincode'];
                                         $police_email_id=$row4['police_email_id'];
                                         $police_station_name=$row4['police_station_name'];
                                         
                                     
                                 
                                     }
                                    
    
                                                       


echo "
<div class='col-lg-4'>

<div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
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
                         <th>current address:</th> 
                         <td>$current_address</td>
                         
                     </tr>
                     <tr>
                     <th>current state:</th> 
                     <td>$current_state</td>
                     
                 </tr>
                 <tr>
                 <th>current city:</th> 
                 <td>$current_city</td>
                 
             </tr>
             <tr>
             <th>current Zip:</th> 
             <td>$current_zip</td>
             
         </tr>
         <tr>
         <th>current police station:</th> 
         <td>$police_station_name - $police_station_pincode</td>


         
     </tr>

     <tr>
     <th>new address:</th> 
     <td>$new_address</td>
     
 </tr>
 <tr>
 <th>new state:</th> 
 <td>$new_state</td>
 
</tr>
<tr>
<th>new city:</th> 
<td>$new_city</td>

</tr>
<tr>
<th>new Zip:</th> 
<td>$new_zip</td>

</tr>

                         <th>Email Id:</th> 
                         <td>$email_id</td>
                     </tr>

                     
                     
                     
</table>

<div><br><br></div>

<a class='btn btn-primary' href='view_uploaded_files.php?address_id=$address_id' target='_blank'>View file</a>";
                
if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending_address_update.php?address_id=$address_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href=''>Rejected</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href=''>completed</a>
     ";}
         
 
                            echo"
            
                                        
                                      
                                   
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    ";


                }
            }
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
