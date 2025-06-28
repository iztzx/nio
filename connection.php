<?PHP
// file hubungan
// host name= local host  
// sql username = root
// nama database= nio
$host='localhost';
$username='root';
$password='';
$database='nio';
$con=mysqli_connect($host,$username,$password,$database);
if(!$con){
    die ("connection failed:".mysqli_connect_error());
}
mysqli_set_charset($con,"utf8mb4");
?>
