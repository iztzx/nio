<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="nio.css" />
    <link rel="stylesheet" href="search.css" />
    <link rel="stylesheet" href="account.css" />
    <link rel="stylesheet" href="product.css" />
  </head>
  <body>
    <header class="nio-header">
      <?php
      session_start();
      //sambungan ke pangkalan data
include("connection.php");
      if ($_SESSION["status"] == "pembeli") {
        echo '<a href="pembeli_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
      } elseif ($_SESSION["status"] == "penjual") {
        echo '<a href="penjual_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
      } elseif ($_SESSION["status"] == "admin") {
        echo '<a href="admin_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
      } else {
        echo '<a href="menu.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
      }
      ?>
      <div class="greet"><a href="account.php">Hi, <?php echo $_SESSION["nama"]; ?></a></div>
      <nav class="nio-nav">
        <ul>
        <?php if ($_SESSION["status"] == "admin"): ?>
        <li>
          <a href="home_edit_penjual.php">Edit Sellers</a>
        </li>
        <?php endif; ?>
        <li>
          <a href="<?php echo ($_SESSION["status"] == "pembeli") ? 'product.php' : 'home_edit_product.php'; ?>">
            <?php echo ($_SESSION["status"] == "pembeli") ? 'Products' : 'Edit Products'; ?>
          </a>
        </li>
        <div class="dropdown">
          <?php if ($_SESSION["status"] == "pembeli"): ?>
            <button class="dropbtn">Categories</button>
              <div class="dropdown-content">
              <a href="mobile.php">Mobile</a>
              <a href="audio.php">Audio</a>
              <a href="c&l.php">Computers & Laptops</a>
              <a href="tv&m.php">TV & Monitors</a>
              <a href="ha.php">Home Appliances</a>
              <a href="accesories.php">Accessories</a>
            </div>
          <?php endif; ?>
        </div>
        <div class="dropdown">
          <button class="dropbtn">Support</button>
          <div class="dropdown-content">
            <a href="support.php">Contact</a>
            <button id="toggleButton" class="colour-btn">Colour Change</button>
          </div>
        </div>
          <li><a href="profile.php">Attributions</a></li>
          <?php if ($_SESSION["status"] == "pembeli"): ?>
            <li><a href="cart.php">Comparison</a></li>
          <?php endif; ?>
          <li>
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="input-box">
                <input
                  type="text"
                  placeholder="Enter to search..."
                  id="searchInput"
                  name="search"
                />
                <span class="icon">
                  <i class="fa fa-search search-icon"></i>
                </span>
                <i class="fa fa-times close-icon"></i>
              </div>
            </form>
          </li>
        </ul>
      </nav>
    </header>

<script>
// Memeriksa jika pilihan pengguna disimpan dalam storan tempatan
  var isGrayscale = localStorage.getItem('grayscale') === 'true';

  // Aplikasikan grayscale berdasarkan pilihan pengguna
  if (isGrayscale) {
    document.documentElement.style.filter = 'grayscale(100%)';
  }

  // Sekiranya butang tukar warna ditekan
  document.getElementById('toggleButton').addEventListener('click', function() {
    // Tukar kepada pilihan grayscale
    isGrayscale = !isGrayscale;
    
    // Kemas kini storan tempatan dengan pilihan baru
    localStorage.setItem('grayscale', isGrayscale);
    
    // Aplikasikan atau buang penapis grayscale berdasarkan pilihan baru
    if (isGrayscale) {
      document.documentElement.style.filter = 'grayscale(100%)';
    } else {
      document.documentElement.style.filter = 'none';
    }
  });
  let inputBox = document.querySelector(".input-box");
  let searchIcon = document.querySelector(".search-icon");
  let closeIcon = document.querySelector(".close-icon");
  let searchInput = document.querySelector("#searchInput");

  searchIcon.addEventListener("click", () => {
    inputBox.classList.add("open");
    searchInput.focus();
  });

  closeIcon.addEventListener("click", () => {
    inputBox.classList.remove("open");
    searchInput.value = "";
  });

  searchInput.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      event.preventDefault();
      searchInput.form.submit();
    }
  });

  if (performance.navigation.type === 1) {
    let searchInput = document.querySelector("#searchInput");
    searchInput.value = "";
    let url = new URL(window.location.href);
    url.searchParams.delete('search');
    window.history.replaceState(null, null, url);
  }
</script>

<div class="product-container">
  <?php
    //sambungan ke pangkalan data
include("connection.php");
    if (isset($_GET['search'])) {
      $search = mysqli_real_escape_string($con, $_GET['search']);
      $sql = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%' ORDER BY category ASC";
    } else {
      $sql = "SELECT * FROM produk ORDER BY category ASC LIMIT 0";
    }
    $result = mysqli_query($con, $sql);
    if(!isset($_GET['search'])) {

    } elseif (isset($_GET['search']) && (mysqli_num_rows($result) == 0)) {
      echo "<br><center><font size=\"5\">There are no results for the search term '$search'</font></center>";
    } else {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product-card">';
        echo '  <img src="product-img/' . $row["gambar"] . '" alt="Product Image">';
        echo '  <h3>' . $row["namaproduk"] . '</h3>';
        echo '  <p>' . $row["keterangan"] . '</p>';
        echo '  <div class="price-add-to-cart">';
        echo '    <span class="price">RM' . $row["harga"] . '</span>';
        echo '    <form method="post" action="cart.php?action=add&id=' . $row["idproduk"] . '">';
        echo '      <input type="hidden" name="id" value="' . $row["idproduk"] . '">';
        echo '      <input type="hidden" name="quantity" value="1">';
        echo '      <button class="add-to-cart-btn" type="submit" style="font-family:\'Inter\'">Add to Comparison</button>';
        echo '    </form>';
        echo '  </div>';
        echo '</div>';
      }
    }
    mysqli_close($con);
  ?>
</div>

<head>
  <title>Account Page</title>
</head>

<div class="user-profile">
  <h2>User Profile</h2>
  <p>Name: <?php echo $_SESSION["nama"]; ?></p>
  <p>User ID: <?php echo $_SESSION["nokp"]; ?></p>
  <a href="logout.php">Logout</a>
  <?php if ($_SESSION["status"] === "pembeli"): ?>
  <a href="edit_pembeli.php?id=<?php echo $_SESSION["nokp"]; ?>" class="edit-button">Edit</a>
  <?php elseif ($_SESSION["status"] === "penjual"): ?>
  <a href="edit_penjual.php?id=<?php echo $_SESSION["nokp"]; ?>" class="edit-button">Edit</a>
  <?php elseif ($_SESSION["status"] === "admin"): ?>
  <a href="edit_admin.php?id=<?php echo $_SESSION["nokp"]; ?>" class="edit-button">Edit</a>
  <?php endif; ?>

</div>

</body>
</html>
