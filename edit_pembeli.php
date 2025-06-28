<?php
session_start();
//sambungan ke pangkalan data
include("connection.php");
if (empty($_SESSION['status']) || $_SESSION['status'] !== 'pembeli') {
    echo "<script>
        alert('Please sign in as a buyer.');
        window.location.href = 'menu.php';
    </script>";
    exit;
}

if(isset($_SESSION['nokp'])) {
    $nokp = $_SESSION['nokp'];
}else {
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buyer</title>
    <link rel="stylesheet" href="nio.css">
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="penjual.css">
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<body>
<header class="nio-header">
    <a href="pembeli_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>
    <center>
        <body class="greet"><a href="account.php">Hi, <?php echo $_SESSION["nama"]; ?></a></greet>
    </center>
    <nav class="nio-nav">
        <ul>
        <li><a href="product.php">Products</a></li>
            <li class="dropdown">
                <a class="dropbtn">Categories</a>
                <div class="dropdown-content">
                    <a href="mobile.php">Mobile</a>
                    <a href="audio.php">Audio</a>
                    <a href="c&l.php">Computers & Laptops</a>
                    <a href="tv&m.php">TV & Monitors</a>
                    <a href="ha.php">Home Appliances</a>
                    <a href="accesories.php">Accessories</a>
                </div>
            </li>
            <li><a href="support.php">Support</a></li>
            <li><a href="profile.php">Attributions</a></li>
            <li><a href="cart.php">Comparison</a></li>
        </ul>
    </nav>
</header>

<?php
    $sql = "SELECT * FROM pembeli WHERE nokp = $nokp";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembeli</title>
</head>
<body>
    <div class="main-content">
        <center>
            <h1>Edit Buyer</h1>
        </center>
      
    <div class="product-container">
        <form method="POST" action="update_pembeli.php">
            <label for="nokp">No KP</label>
            <input type="text" name="nokp" value="<?php echo $row['nokp']; ?>" required readonly title="This field is not editable">
            
            <label for="namapembeli">Pembeli Name</label>
            <input type="text" name="namapembeli" value="<?php echo $row['namapembeli']; ?>" required>
            
            <label for="emelpembeli">Email</label>
            <input type="email" name="emelpembeli" value="<?php echo $row['emelpembeli']; ?>" required>
            
            <label for="katalaluan">Password</label>
            <input type="password" name="katalaluan" value="<?php echo $row['katalaluan']; ?>" maxlength="8" required onmouseover="this.type='text'" onmouseout="this.type='password'">
            
            <button type="submit" name="submit">Save Changes</button>
            <button type="clear" name="cancel">Cancel</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
