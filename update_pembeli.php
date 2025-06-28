<?php
//sambungan ke pangkalan data
include("connection.php");
session_start();

if (!isset($_SESSION["status"]) || $_SESSION["status"] !== "pembeli") {
    echo "<script>
        alert('Please sign in as a buyer.');
        window.location.href = 'menu.php';
    </script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve the submitted form data
    $nokp = mysqli_real_escape_string($con, $_POST['nokp']);
    $emelpembeli = mysqli_real_escape_string($con, $_POST['emelpembeli']);
    $namapembeli = mysqli_real_escape_string($con, $_POST['namapembeli']);
    $katalaluan = mysqli_real_escape_string($con, $_POST['katalaluan']);

    // update the seller information in the database
    $sql = "UPDATE pembeli SET emelpembeli='$emelpembeli', namapembeli='$namapembeli', katalaluan='$katalaluan' WHERE nokp='$nokp'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // redirect to the seller details page with a success message
        echo "<script>alert('Buyer updated successfully!');
            window.location.href = 'account.php';</script>";
    } else {
        // redirect to the seller details page with an error message
        echo "<script>alert('Buyer updated failed!');
        window.location.href = 'account.php';</script>";
    }
}
?>  
