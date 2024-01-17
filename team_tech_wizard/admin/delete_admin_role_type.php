<?php
$showAlert=false;
$showError=false;
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
else{
    include 'dbconnect.php';


    $admin_role_type=$_GET['admin_role_type'];

   $delete_student="delete from admin_role  where admin_role_type='$admin_role_type'";


	  $sql3=mysqli_query($conn,$delete_student);
if($sql3)
	  { 
		  $showAlert=true;
      header('location:manage_admin_role.php');
		 
	  }
	  else
	  {
		  //$showError=true;
		 
	  }
}



?>