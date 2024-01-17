<?php
$server = "localhost";
$username = "smilesnheal";
$password = "smilewellnessfoundation";
$database = "smilewellnessfoundation";
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}

?>