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
 $email_id=$row1[3];
 $admin_role_type=$row1[2];
 
 }

 
 }
 

?>


	

<!DOCTYPE html>
<html lang="en">
<title>manage application request</title>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<body> 

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>
    <div class="container">
		<div class="main-body">
		    <style>
		    .switch-container {
    display: flex;
    align-items: center;
  }
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
		    <div class="switch-container">
  <label class="switch">
    <input type="checkbox" onclick="toggleView()">
    <span class="slider round"></span>
  </label>
  <span style="margin-left:1% !important;">Table View</span>
</div>
<?php
            if ($admin_role_type=='admin'){?>
		    
		      <!--<button onclick="toggleView()">Toggle View</button>-->
		      <div id="cardView" class="card-view">

            <!--list product-->	
            
        <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Pending Requests</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;







$select_display="select * from application_request where permission=2 order by complaint_date LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
while($row=mysqli_fetch_assoc($sql1)){
    
 
    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];
    

    
     
     echo "
     <div class='col-lg-4'>
 
     
     <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
         <div class='card-body'>
         <div class='d-flex flex-column align-items-center text-center'>
         <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

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
           <th>Complaint:</th> 
           <td>$description_complaint</td>
           
       </tr>
           <tr>
           <th>permission:</th> 
           <td>pending</td>
           
       </tr>

           </table>
           <div><br><br></div>
           <a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View Details</a>
";
                   
                  
if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
     ";}
             echo"   
                 
              
                   
               </div>
             </div>
             
         </div>
     </div>
 </div>
 ";


}}

else{
        echo "<b><div> No pending cases today</b></div>";
        
          

}


$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request WHERE permission=2";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
  }


    
        
            ?>
            </div>
            
            



        <!-- okie -->


<br>
        
			<div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Ongoing </b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php



$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;




$select_display="select * from application_request where permission=1 order by complaint_date LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
  while($row=mysqli_fetch_assoc($sql1)){
   
   
    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];

   
    
       echo "
       <div class='col-lg-4'>
   
       <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
           <div class='card-body'>
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

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
           <th>Complaint:</th> 
           <td>$description_complaint</td>
           
       </tr>
             <tr>
             <th>permission:</th> 
             <td>Ongoing</td>
             
         </tr>
             </table>
             <div><br><br></div>
             <a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View Details</a>
             ";
                                
                                       
if($permission=='0'){
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
     echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
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
    echo "<div><b> No ongoing cases today</b></div>";
    
      


  }

$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request WHERE permission = 1";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
echo "<li class='page-item'>";
echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
}
  


        
            ?>
            </div>
            
            <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Resolved</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php



$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;
$select_display="select * from application_request where permission=0 order by complaint_date LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
   

  while($row=mysqli_fetch_assoc($sql1)){
   

    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];
       echo "
       <div class='col-lg-4'>
   
       <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
           <div class='card-body'>
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

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
           <th>Complaint:</th> 
           <td>$description_complaint</td>
           
       </tr>
               <tr>
               <th>permission:</th> 
               <td>Resolved</td>
               
           </tr>
               </table>
               <div><br><br></div>
               <a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View Details</a>
               ";
                                  
                          if($permission=='0'){
                           echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
                        ";}
                        else if($permission=='1'){
                            echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
                         ";
                        }
                        else{
                            echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
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
    echo "<div><b> No completed cases today</b></div>";
    
      

}
  
$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request WHERE permission = 0";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
echo "<li class='page-item'>";
echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
}
            
            
        
            ?>
            </div>
            
        

    
      

</div>

  <div id="tableView" class="table-view">
      <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Pending Requests</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
           

                // Number of items per page
$itemsPerPage = 5;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;

$select_display="select * from application_request where permission=2  order by permission,complaint_date LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
            if($num>0){
                echo '<table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Complaint Id</th>
                <th scope="col">email id</th>
                <th scope="col">Incident Date</th>
                <th scope="col">Complaint Date</th>
                <th scope="col">Complaint Description</th>
                <th scope="col">Status</th>
                <th scope="col"> View complaint details</th>
                <th scope="col"> click to update</th>
            </tr>
        </thead>
        <tbody>';

            
            $counter=0;

while($row=mysqli_fetch_assoc($sql1)){
    $counter=++$counter;
 
    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];
    

    
     
     echo "
    
               <tr>
               
               <td>$complaint_id</td>
               <td>$email_id</td>
               <td>$incident_date</td>         
               <td>$complaint_date</td>       
               <td>$description_complaint</td>
               <td>pending</td>
               <td><a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View details</a>
               </td>
               <td>";
               if($permission=='2'){
                echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
             ";}
             else if($permission=='1'){
                 echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
              ";
             }
             else{
                echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
                 ";}
                 echo "
               </td>
           
       </tr>";
}
echo "</tbody>


           </table>";
}
else{
    echo "<div><b> No pending cases today</b></div>";
}
           
            



// Get the total number of rows in the table
$totalRowsQueryPending = "SELECT COUNT(*) as total FROM application_request WHERE permission = 2";
$totalRowsResultPending = mysqli_query($conn, $totalRowsQueryPending);
$totalRowsDataPending = mysqli_fetch_assoc($totalRowsResultPending);
$totalRowsPending = $totalRowsDataPending['total'];
$totalPages = ceil($totalRowsPending / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsPending / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";
  
             } 
             ?>
             
             
            
         
            
            



        <!-- okie -->


<br>
        
			<div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Ongoing </b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
                // Number of items per page
$itemsPerPage = 5;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;
$select_display="select * from application_request where permission=1 order by permission,complaint_date LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
    echo '<table class="table table-bordered">
<thead>
<tr>
    <th scope="col">Complaint Id</th>
    <th scope="col">email id</th>
    <th scope="col">Incident Date</th>
    <th scope="col">Complaint Date</th>
    <th scope="col">Complaint Description</th>
    <th scope="col">Status</th>
    <th scope="col"> View complaint details</th>
    <th scope="col"> click to update</th>
</tr>
</thead>
<tbody>';


$counter=0;

while($row=mysqli_fetch_assoc($sql1)){
$counter=++$counter;

$complaint_id=$row['complaint_id'];
$email_id=$row['email_id'];
$incident_date=$row['incident_date'];
$complaint_date=$row['complaint_date'];
$description_complaint= $row['description_complaint'];
$permission=$row['permission'];




echo "

   <tr>
   
   <td>$complaint_id</td>
   <td>$email_id</td>
   <td>$incident_date</td>         
   <td>$complaint_date</td>       
   <td>$description_complaint</td>
   <td>Ongoing</td>
   <td><a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View details</a>
   </td>
   <td>";
   if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
     ";}
     echo "
   </td>

</tr>";
}
echo "</tbody>


</table>";
}
else{
echo "<div><b> No Ongoing cases today</b><div>";
}
                          




$totalRowsQueryOngoing = "SELECT COUNT(*) as total FROM application_request WHERE permission = 1";
$totalRowsResultOngoing = mysqli_query($conn, $totalRowsQueryOngoing);
$totalRowsDataOngoing = mysqli_fetch_assoc($totalRowsResultOngoing);
$totalRowsOngoing = $totalRowsDataOngoing['total'];
$totalPages = ceil($totalRowsOngoing / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsOngoing  / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=ongoing'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";


             }
            
            
        
            ?>
            </div>
            
            <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Resolved</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
            
                // Number of items per page
$itemsPerPage = 5;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;

$select_display="select * from application_request where permission=0 order by permission,complaint_date LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
    echo '<table class="table table-bordered">
<thead>
<tr>
    <th scope="col">Complaint Id</th>
    <th scope="col">email id</th>
    <th scope="col">Incident Date</th>
    <th scope="col">Complaint Date</th>
    <th scope="col">Complaint Description</th>
    <th scope="col">Status</th>
    <th scope="col"> View complaint details</th>
    <th scope="col"> click to update</th>
</tr>
</thead>
<tbody>';


$counter=0;

while($row=mysqli_fetch_assoc($sql1)){
$counter=++$counter;

$complaint_id=$row['complaint_id'];
$email_id=$row['email_id'];
$incident_date=$row['incident_date'];
$complaint_date=$row['complaint_date'];
$description_complaint= $row['description_complaint'];
$permission=$row['permission'];




echo "

   <tr>
   
   <td>$complaint_id</td>
   <td>$email_id</td>
   <td>$incident_date</td>         
   <td>$complaint_date</td>       
   <td>$description_complaint</td>
   <td>Completed</td>
   <td><a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View details</a>
   </td>
   <td>";
   if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
     ";}
     echo "
   </td>

</tr>";
}
echo "</tbody>


</table>";
}
else{
echo "<div><b> No resolved cases today</b></div>";
}
                            



$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request WHERE permission = 0";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=completed'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
  }
}
else{?>
    

           
		    
		      <!--<button onclick="toggleView()">Toggle View</button>-->
		      <div id="cardView" class="card-view">

            <!--list product-->	
            
        <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Pending Requests</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;







$select_display="select * from application_request inner join admin on application_request.police_station=admin.police_station where permission=2 and admin.email_id='$email_id1'  order by permission,complaint_id" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
while($row=mysqli_fetch_assoc($sql1)){
    
 
    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];
    

    
     
     echo "
     <div class='col-lg-4'>
 
     
     <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
         <div class='card-body'>
         <div class='d-flex flex-column align-items-center text-center'>
         <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

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
           <th>Complaint:</th> 
           <td>$description_complaint</td>
           
       </tr>
           <tr>
           <th>permission:</th> 
           <td>pending</td>
           
       </tr>

           </table>
           <div><br><br></div>
           <a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View Details</a>
";
                   
                  
if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
     ";}
             echo"   
                 
              
                   
               </div>
             </div>
             
         </div>
     </div>
 </div>
 ";


}}

else{
        echo "<div><b> No pending cases today</b></div>";
        
          

}


$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request INNER JOIN admin on application_request.police_station=admin.police_station where permission=2 and admin.email_id='$email_id1'  order by complaint_id" ;

$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
  }


    
        
            ?>
            </div>
            
            



        <!-- okie -->


<br>
        
			<div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Ongoing </b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php



$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;




$select_display="select * from application_request inner join admin on application_request.police_station=admin.police_station where permission=1 and admin.email_id='$email_id1'  order by permission,complaint_id" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
  while($row=mysqli_fetch_assoc($sql1)){
   
   
    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];

   
    
       echo "
       <div class='col-lg-4'>
   
       <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
           <div class='card-body'>
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

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
           <th>Complaint:</th> 
           <td>$description_complaint</td>
           
       </tr>
             <tr>
             <th>permission:</th> 
             <td>Ongoing</td>
             
         </tr>
             </table>
             <div><br><br></div>
             <a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View Details</a>
             ";
                                
                                       
if($permission=='0'){
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
     echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
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
    echo "<div><b> No ongoing cases today</b></div>";
    
      


  }

$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request  inner join admin on application_request.police_station=admin.police_station where permission=1 and admin.email_id='$email_id1'  order by permission,complaint_id" ;
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
echo "<li class='page-item'>";
echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
}
  


        
            ?>
            </div>
            
            <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Resolved</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php



$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;
$select_display="select * from application_request inner join admin on application_request.police_station=admin.police_station where permission=0 and admin.email_id='$email_id1'  order by permission,complaint_id" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
   

  while($row=mysqli_fetch_assoc($sql1)){
   

    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];
       echo "
       <div class='col-lg-4'>
   
       <div class='card' style='box-shadow: 0 0 0px rgb(0 0 0) !important;'>
           <div class='card-body'>
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

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
           <th>Complaint:</th> 
           <td>$description_complaint</td>
           
       </tr>
               <tr>
               <th>permission:</th> 
               <td>Resolved</td>
               
           </tr>
               </table>
               <div><br><br></div>
               <a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View Details</a>
               ";
                                  
                          if($permission=='0'){
                           echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
                        ";}
                        else if($permission=='1'){
                            echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
                         ";
                        }
                        else{
                            echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
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
    echo "<div><b> No completed cases today</b></div>";
    
      

}
  
$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request inner join admin on application_request.police_station=admin.police_station where permission=0 and admin.email_id='$email_id1'  order by permission,complaint_id" ;

$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
echo "<li class='page-item'>";
echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
}
            
            
        
            ?>
            </div>
            
        

    
      

</div>

 <div id="tableView" class="table-view">
      <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Pending Requests</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
           

                // Number of items per page
$itemsPerPage = 5;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;

$select_display="select * from application_request inner join admin on application_request.police_station=admin.police_station where permission=2 and admin.email_id='$email_id1'  order by permission,complaint_date" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
            if($num>0){
                echo '<table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Complaint Id</th>
                <th scope="col">email id</th>
                <th scope="col">Incident Date</th>
                <th scope="col">Complaint Date</th>
                <th scope="col">Complaint Description</th>
                <th scope="col">Status</th>
                <th scope="col"> View complaint details</th>
                <th scope="col"> click to update</th>
            </tr>
        </thead>
        <tbody>';

            
            $counter=0;

while($row=mysqli_fetch_assoc($sql1)){
    $counter=++$counter;
 
    $complaint_id=$row['complaint_id'];
    $email_id=$row['email_id'];
    $incident_date=$row['incident_date'];
    $complaint_date=$row['complaint_date'];
    $description_complaint= $row['description_complaint'];
    $permission=$row['permission'];
    

    
     
     echo "
    
               <tr>
               
               <td>$complaint_id</td>
               <td>$email_id</td>
               <td>$incident_date</td>         
               <td>$complaint_date</td>       
               <td>$description_complaint</td>
               <td>pending</td>
               <td><a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View details</a>
               </td>
               <td>";
               if($permission=='2'){
                echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
             ";}
             else if($permission=='1'){
                 echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
              ";
             }
             else{
                echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
                 ";}
                 echo "
               </td>
           
       </tr>";
}
echo "</tbody>


           </table>";
}
else{
    echo "<div><b> No pending cases today</b></div>";
}
           
            



// Get the total number of rows in the table
$totalRowsQueryPending = "SELECT COUNT(*) as total FROM application_request inner join admin on application_request.police_station=admin.police_station where permission=2 and admin.email_id='$email_id1'  order by permission,complaint_date" ;

$totalRowsResultPending = mysqli_query($conn, $totalRowsQueryPending);
$totalRowsDataPending = mysqli_fetch_assoc($totalRowsResultPending);
$totalRowsPending = $totalRowsDataPending['total'];
$totalPages = ceil($totalRowsPending / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<br><nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsPending / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";
  
             } 
             ?>
             
             
            
         
            
            



        <!-- okie -->


<br>
        
			<div class="row"><br>
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Ongoing </b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
                // Number of items per page
$itemsPerPage = 5;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;
$select_display="select * from application_request inner join admin on application_request.police_station=admin.police_station where permission=1 and admin.email_id='$email_id1'  order by permission,complaint_date" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
    echo '<table class="table table-bordered">
<thead>
<tr>
    <th scope="col">Complaint Id</th>
    <th scope="col">email id</th>
    <th scope="col">Incident Date</th>
    <th scope="col">Complaint Date</th>
    <th scope="col">Complaint Description</th>
    <th scope="col">Status</th>
    <th scope="col"> View complaint details</th>
    <th scope="col"> click to update</th>
</tr>
</thead>
<tbody>';


$counter=0;

while($row=mysqli_fetch_assoc($sql1)){
$counter=++$counter;

$complaint_id=$row['complaint_id'];
$email_id=$row['email_id'];
$incident_date=$row['incident_date'];
$complaint_date=$row['complaint_date'];
$description_complaint= $row['description_complaint'];
$permission=$row['permission'];




echo "

   <tr>
   
   <td>$complaint_id</td>
   <td>$email_id</td>
   <td>$incident_date</td>         
   <td>$complaint_date</td>       
   <td>$description_complaint</td>
   <td>Ongoing</td>
   <td><a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View details</a>
   </td>
   <td>";
   if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
     ";}
     echo "
   </td>

</tr>";
}
echo "</tbody>


</table>";
}
else{
echo "<div><b> No Ongoing cases today</b><div>";
}
                          




$totalRowsQueryOngoing = "SELECT COUNT(*) as total FROM application_request  inner join admin on application_request.police_station=admin.police_station where permission=1 and admin.email_id='$email_id1'  order by permission,complaint_date" ;

$totalRowsResultOngoing = mysqli_query($conn, $totalRowsQueryOngoing);
$totalRowsDataOngoing = mysqli_fetch_assoc($totalRowsResultOngoing);
$totalRowsOngoing = $totalRowsDataOngoing['total'];
$totalPages = ceil($totalRowsOngoing / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsOngoing  / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=ongoing'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";


             }
            
            
        
            ?>
            </div>
            
            <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Resolved</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
            
                // Number of items per page
$itemsPerPage = 5;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;

$select_display="select * from application_request inner join admin on application_request.police_station=admin.police_station where permission=0 and admin.email_id='$email_id1'  order by permission,complaint_date" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
    echo '<table class="table table-bordered">
<thead>
<tr>
    <th scope="col">Complaint Id</th>
    <th scope="col">email id</th>
    <th scope="col">Incident Date</th>
    <th scope="col">Complaint Date</th>
    <th scope="col">Complaint Description</th>
    <th scope="col">Status</th>
    <th scope="col"> View complaint details</th>
    <th scope="col"> click to update</th>
</tr>
</thead>
<tbody>';


$counter=0;

while($row=mysqli_fetch_assoc($sql1)){
$counter=++$counter;

$complaint_id=$row['complaint_id'];
$email_id=$row['email_id'];
$incident_date=$row['incident_date'];
$complaint_date=$row['complaint_date'];
$description_complaint= $row['description_complaint'];
$permission=$row['permission'];




echo "

   <tr>
   
   <td>$complaint_id</td>
   <td>$email_id</td>
   <td>$incident_date</td>         
   <td>$complaint_date</td>       
   <td>$description_complaint</td>
   <td>Completed</td>
   <td><a class='btn btn-primary' href='view_services_details.php?complaint_id=$complaint_id'>View details</a>
   </td>
   <td>";
   if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending.php?complaint_id=$complaint_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?complaint_id=$complaint_id'>Ongoing</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href='resolved.php?complaint_id=$complaint_id'>Resolved</a>
     ";}
     echo "
   </td>

</tr>";
}
echo "</tbody>


</table>";
}
else{
echo "<b> <div>No resolved cases today</b></div>";
}
                            



$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request inner join admin on application_request.police_station=admin.police_station where permission=0 and admin.email_id='$email_id1'  order by permission,complaint_date";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=completed'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
  }
  echo "</div>";
}

// station-admin 



?>
            





            
            



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
  font-size:15px;
  
}
.me-2 {
    margin-right: .5rem!important;
}
</style>

<script>
    // Check if user has a preferred view stored
    var preferredView = localStorage.getItem('preferredView');
    if (preferredView === 'table') {
            //   showTableView();
            showCardView();
 
    } else {
//  showCardView();
 showTableView();
    }

    function toggleView() {
      if (document.getElementById('tableView').style.display === 'none') {
        showTableView();
      } else {
        showCardView();
      }
    }

    function showCardView() {
      document.getElementById('cardView').style.display = 'block';
      document.getElementById('tableView').style.display = 'none';
      localStorage.setItem('preferredView', 'card');
    }

    function showTableView() {
      document.getElementById('cardView').style.display = 'none';
      document.getElementById('tableView').style.display = 'block';
      localStorage.setItem('preferredView', 'table');
    }

    function submitData() {
      var inputData = document.getElementById('cardInput').value;
      console.log('Submitted data:', inputData);
      // Handle data submission logic here
    }
  </script>


   
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>