<?php
include("connection.php");
session_start();
if (empty($_SESSION['status']) || $_SESSION['status'] !== 'penjual') {
    echo "<script>
        alert('Please sign in as a seller.');
        window.location.href = 'menu.php';
    </script>";
    exit;
}

?>
<!DOCTYPE html>

<html>
  <link rel="stylesheet" href="product.css">
  <link rel="stylesheet" href="penjual.css">
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
<header class="nio-header">
<?php
include("connection.php");
if(isset($_SESSION['status']) && $_SESSION['status'] == "pembeli"){
  echo '<a href="pembeli_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} elseif(isset($_SESSION['status']) && $_SESSION['status'] == "penjual"){
  echo '<a href="penjual_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} else{
  echo '<a href="menu.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
}
?>

  <nav class="nio-nav">
    <ul>
      <li><a href="product.php">Products</a></li>
      <div class="dropdown">
        <button class="dropbtn">Categories</button>
          <div class="dropdown-content">
            <a href="mobile.php">Mobile</a>
            <a href="audio.php">Audio</a>
            <a href="c&l.php">Computers & Laptops</a>
            <a href="tv&m.php">TV & Monitors</a>
            <a href="ha.php">Home Appliances</a>
            <a href="accessories.php">Accessories</a>
          </div>
      </div>
      <li><a href="support.php">Support</a></li>
      <li><a href="profile.php">Attributions</a></li>
      <body>
      <?php
if (isset($_SESSION["status"]) && ($_SESSION["status"] == "pembeli" || $_SESSION["status"] == "penjual")) {
    // do nothing
} else {
    echo '<a href="home.php" class="btn signup-btn">Sign Up</a>  <a href="index.php" class="btn login-btn">Login</a>';
}
?>

      </body>
    </ul>
  </nav>
</header>

<?php
// check if the product id is set
if(isset($_GET['id'])) {
    // get the product id from the URL parameter
    $idproduk = mysqli_real_escape_string($con, $_GET['id']);
    
    // retrieve the product information from the database
    $sql = "SELECT * FROM produk WHERE idproduk = $idproduk";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // check if the current user is the seller of the product
    if($row['idpenjual'] == $_SESSION['nokp']) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
</head>
<body>
	<div class="main-content">
	    <center>
	      <h1>Edit Product</h1>
	    </center>
      
    <div class="product-container">
        <form method="POST" action="update_product.php" enctype="multipart/form-data">
            <input type="hidden" name="idproduk" value="<?php echo $row['idproduk']; ?>">
            <label for="namaproduk">Product Name</label>
            <input type="text" name="namaproduk" value="<?php echo $row['namaproduk']; ?>" required>
            
            <label for="keterangan">Product Description</label>
            <textarea name="keterangan" required><?php echo $row['keterangan']; ?></textarea>
            
            <label for="category">Product Category</label>
            <select name="category" required>
            <option value="">-- Select Category --</option>
            <option value="MOBILE" <?php if($row['category'] == 'MOBILE') { echo "selected"; } ?>>Mobile</option>
            <option value="AUDIO" <?php if($row['category'] == 'AUDIO') { echo "selected"; } ?>>Audio</option>
            <option value="COMPUTERS_LAPTOPS" <?php if($row['category'] == 'COMPUTERS_LAPTOPS') { echo "selected"; } ?>>Computers/Laptops</option>
            <option value="TV_MONITORS" <?php if($row['category'] == 'TV_MONITORS') { echo "selected"; } ?>>TV/Monitors</option>
            <option value="HOME_APPLIANCES" <?php if($row['category'] == 'HOME_APPLIANCES') { echo "selected"; } ?>>Home Appliances</option>
            <option value="ACCESSORIES" <?php if($row['category'] == 'ACCESSORIES') { echo "selected"; } ?>>Accessories</option>
            </select>
            
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" value="<?php echo $row['brand']; ?>" required>
            
            <label for="gambar">Product Image</label>
            <input type="file" id="gambar" name="gambar" onchange="previewImage()">
            <img class="preview-img" img id="preview" src="#" alt="Preview" style="display: none;">

            <label for="harga">Product Price</label>
            <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required>
            <button type="submit" name="submit">Save Changes</button>
        </form>
	</div>
</body>
</html>

<?php
    } else {
        echo "You are not authorized to edit this product.";
    }
} else {
    echo "Product ID is not set.";
}

mysqli_close($con);

// set product ID as session variable
$_SESSION['idproduk'] = $idproduk;

?>

<script>
    function previewImage() {
      var preview = document.getElementById("preview");
      var file = document.querySelector("input[type=file]").files[0];
      var reader = new FileReader();

      reader.addEventListener("load", function () {
        preview.src = reader.result;
        preview.style.display = "block";
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>
