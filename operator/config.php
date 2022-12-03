<? 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
session_start();
$localhostx="localhost";
$rootx="root";
$passwordx="";
$db_namex="bible";

$conect = mysqli_connect($localhostx,$rootx,$passwordx,$db_namex) or die(mysqli_error()); 


 ?>