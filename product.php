<?php
include("product_header.php");

if (isset($_GET["scrollTo"])) {
  $scrollTo = $_GET["scrollTo"];
} else {
  $scrollTo = "";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Products</title>
  <meta charset="UTF-8">
</head>
<body>
  <div class="main-content">
    <center>
      <h1 style="margin-top: -25px;">All Products</h1>
    </center>

    <div class="product-container">
      <?php
      include("search.php");
      ?>

      <?php
      if ($scrollTo) {
        echo "<script>
        function setProductHash() {
          window.location.hash = 'product-" . $scrollTo . "';
        }
        
        window.addEventListener('load', setProductHash);
        </script>";
      }
      ?>
    </div>
  </div>
</body>
</html>
