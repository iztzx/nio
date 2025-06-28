<?php
// Connection to the database
include("connection.php");
session_start();

if (!isset($_SESSION["status"]) || $_SESSION["status"] !== "admin") {
    echo "<script>
        alert('Please sign in as an admin.');
        window.location.href = 'menu.php';
    </script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted form data
    $idadmin = mysqli_real_escape_string($con, $_POST['idadmin']);
    $namaadmin = mysqli_real_escape_string($con, $_POST['namaadmin']);
    $katalaluan = mysqli_real_escape_string($con, $_POST['katalaluan']);

    // Update the admin information in the database
    $sql = "UPDATE admin SET namaadmin='$namaadmin', katalaluan='$katalaluan' WHERE idadmin='$idadmin'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Redirect to the admin details page with a success message
        echo "<script>alert('Admin updated successfully!');
        window.location.href = 'account.php';</script>";
    } else {
        // Redirect to the admin details page with an error message
        echo "<script>alert('Admin update failed!');
        window.location.href = 'account.php';</script>";
    }
}
?>
