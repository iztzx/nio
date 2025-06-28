<?PHP
include ('header.php');
// get data yang nak padam
$idpenjual=$_GET['idpenjual'];
//include fail connection
include ('connection.php');
if(mysqli_query($con,"delete from penjual where idpenjual='".$idpenjual."'"))
{
    echo "<script>
    alert('REKOD TELAH DIPADAM');
    window.location.href='senaraipenjual.php'
    </script>";
}
else
{
    echo "<script>
    alert('REKOD GAGAL DIPADAM');
    window.history.back();
    </script>";
}





?> 