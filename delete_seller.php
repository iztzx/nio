<?php
//sambungan ke pangkalan data
include("connection.php");

// Check if the 'idpenjual' parameter is provided
if (isset($_GET['idpenjual'])) {
    $idpenjual = $_GET['idpenjual'];

    // Delete the seller from the database
    $query = "DELETE FROM penjual WHERE idpenjual = '$idpenjual'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>
            alert('Seller deleted successfully.');
            window.location.href = 'admin_home.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to delete the seller.');
            window.location.href = 'admin_home.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid request.');
        window.location.href = 'admin_home.php';
    </script>";
}
?>
