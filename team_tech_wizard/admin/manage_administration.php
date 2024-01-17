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
 $police_station=$row1[5];

 
 }

 
 }
 

?>


	

<!DOCTYPE html>
<html lang="en">
<title>manage administration</title>
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
					<div class="card"  style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					    -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );" >
					
						
						
						<div class="card-body">
							<form action="manage_administration.php" method="POST">
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Search admin</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control"  name="email_id" id="email_id" placeholder="search by email" required>
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
                
					<!--card form-->
                    <?php

if ($admin_role_type=='admin'){

					
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  $email_id2 = $_POST["email_id"];

  $select_display="select  * from admin where email_id='$email_id2' and admin_role_type!='admin' " ;
                 $sql1 = mysqli_query($conn,$select_display);
                 $num1 = mysqli_num_rows($sql1);
                 if($num1>0){
                 while($row=mysqli_fetch_assoc($sql1)){

                  $admin_id=$row['admin_id'];
                  $full_name=$row['full_name'];
                  $email_id=$row['email_id'];
                  $gender=$row['gender'];
                  $admin_role_type=$row['admin_role_type'];
                  $disabled_account=$row['disabled_account'];
                  
                  $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';

                 
                                                                    
 

echo "
<div class='col-lg-6'>

<div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
<div class='card-body'>
  <div class='d-flex flex-column align-items-center text-center'>
      <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
      <div class='mt-3'>
      <table>
                                  <tr>
                                      <th>User Id:</th> 
                                      <td>$admin_id</td>
                                      
                                  </tr>

                                  <tr>
                                      <th>Admin role type: </th> 
                                      <td>$admin_role_type</td>
                                      
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
      <a class='btn btn-primary' href='update_administration.php?admin_id=$admin_id'>update admin Details</a>";
      

    

      if($disabled_account=='0'){
          echo" <a class='btn btn-danger' href='disabled_admin.php?admin_id=$admin_id'>disabled account</a>";
          
      }
                          else{
                              echo "
                              <a class='btn btn-success' href='enabled_admin.php?admin_id=$admin_id'>Enabled account</a>";
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
 echo "<p style='color:red;'> no user found please check email!!";
}

}
else{
		?>				
						
</div>	
					
					
				



        <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>station-admin</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php

$select_display="select  * from admin where admin_role_type='station-admin' order by disabled_account " ;
$sql1 = mysqli_query($conn,$select_display);
while($row=mysqli_fetch_assoc($sql1)){

 $admin_id=$row['admin_id'];
 $full_name=$row['full_name'];
 $email_id=$row['email_id'];
 $disabled_account=$row['disabled_account'];
 $gender=$row['gender'];
 $admin_role_type=$row['admin_role_type'];

 $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';

  
     echo "
     <div class='col-lg-6'>
 
     <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
         <div class='card-body'>
         <div class='d-flex flex-column align-items-center text-center'>
         <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

                 <div class='mt-3'>
                 <table>
                 <tr>
                 <th>User Id:</th> 
                 <td>$admin_id</td>
                 
             </tr>

             <tr>
             <th>Admin role type: </th> 
             <td>$admin_role_type</td>
             
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
             <a class='btn btn-primary' href='update_administration.php?admin_id=$admin_id'>update admin Details</a>

";



if($disabled_account=='0'){
echo" <a class='btn btn-danger' href='disabled_admin.php?admin_id=$admin_id'>disabled account</a>";

}
         else{
             echo "
             <a class='btn btn-success' href='enabled_admin.php?admin_id=$admin_id'>Enabled account</a>";
         }
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
            
            



        <!-- okie -->



        
			<div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Moderator</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
$select_display="select  * from admin where admin_role_type='moderator' order by disabled_account " ;
$sql1 = mysqli_query($conn,$select_display);
  while($row=mysqli_fetch_assoc($sql1)){

   $admin_id=$row['admin_id'];
   $full_name=$row['full_name'];
   $email_id=$row['email_id'];
   $disabled_account=$row['disabled_account'];
   $gender=$row['gender'];
   $admin_role_type=$row['admin_role_type'];

   $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';

    
       echo "
       <div class='col-lg-6'>
   
       <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
           <div class='card-body'>
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

                   <div class='mt-3'>
                   <table>
                   <tr>
                   <th>User Id:</th> 
                   <td>$admin_id</td>
                   
               </tr>

               <tr>
               <th>Admin role type: </th> 
               <td>$admin_role_type</td>
               
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
               <a class='btn btn-primary' href='update_administration.php?admin_id=$admin_id'>update admin Details</a>

";



if($disabled_account=='0'){
echo" <a class='btn btn-danger' href='disabled_admin.php?admin_id=$admin_id'>disabled account</a>";

}
           else{
               echo "
               <a class='btn btn-success' href='enabled_admin.php?admin_id=$admin_id'>Enabled account</a>";
           }
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
            
            <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Feedback</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
$select_display="select  * from admin where admin_role_type='feedback' order by disabled_account " ;
$sql1 = mysqli_query($conn,$select_display);
  while($row=mysqli_fetch_assoc($sql1)){

   $admin_id=$row['admin_id'];
   $full_name=$row['full_name'];
   $email_id=$row['email_id'];
   $disabled_account=$row['disabled_account'];
   $gender=$row['gender'];
   $admin_role_type=$row['admin_role_type'];

   $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';

    
       echo "
       <div class='col-lg-6'>
   
       <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
           <div class='card-body'>
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

                   <div class='mt-3'>
                   <table>
                   <tr>
                   <th>User Id:</th> 
                   <td>$admin_id</td>
                   
               </tr>

               <tr>
               <th>Admin role type: </th> 
               <td>$admin_role_type</td>
               
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
               <a class='btn btn-primary' href='update_administration.php?admin_id=$admin_id'>update admin Details</a>

";



if($disabled_account=='0'){
echo" <a class='btn btn-danger' href='disabled_admin.php?admin_id=$admin_id'>disabled account</a>";

}
           else{
               echo "
               <a class='btn btn-success' href='enabled_admin.php?admin_id=$admin_id'>Enabled account</a>";
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
else{




    if($_SERVER["REQUEST_METHOD"] == "POST"){
  
        $email_id2 = $_POST["email_id"];
      
        $select_display="select  * from admin where email_id='$email_id2' and police_station='$police_station' and admin_role_type!='admin' and admin_role_type!='station-admin'" ;
                       $sql1 = mysqli_query($conn,$select_display);
                       $num1 = mysqli_num_rows($sql1);
                       if($num1>0){
                       while($row=mysqli_fetch_assoc($sql1)){
      
                        $admin_id=$row['admin_id'];
                        $full_name=$row['full_name'];
                        $email_id=$row['email_id'];
                        $gender=$row['gender'];
                        $admin_role_type=$row['admin_role_type'];
                        $disabled_account=$row['disabled_account'];
                        
                        $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
      
                       
                                                                          
       
      
      echo "
      <div class='col-lg-6'>
      
      <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
      <div class='card-body'>
        <div class='d-flex flex-column align-items-center text-center'>
            <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
            <div class='mt-3'>
            <table>
                                        <tr>
                                            <th>User Id:</th> 
                                            <td>$admin_id</td>
                                            
                                        </tr>
      
                                        <tr>
                                            <th>Admin role type: </th> 
                                            <td>$admin_role_type</td>
                                            
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
            <a class='btn btn-primary' href='update_administration.php?admin_id=$admin_id'>update admin Details</a>";
            
      
          
      
            if($disabled_account=='0'){
                echo" <a class='btn btn-danger' href='disabled_admin.php?admin_id=$admin_id'>disabled account</a>";
                
            }
                                else{
                                    echo "
                                    <a class='btn btn-success' href='enabled_admin.php?admin_id=$admin_id'>Enabled account</a>";
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
       echo "<p style='color:red;'> no user found please check email!!";
      }
      
      }
      else{
              ?>				
                              
      </div>	
                          
                          
                      
      
  
                  
                  
      
      
      
              <!-- okie -->
      
      
      
              
                  <div class="row">
                      
                      <!--card form-->
                      
                          
                          
                          
                              <p style="color:red;"><b> Moderator</b></p>
                      </div>
                      
                  
      
              <div class='row'>
                  <!--fetch product-->
                  <?php
      $select_display="select  * from admin where admin_role_type='moderator' and police_station='$police_station' order by disabled_account " ;
      $sql1 = mysqli_query($conn,$select_display);
        while($row=mysqli_fetch_assoc($sql1)){
      
         $admin_id=$row['admin_id'];
         $full_name=$row['full_name'];
         $email_id=$row['email_id'];
         $disabled_account=$row['disabled_account'];
         $gender=$row['gender'];
         $admin_role_type=$row['admin_role_type'];
      
         $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
      
          
             echo "
             <div class='col-lg-6'>
         
             <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
                 <div class='card-body'>
                 <div class='d-flex flex-column align-items-center text-center'>
                 <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
      
                         <div class='mt-3'>
                         <table>
                         <tr>
                         <th>User Id:</th> 
                         <td>$admin_id</td>
                         
                     </tr>
      
                     <tr>
                     <th>Admin role type: </th> 
                     <td>$admin_role_type</td>
                     
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
                     <a class='btn btn-primary' href='update_administration.php?admin_id=$admin_id'>update admin Details</a>
      
      ";
      
      
      
      if($disabled_account=='0'){
      echo" <a class='btn btn-danger' href='disabled_admin.php?admin_id=$admin_id'>disabled account</a>";
      
      }
                 else{
                     echo "
                     <a class='btn btn-success' href='enabled_admin.php?admin_id=$admin_id'>Enabled account</a>";
                 }
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
                  
                  <div class="row">
                      
                      <!--card form-->
                      
                          
                          
                          
                              <p style="color:red;"><b> Feedback</b></p>
                      </div>
                      
                  
      
              <div class='row'>
                  <!--fetch product-->
                  <?php
      $select_display="select  * from admin where admin_role_type='feedback' and  police_station='$police_station' order by disabled_account " ;
      $sql1 = mysqli_query($conn,$select_display);
        while($row=mysqli_fetch_assoc($sql1)){
      
         $admin_id=$row['admin_id'];
         $full_name=$row['full_name'];
         $email_id=$row['email_id'];
         $disabled_account=$row['disabled_account'];
         $gender=$row['gender'];
         $admin_role_type=$row['admin_role_type'];
      
         $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
      
          
             echo "
             <div class='col-lg-6'>
         
             <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
                 <div class='card-body'>
                 <div class='d-flex flex-column align-items-center text-center'>
                 <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
      
                         <div class='mt-3'>
                         <table>
                         <tr>
                         <th>User Id:</th> 
                         <td>$admin_id</td>
                         
                     </tr>
      
                     <tr>
                     <th>Admin role type: </th> 
                     <td>$admin_role_type</td>
                     
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
                     <a class='btn btn-primary' href='update_administration.php?admin_id=$admin_id'>update admin Details</a>
      
      ";
      
      
      
      if($disabled_account=='0'){
      echo" <a class='btn btn-danger' href='disabled_admin.php?admin_id=$admin_id'>disabled account</a>";
      
      }
                 else{
                     echo "
                     <a class='btn btn-success' href='enabled_admin.php?admin_id=$admin_id'>Enabled account</a>";
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
    <!-- </div> -->










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