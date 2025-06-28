<?php
//sambungan ke pangkalan data
include("connection.php");
session_start();
if (!isset($_SESSION["status"])) {
  echo "<script>
    alert('Please sign in as a seller or admin.');
    window.location.href = 'menu.php';
  </script>";
  exit;
} else if ($_SESSION["status"] === "pembeli") {
  echo "<script>
  alert('Please sign in as a seller or admin.');
  window.location.href = 'pembeli_home.php';
</script>";
  exit;
}
if(isset($_GET["scrollTo"])) {
  $scrollTo = $_GET["scrollTo"];
} else {
  $scrollTo = "";
}
?>
<!DOCTYPE html>

<html>
  <title>Edit Products</title>
  <link rel="stylesheet" href="product.css">
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
<header class="nio-header">
<?php
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
  <body class="greet"><a href="account.php">Hi, <?php echo $_SESSION["nama"]; ?></a></greet>
  <nav class="nio-nav">
    <ul>
      <?php 
        if ($_SESSION["status"] == "admin") {
          echo'<li><a href="home_edit_penjual.php">Edit Sellers</a></li>';
        }else
      ?>
      <li><a href="home_edit_product.php">Edit Products</a></li>
      <div class="dropdown">
        <button class="dropbtn">Support</button>
        <div class="dropdown-content">
          <a href="support.php">Contact</a>
          <button id="toggleButton" class="colour-btn">Colour Change</button>
        </div>
      </div>
      <li><a href="profile.php">Attributions</a></li>
      <body>

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

}

</script>
<script>
function removeProduct(idproduk) {
  if (confirm("Are you sure you want to remove this product?")) {
    window.location.href = "remove_product.php?id=" + idproduk;
  }
}
</script>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <div class="main-content">
        <center>
          <h1>Edit Products</h1>
        </center>
        <div class="product-container">
        <?php
//sambungan ke pangkalan data
include("connection.php");

if ($_SESSION["status"] === "admin") {
  if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
    $sql = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%' ORDER BY category ASC, namaproduk ASC";
    $emptyResultMsg = "There are no products with the search term '$search' yet.";
  } else {
    $sql = "SELECT * FROM produk ORDER BY category ASC, namaproduk ASC";
    $emptyResultMsg = "There are no products listed yet.";
  }
} else if ($_SESSION["status"] === "penjual") {
  $idpenjual = $_SESSION['nokp'];
  if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
    $sql = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%' AND idpenjual = '$idpenjual' ORDER BY category ASC, namaproduk ASC";
    $emptyResultMsg = "There are no products with the search term '$search' yet.";
  } else {
    $sql = "SELECT * FROM produk WHERE idpenjual='$idpenjual' ORDER BY category ASC, namaproduk ASC";
    $emptyResultMsg = "You haven't listed any products.";
  }
}

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 0) {
  echo "<font size=\"5\">$emptyResultMsg</font>";
} else {
  while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="product-card" id="product-' . $row["idproduk"] . '">';
      echo '  <img src="product-img/' . $row["gambar"] . '" alt="Product Image">';
      echo '  <h3>' . $row["namaproduk"] . '</h3>';
      echo '  <p>' . $row["keterangan"] . '</p>';
      echo '  <div class="price-add-to-cart">';
      echo '    <span class="price">RM' . $row["harga"] . '</span>';
      echo '<form action="edit_product.php" method="GET">
      <input type="hidden" name="id" value="' . $row['idproduk'] . '">
      <button type="submit" class="edit-product-btn">Edit Product</button>
    </form>';
      echo '<button class="remove-btn" onclick="removeProduct(\''. $row['idproduk'].'\')">Remove Product</button>';
      echo '  </div>';
      echo '</div>';
  }
}




if($scrollTo) {
  echo "<script>
  function setProductHash() {
    window.location.hash = 'product-" . $scrollTo . "';
  }
  
  window.addEventListener('load', setProductHash);
  </script>
  ";
}
?>

        </div>
    </div>
    </body>
</html>
