<?php
//sambungan ke pangkalan data
include("connection.php");
session_start();
if (empty($_SESSION['status']) || $_SESSION['status'] == 'pembeli') {
    echo "<script>
        alert('Please sign in as a seller or admin.');
        window.location.href = 'menu.php';
    </script>";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Seller</title>
  <link rel="stylesheet" href="product.css">
  <link rel="stylesheet" href="penjual.css">
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
</head>
<header class="nio-header">
<?php
//sambungan ke pangkalan data
include("connection.php");
if(isset($_SESSION['status']) && $_SESSION['status'] == "admin"){
  echo '<a href="admin_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} elseif(isset($_SESSION['status']) && $_SESSION['status'] == "penjual"){
  echo '<a href="penjual_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} else{
  echo '<a href="menu.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
}
?>
  <nav class="nio-nav">
    <?php 
        if ($_SESSION["status"] == "admin") {
          echo'<li><a href="home_edit_penjual.php">Edit Sellers</a></li>';
        }else
      ?>
      <li><a href="home_edit_product.php">Edit Products</a></li>
      <li><a href="support.php">Support</a></li>
      <li><a href="profile.php">Attributions</a></li>
      <body>
      <?php
if (isset($_SESSION["status"]) && ($_SESSION["status"] == "pembeli" || $_SESSION["status"] == "penjual" || $_SESSION["status"] == "admin")) {
} else {
    echo '<a href="home.php" class="btn signup-btn">Sign Up</a>  <a href="index.php" class="btn login-btn">Login</a>';
}
?>
      </body>
    </ul>
  </nav>
</header>

<?php
// check if the seller id is set
if(isset($_GET['id'])) {
    // get the seller id from the URL parameter
    $idpenjual = mysqli_real_escape_string($con, $_GET['id']);
    
    // retrieve the seller information from the database
    $sql = "SELECT * FROM penjual WHERE idpenjual = $idpenjual";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Seller</title>
</head>
<body>
    <div class="main-content">
        <center>
          <h1>Edit Seller</h1>
        </center>
      
    <div class="product-container">
        <form method="POST" action="update_penjual.php">
            <label for="namapenjual">Seller ID</label>
            <input type="text" name="idpenjual" value="<?php echo $row['idpenjual']; ?>" required readonly title="This field is not editable">
            
            <label for="namapenjual">Seller Name</label>
            <input type="text" name="namapenjual" value="<?php echo $row['namapenjual']; ?>" required>
            
            <label for="katalaluan">Password</label>
            <input type="password" name="katalaluan" value="<?php echo $row['katalaluan']; ?>" maxlength="8" required onmouseover="this.type='text'" onmouseout="this.type='password'">
            
            <button type="submit" name="submit">Save Changes</button>
            <button type="clear" name="cancel">Cancel</button>
        </form>
    </div>
</body>
</html>a

<?php

} else {
    echo "Seller ID is not set.";
}

mysqli_close($con);
?>
