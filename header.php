<?php
session_start();
//sambungan ke pangkalan data
include("connection.php");
?>
<!DOCTYPE html>
<html>

  <link rel="stylesheet" href="product.css">
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
<header class="nio-header">
<?php
if(isset($_SESSION['status']) && $_SESSION['status'] == "pembeli"){
  echo '<a href="pembeli_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} elseif(isset($_SESSION['status']) && $_SESSION['status'] == "penjual"){
  echo '<a href="penjual_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} elseif(isset($_SESSION['status']) && $_SESSION['status'] == "admin"){
  echo '<a href="admin_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} else{
  echo '<a href="menu.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
}
?>
<center>
  <body class="greet">
    <?php
    if (isset($_SESSION["nama"])) {
      echo '<a href="account.php">Hi, ' . $_SESSION["nama"] . '</a>';
    }
    ?>
  </body>
</center>
  <nav class="nio-nav">
    <ul>
    <?php if (!isset($_SESSION["status"]) || $_SESSION["status"] == "pembeli"): ?>
      <li><a href="product.php">Products</a></li>
      <div class="dropdown">
      <button class="dropbtn">Categories</button>
      <div class="dropdown-content">
        <a href="mobile.php">Mobile</a>
        <a href="audio.php">Audio</a>
        <a href="c&l.php">Computers & Laptops</a>
        <a href="tv&m.php">TV & Monitors</a>
        <a href="ha.php">Home Appliances</a>
        <a href="accesories.php">Accessories</a>
      </div>
    </div>
    <?php endif; ?>
          <?php if (isset($_SESSION["status"]) && $_SESSION["status"] == "penjual"): ?>
            <li><a href="home_edit_product.php">Edit Products</a></li>
          <?php endif; ?>
          <?php if (isset($_SESSION["status"]) && $_SESSION["status"] == "admin"): ?>
            <li><a href="home_edit_penjual.php">Edit Sellers</a></li>
            <li><a href="home_edit_product.php">Edit Products</a></li>
          <?php endif; ?>
        <div class="dropdown">
          <button class="dropbtn">Support</button>
            <div class="dropdown-content">
              <a href="support.php">Contact</a>
              <button id="toggleButton" class="colour-btn">Colour Change</button>
            </div>
        </div>
        <li><a href="profile.php">Attributions</a></li>
        <?php
          if (isset($_SESSION['status']) && $_SESSION['status'] == "pembeli") {
              echo '<li><a href="cart.php">Comparison</a></li>';
          }
        ?>
      <body>

<?php
  if (isset($_SESSION["status"]) && ($_SESSION["status"] == "pembeli" || $_SESSION["status"] == "penjual"|| $_SESSION["status"] == "admin")) {
    // do nothing
  } else {
      echo '<a href="home.php" class="btn signup-btn">Sign Up</a>  <a href="index.php" class="btn login-btn">Login</a>';
  }
?>

<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="input-box">
  <input type="text" placeholder="Enter to search..." id="searchInput" name="search">
    <span class="icon">
      <i class="fa fa-search search-icon"></i>
    </span>
    <i class="fa fa-times close-icon"></i>
  </div>
</form>
    </ul>
  </nav>
</header>

<div class="product-container">
	    <?php
		//sambungan ke pangkalan data
include("connection.php");
		if (isset($_GET['search'])) {
			$search = mysqli_real_escape_string($con, $_GET['search']);
			$sql = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%' ORDER BY category ASC";
      $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 0) {
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
  }
    mysqli_close($con);
		?>
	</div>
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

  // Animasi interaksi untuk bar carian
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
  // code to remove echo output from the page
}
</script>
