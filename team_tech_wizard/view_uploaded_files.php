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
 $address_id=$_GET['address_id'];

 $select_display="select * from change_address where address_id='$address_id'" ;
 $sql1 = mysqli_query($conn,$select_display);
                                            while($row=mysqli_fetch_assoc($sql1)){
                                             $file_upload=$row['file_upload'];
                                            
                                             
                                           
                                                    
                            

 
 
 


// Replace 'path/to/your/file.pdf' with the actual path to your PDF file.
$pdfFilePath = "$file_upload";

// Check if the file exists
if (file_exists($pdfFilePath)) {
    // Set the content type to PDF
    header('Content-Type: application/pdf');

    // Set additional headers for opening in a new tab
    header('Content-Disposition: inline; filename="<?php echo $file_upload?>"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($pdfFilePath));

    // Output the PDF file content
    readfile($pdfFilePath);
} 
else {
    // File not found, handle accordingly (e.g., show an error message)
    echo "File not found";
}
 }
 }
?>
