<!DOCTYPE html>
<html>
<head>
  <title>NIO</title>
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="product.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
</head>
<body>
<header class="nio-header">
  <a href="menu.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>
  <!-- bar navigasi -->
  <nav class="nio-nav">
    <ul>
      <!-- menu dropdown -->
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
       <div class="dropdown">
        <button class="dropbtn">Support</button>
        <div class="dropdown-content">
          <a href="support.php">Contact</a>
          <button id="toggleButton" class="colour-btn">Colour Change</button>
        </div>
      </div>
      <li><a href="profile.php">Attributions</a></li>
      <?php
      session_start();
      if (isset($_SESSION["status"])) {
        //tidak memaparkan butang login/signup sekiranya telah mempunyai status (telah log masuk)
      } else {
        echo '<a href="home.php" class="btn signup-btn">Sign Up</a>  <a href="index.php" class="btn login-btn">Login</a>';
      }
      ?>
    <!-- search bar -->
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="input-box">
        <input type="text" placeholder="Enter to search..." id="searchInput" name="search">
        <span class="icon">
          <i class="fa fa-search search-icon"></i>
        </span>
        <i class="fa fa-times close-icon"></i>
    </form>
    </ul>
  </div>
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

  // Animasi interaksi bar carian
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
  
  function removePenjual(idpenjual) {
    if (confirm("Are you sure you want to remove this seller?")) {
      window.location.href = "remove_penjual.php?id=" + idpenjual;
    }
  }
</script>
<?php
//sambungan ke pangkalan data
include("connection.php");

//arahan sql sekiranya pengguna menggunakan fungsi search
if (isset($_GET['search'])) {
  $search = mysqli_real_escape_string($con, $_GET['search']);
  $sql = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%' ORDER BY category ASC";
} else {
  $sql = "SELECT * FROM produk ORDER BY category ASC LIMIT 0";
}
?>
<!-- Paparan pembentangan gambar -->
<section class="hero">
  <div class="hero">
    <div class="slide">
      <img src="imej/1.png" alt="Slide 1">
    </div>
    <div class="slide">
      <img src="imej/2.png" alt="Slide 2">
    </div>
    <div class="slide">
      <img src="imej/3.png" alt="Slide 3">
    </div>
  </div>
</section>

<?php
$result = mysqli_query($con, $sql);
//arahan memaparkan produk tertentu pada laman utama sekiranya tiada search
if (!isset($_GET['search'])) {
  echo '<section class="featured-products">';
  echo "<h2>Featured Products</h2>";
  echo '<div class="product">';
  echo '  <img src="imej/product1.png" alt="Product 1" >';
  echo '  <h3>iPad Pro</h3>';
  echo '  <p>Supercharged by M2.</p>';
  echo '  <a href="product.php?scrollTo=0342" class="btn">View Details</a>';
  echo '</div>';
  echo '<div class="product">';
  echo '  <img src="imej/product2.png" alt="Product 2" >';
  echo '  <h3>Samsung HW-Q990B</h3>';
  echo '  <p>Wireless Dolby Atmos, True 11.1.4ch.</p>';
  echo '  <a href="product.php?scrollTo=0022" class="btn">View Details</a>';
  echo '</div>';
  echo '<div class="product">';
  echo '  <img src="imej/product3.png" alt="Product 3">';
  echo '  <h3>Alienware x15 R2</h3>';
  echo '  <p>Sophisticated, Unmatched performance.</p>';
  echo '  <a href="product.php?scrollTo=0019" class="btn">View Details</a>';
  echo '</div>';
  echo '<div class="product">';
  echo '  <img src="imej/product4.png" alt="Product 4" >';
  echo '  <h3>Miele WWV980 WPS Passion</h3>';
  echo '  <p>Meets your highest expectations.</p>';
  echo '  <a href="product.php?scrollTo=0121" class="btn">View Details</a>';
  echo '</div>';
  echo '</section>';
  //arahan memaparkan tiada produk bagi pencarian sekiranya tiada produk dalam pangkalan data yang memenuhi syarat pencarian
} elseif (mysqli_num_rows($result) == 0) {
  echo "<br>
  <center>
  <br><center><font size=\"5\">There are no results for the search term '$search'</font></center>
  </center>";
} else {
    //arahan memaparkan produk bagi pencarian
  echo '<div class="product-container">';
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="product-card">';
    echo '  <img src="product-img/' .$row["gambar"] . '" alt="Product Image">';
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

  echo '</div>';
}

mysqli_close($con);
?>
</body>
</html>
