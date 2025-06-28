<?php
//sambungan ke pangkalan data
include("connection.php");
session_start();

if (!isset($_SESSION["status"]) || $_SESSION["status"] == "pembeli") {
    echo "<script>
        alert('Please sign in as a seller or admin.');
        window.location.href = 'menu.php';
    </script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve the submitted form data
    $idpenjual = mysqli_real_escape_string($con, $_POST['idpenjual']);
    $namapenjual = mysqli_real_escape_string($con, $_POST['namapenjual']);
    $katalaluan = mysqli_real_escape_string($con, $_POST['katalaluan']);

    // update the seller information in the database
    $sql = "UPDATE penjual SET namapenjual='$namapenjual', katalaluan='$katalaluan' WHERE idpenjual='$idpenjual'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // redirect to the seller details page with a success message
        echo "<script>alert('Seller updated successfully!');
        window.location.href = 'home_edit_penjual.php?scrollTo=" . $idpenjual . "';</script>";
    } else {
        // redirect to the seller details page with an error message
        echo "<script>alert('Seller updated failed!');
        window.location.href = 'home_edit_penjual.php?scrollTo=" . $idpenjual . "';</script>";
    }    
}
?>
