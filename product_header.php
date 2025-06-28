<?php
session_start();
?>
<!DOCTYPE html>
<style>
  .logo-image {
  height: 94px;
  margin-left:75px;
}
  </style>
<html>
  <link rel="stylesheet" href="product.css">
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" type="text/css" href="sidebar.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
<header class="nio-header">
<?php
// Sambungan ke pangkalan data
include("connection.php");
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
<body <?php if (isset($_SESSION["nama"])) { ?>class="greet"<?php } ?>>
<?php if (isset($_SESSION["nama"])) { ?>
    <a href="account.php">Hi, <?php echo $_SESSION["nama"]; ?></a>
<?php } ?>
</body>
</center>
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
if (isset($_SESSION["status"])) {
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
      </body>
    </ul>
  </nav>
</header>

<div class="sidebar">
		<a href="mobile.php" class="icon"><i class="fas fa-mobile-alt"></i></a>
		<a href="audio.php" class="icon"><i class="fas fa-headphones"></i></a>
		<a href="c&l.php" class="icon"><i class="fas fa-laptop"></i></a>
		<a href="tv&m.php" class="icon"><i class="fas fa-tv"></i></a>
		<a href="ha.php" class="icon"><i class="fas fa-blender"></i></a>
		<a href="accessories.php" class="icon"><i class="fas fa-keyboard"></i></a>
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