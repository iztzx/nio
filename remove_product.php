<?php
include('connection.php');

// check if product_id is set in GET request
if (isset($_GET['id'])) {
    $idproduk = $_GET['id'];

    $query = "DELETE FROM produk WHERE idproduk = ?";
    $statement = $con->prepare($query);
    $statement->bind_param("i", $idproduk);
    $statement->execute();
    
    // redirect to product list page
    header("Location: home_edit_product.php");
    exit();
}
?>
