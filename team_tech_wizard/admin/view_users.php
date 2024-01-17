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
 $user_id=$_GET['user_id'];


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
    $select_display="select * from users INNER JOIN profile ON users.email_id=profile.email_id where users.user_id='$user_id'" ;
    $sql1 = mysqli_query($conn,$select_display);
                                               while($row=mysqli_fetch_assoc($sql1)){
                                                $user_id=$row['user_id'];
                                                $full_name=$row['full_name'];
                                                $email_id=$row['email_id'];
                                                $Mno=$row['Mno'];
                                                $age=$row['age'];
                                                $parrent_email_id=$row['parrent_email_id'];
                                                $aadhar_card=$row['aadhar_card'];
                                                $police_station=$row['police_station'];
                                                $gender=$row['gender'];
                                                $disabled_account=$row['disabled_account'];
                                                $address=$row['address'];
                                                $state=$row['state'];
                                                $city=$row['city'];
                                                $zip=$row['zip'];
                                                
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
                                               
                                             
            
                               
                               
                
                        
                        echo "<div class='col-lg-6'>
                    
                        <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
                            <div class='card-body'>
                                <div class='d-flex flex-column align-items-center text-center'>
                                    <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                                    <div class='mt-3'>
                                    <table>
                                    <tr>
                                    <th>User Id:</th> 
                                    <td>$user_id</td>
                                    
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
                                    <th>Mno:</th> 
                                    <td>$Mno</td>
                                    
                                </tr>

                                <tr>
                                    <th>age:</th> 
                                    <td>$age</td>
                                    
                                </tr>

                                <tr>
                                    <th>Address:</th> 
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
                            <th>zip:</th> 
                            <td>$zip</td>
                            
                        </tr>";

                        
                        if($parrent_email_id!='none@gmail.com'){
                            echo "
                            <tr>
                            <th>Parrent email Id:</th> 
                            <td>$parrent_email_id</td>
                            
                        </tr>";}
                        echo"

                            

                        <tr>
                            <th>aadhar card:</th> 
                            <td>$aadhar_card</td>
                            
                        </tr>

                        <tr>
                        <th>account created at</th> 
                        <td>$police_station_name $police_station_pincode</td>
                        
                    </tr>

                    <tr>
                        <th>Police email Id</th> 
                        <td>$police_station</td>
                        
                    </tr>

                            
                                    
                                </table>
                                <a class='btn btn-primary' href='welcome.php'>back</a>

            
                                        
                                      
                                        
                                        
                                  
                                        
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