<?php
include("connection.php");
session_start();

// Memeriksa sama ada status pengguna ditetapkan
if (!isset($_SESSION["status"])) {
  echo "<script>
    alert('Sila log masuk sebagai admin.');
    window.location.href = 'menu.php';
  </script>";
  exit;
} 
// Sekiranya sesi pengguna bukan admin
else if ($_SESSION["status"] !== "admin") {
  echo "<script>
    alert('Sila log masuk sebagai admin.');
    window.location.href = 'index.php';
  </script>";
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>NIO</title>
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="product.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
</head>
<body>
<header class="nio-header">
  <a href="admin_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>
  <div class="greet">
    <a href="account.php">Hi, <?php echo $_SESSION["nama"]; ?></a>
  </div>
  <nav class="nio-nav">
    <ul>
      <li><a href="home_edit_penjual.php">Edit Sellers</a></li>
      <li><a href="home_edit_product.php">Edit Products</a></li>
      <li class="dropdown">
        <button class="dropbtn">Support</button>
        <div class="dropdown-content">
          <a href="support.php">Contact</a>
          <button id="toggleButton" class="colour-btn">Colour Change</button>
        </div>
      </li>
      <li><a href="profile.php">Attributions</a></li>
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

<?php
// Jika terdapat parameter 'search' dalam URL
if (isset($_GET['search'])) {
  $search = mysqli_real_escape_string($con, $_GET['search']);
  $sql = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%' OR jenama LIKE '%$search%' ORDER BY category ASC";
  $result = mysqli_query($con, $sql);

  // Jika tidak ada hasil yang ditemukan
  if (mysqli_num_rows($result) == 0) {
    echo "<br><center><font size=\"5\">Tiada hasil untuk kata kunci pencarian '$search'</font></center>";
  } 
  // Jika terdapat hasil yang ditemukan
  else {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="product-card" id="product-' . $row["idproduk"] . '">';
      echo '  <img src="product-img/' . $row["gambar"] . '" alt="Product Image">';
      echo '  <h3>' . $row["namaproduk"] . '</h3>';
      echo '  <p>' . $row["keterangan"] . '</p>';
      echo '  <div class="price-add-to-cart">';
      echo '    <span class="price">RM' . $row["harga"] . '</span>';
      echo '    <form action="edit_product.php" method="GET">';
      echo '      <input type="hidden" name="id" value="' . $row['idproduk'] . '">';
      echo '      <button type="submit" class="edit-product-btn">Edit Produk</button>';
      echo '    </form>';
      echo '    <button class="remove-btn" onclick="removeProduct(\'' . $row['idproduk'] . '\')">Padam Produk</button>';
      echo '</div>';
    }
  }
}
?>

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

function removeProduct(idproduk) {
  if (confirm("Are you sure you want to remove this product?")) {
    window.location.href = "remove_product.php?id=" + idproduk;
  }
}
</script>

<form class="import-form" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <h2>Import Seller Data</h2>
  <label for="csvFile">CSV File:</label>
  <input type="file" name="csvFile" id="csvFile" accept=".csv">
  <input type="submit" name="submit" value="Import">
  <a class="template" href="template.csv" download>Download Template</a>
</form>

<?php
// Memeriksa jika borang dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_FILES["csvFile"]) && $_FILES["csvFile"]["error"] == UPLOAD_ERR_OK) {
    // Memeriksa jenis fail, jika bukan csv, paparkan mesej ralat
    $fileType = $_FILES["csvFile"]["type"];
    if ($fileType != "text/csv" && $fileType != "application/vnd.ms-excel") {
      echo "<script>alert('Invalid file format. Please upload a CSV file.');</script>";
    } else {
      $file = $_FILES["csvFile"]["tmp_name"];

      // Membuka fail untuk pemprosesan maklumat
      $handle = fopen($file, "r");

      // Kecualikan baris pertama
      fgetcsv($handle);

      // Proseskan maklumat baris-baris seterusnya
      while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $idpenjual = str_pad($data[0], 12, '0', STR_PAD_LEFT);
        $namapenjual = strval($data[1]);
        $katalaluan = strval($data[2]);

        // Proses penyisipan data ke dalam pangkalan data
        $query = "INSERT INTO penjual (idpenjual, namapenjual, katalaluan) VALUES ('$idpenjual', '$namapenjual', '$katalaluan')";
        mysqli_query($con, $query);
      }

      fclose($handle);

      // Paparkan mesej berjaya dan kembali ke laman sama
      echo "<script>alert('CSV file imported successfully.');</script>";
    }
  } else {
    echo "<script>alert('Error uploading CSV file.');</script>";
  }
}
?>
</body>
</html>