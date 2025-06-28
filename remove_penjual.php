<?php
include('connection.php');

// check if product_id is set in GET request
if (isset($_GET['id'])) {
    $idpenjual = $_GET['id'];

    $query = "DELETE FROM penjual WHERE idpenjual = ?";
    $statement = $con->prepare($query);
    $statement->bind_param("i", $idpenjual);
    $statement->execute();
    
    // redirect to product list page
    header("Location: home_edit_penjual.php");
    exit();
}
?>
