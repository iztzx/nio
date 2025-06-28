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

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // retrieve the submitted form data
  $idproduk = mysqli_real_escape_string($con, $_POST['idproduk']);
  $namaproduk = mysqli_real_escape_string($con, $_POST['namaproduk']);
  $keterangan = mysqli_real_escape_string($con, $_POST['keterangan']);
  $category = mysqli_real_escape_string($con, $_POST['category']);
  $harga = mysqli_real_escape_string($con, $_POST['harga']);

  // handle the image file upload
  $gambar = null;
  if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
    $uploaddir = "product-img/";
    $nama_file = $_FILES['gambar']['name'];
    $path_parts = pathinfo($nama_file);
    $extension = $path_parts['extension'];
    $nama_file_baru = $nama_file;
    $i = 1;

    while (file_exists($uploaddir . $nama_file_baru)) {
        $nama_file_baru = $path_parts['filename'] . '-' . $i . '.' . $extension;
        $i++;
    }

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploaddir . $nama_file_baru)) {
        $gambar = $nama_file_baru;
    } else {
        echo "<script>alert('Error uploading image file.');</script>";
    }
  }

  // update the product information in the database
  $sql = "UPDATE produk SET namaproduk='$namaproduk', keterangan='$keterangan', category='$category', harga='$harga'";
  if ($gambar) {
    $sql .= ", gambar='$gambar'";
  }
  $sql .= " WHERE idproduk='$idproduk' AND idpenjual='".$_SESSION['nokp']."'";
  $result = mysqli_query($con, $sql);

  if ($result) {
    // redirect to the product details page with a success message
    echo "<script>alert('Product updated successfully!');</script>";
    header("Location: home_edit_product.php?scrollTo=" . $idproduk);
  } else {
    // redirect to the product details page with an error message
    header("Location: home_edit_product.php?scrollTo=" . $idproduk);
  }
  
}
?>
