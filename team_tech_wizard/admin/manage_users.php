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
							<form action="manage_users.php" method="POST">
							
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



if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    $email_id = $_POST["email_id"];
 
    $select_display="select  * from users INNER JOIN profile ON users.email_id=profile.email_id where users.email_id='$email_id' " ;
                   $sql1 = mysqli_query($conn,$select_display);
                   while($row=mysqli_fetch_assoc($sql1)){

                    $user_id=$row['user_id'];
                    $full_name=$row['full_name'];
                    $email_id=$row['email_id'];
                    $gender=$row['gender'];
                    $disabled_account=$row['disabled_account'];
                    
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
                                        <th>User Id:</th> 
                                        <td>$user_id</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>full name:</th> 
                                        <td>$full_name</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Email Id:</th> 
                                        <td>$email_id</td>
                                    </tr>

                                    
                                    
                                    
        </table>
        
        <div><br><br></div>
       
        <a class='btn btn-primary' href='view_users.php?user_id=$user_id'>View</a>
        ";

      

        if($disabled_account=='0'){
            echo" <a class='btn btn-danger' href='disabled_users.php?user_id=$user_id'>disabled account</a>";
            
        }
                            else{
                                echo "
                                <a class='btn btn-success' href='enabled_users.php?user_id=$user_id'>Enabled account</a>";
                            }
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
    if ($admin_role_type=='admin'){

        $select_display = "SELECT * FROM users ORDER BY users.user_id";
$sql1 = mysqli_query($conn,$select_display);
        while($row=mysqli_fetch_assoc($sql1)){

         $user_id=$row['user_id'];
         $full_name=$row['full_name'];
         $email_id=$row['email_id'];
         $disabled_account=$row['disabled_account'];
         $gender=$row['gender'];
         $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';

          
             echo "
             <div class='col-lg-4'>
         
             <div class='card'style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
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
                         <th>email_id:</th> 
                         <td>$email_id</td>
                     </tr>

                    
                     </table>

                     <div><br><br></div>
<a class='btn btn-primary' href='view_users.php?user_id=$user_id'>View</a>
";



if($disabled_account=='0'){
 echo" <a class='btn btn-danger' href='disabled_users.php?user_id=$user_id'>disabled account</a>";
 
}
                 else{
                     echo "
                     <a class='btn btn-success' href='enabled_users.php?user_id=$user_id'>Enabled account</a>";
                 }
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
         
    $select_display="SELECT users.user_id, users.full_name, users.email_id, profile.gender, users.disabled_account, users.police_station
    FROM profile
    INNER JOIN users ON users.email_id = profile.email_id
    INNER JOIN admin ON users.police_station = admin.police_station
    WHERE admin.admin_role_type = 'station-admin'
    ORDER BY users.user_id;
    ";
                   $sql1 = mysqli_query($conn,$select_display);
                   while($row=mysqli_fetch_assoc($sql1)){

                    $user_id=$row['user_id'];
                    $full_name_users=$row['full_name'];
                    $email_id_users=$row['email_id'];
                    $disabled_account=$row['disabled_account'];
                    $gender=$row['gender'];
                    $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';

                     
                        echo "
                        <div class='col-lg-4'>
                    
                        <div class='card'style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
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
                                    <td>$full_name_users</td>
                                    
                                </tr>
                                <tr>
                                    <th>email_id:</th> 
                                    <td>$email_id_users</td>
                                </tr>

                               
                                </table>

                                <div><br><br></div>
        <a class='btn btn-primary' href='view_users.php?user_id=$user_id'>View</a>
        ";

      

        if($disabled_account=='0'){
            echo" <a class='btn btn-danger' href='disabled_users.php?user_id=$user_id'>disabled account</a>";
            
        }
                            else{
                                echo "
                                <a class='btn btn-success' href='enabled_users.php?user_id=$user_id'>Enabled account</a>";
                            }
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
