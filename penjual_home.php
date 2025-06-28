<?php
//sambungan ke pangkalan data
include("connection.php");
session_start();
if (!isset($_SESSION["status"])) {
  echo "<script>
    alert('Please sign in as a seller.');
    window.location.href = 'menu.php';
  </script>";
  exit;
} else if ($_SESSION["status"] === "pembeli") {
  echo "<script>
  alert('Please sign in as a seller.');
  window.location.href = 'pembeli_home.php';
</script>";
  exit;
}
?>

<!DOCTYPE HTML>
<html>
  <head>
  <title>NIO</title>
  <link rel="stylesheet" href="nio.css">
  <link rel="stylesheet" href="search.css">
  <link rel="stylesheet" href="penjual.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
    <title>Add Product</title>
  </head>
  <header class="nio-header">
  <?php
//sambungan ke pangkalan data
include("connection.php");
if($_SESSION['status'] == "pembeli"){
  echo '<a href="pembeli_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} elseif($_SESSION['status'] == "penjual"){
  echo '<a href="penjual_home.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
} else {
  echo '<a href="menu.php"><img src="imej/tajuk.png" alt="Logo" class="logo-image"></a>';
}
?>
<center>
  <body class="greet"><a href="account.php">Hi, <?php echo $_SESSION["nama"]; ?></a></greet>
</center>
  <nav class="nio-nav">
    <ul>
    <li><a href="home_edit_product.php">Edit Products</a></li>
    <div class="dropdown">
        <button class="dropbtn">Support</button>
        <div class="dropdown-content">
          <a href="support.php">Contact</a>
          <button id="toggleButton" class="colour-btn">Colour Change</button>
        </div>
      </div>
      <li><a href="profile.php">Attributions</a></li>
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
<body>
    <center>
    <h2>List Your Product</h2>
  </center>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
      <label for="namaproduk">Product Name:</label>
      <input type="text" id="namaproduk" name="namaproduk" required>
      <br>
      <label for="keterangan">Product Description:</label>
      <input type="text" id="keterangan" name="keterangan" required>
      <br>
      <label for="category">Select a category:</label>
      <select id="category" name="category">
      <option value="">-- Select Category --</option>
      <option value="MOBILE">Mobile</option>
      <option value="AUDIO">Audio</option>
      <option value="COMPUTERS_LAPTOPS">Computers & Laptops</option>
      <option value="TV_MONITORS">TV & Monitors</option>
      <option value="HOME_APPLIANCES">Home Appliances</option>
      <option value="ACCESSORIES">Accessories</option>
      </select>
      <br>
      <label for="brand">Brand:</label>
      <input type="text" id="brand" name="brand" required>
      <br>
      <label for="gambar">Product Image:</label>
      <input type="file" id="gambar" name="gambar" required onchange="previewImage()">
      <br>
      <img class="preview-img" img id="preview" src="#" alt="Preview" style="display: none;">
      <br>
      <label for="harga">Product Price:</label>
      <input type="number" min="0" max="99999999" step="0.01" id="harga" name="harga" required>
      <br>
      <input type="submit" name="submit" value="Add Product">
  </form>
    </body>
    
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
<?php
if(isset($_POST['submit'])) {
  // get the form data
  $namaproduk = $_POST['namaproduk'];
  $keterangan = $_POST['keterangan'];
  $category = $_POST['category'];
  $brand = $_POST['brand'];
  $harga = $_POST['harga'];

  // check if category is empty
  if(empty($category)) {
    echo "<script>alert('Category is required.');</script>";
    exit;
  }else{
$idpenjual = $_SESSION["nokp"];

if(isset($_POST["submit"])){ 
  $query = "SELECT MAX(idproduk) AS max_id FROM produk";
  $result = mysqli_query($con, $query);
if (!$result) {
  die("Error: " . mysqli_error($con));
}
$data = mysqli_fetch_assoc($result);

  $max_id = (int)$data["max_id"];
  $idproduk = str_pad($max_id + 1, 4, "0", STR_PAD_LEFT); 
    $namaproduk = $_POST["namaproduk"]; 
    $keterangan = $_POST["keterangan"]; 
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $gambar = $_FILES["gambar"]["name"];
    $harga = $_POST["harga"];
  
    $check_query = "SELECT * FROM produk WHERE namaproduk = '$namaproduk'";
    $check_result = mysqli_query($con, $check_query);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows > 0) {
        echo "<script>alert('Product with the same name already exists.');</script>";
    } else {
      $uploaddir = "product-img/";
      $nama_file = $_FILES['gambar']['name'];
      $path_parts = pathinfo($nama_file);
      $extension = $path_parts['extension'];
      $nama_file_baru = $nama_file;
      $i = 1;
      
      while (file_exists($uploaddir . $nama_file_baru)) {
          $nama_file_baru = $path_parts['filename'] . '-' . $i . '.' . $extension;
          $i++;
      }
      
      if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploaddir . $nama_file_baru)) {
          $gambar = $nama_file_baru;
          $stmt = mysqli_prepare($con, "INSERT INTO produk (idproduk, namaproduk, keterangan, category, brand, gambar, harga, idpenjual) values(?, ?, ?, ?, ?, ?, ?, ?)"); 
          mysqli_stmt_bind_param($stmt, "ssssssss", $idproduk, $namaproduk, $keterangan, $category, $brand, $gambar, $harga, $idpenjual); 
          mysqli_stmt_execute($stmt); 
          $result = mysqli_stmt_affected_rows($stmt); 
          mysqli_stmt_close($stmt); 
      
          if($result){
              echo "<script>alert('Product information successfully added and image uploaded.');</script>";
          } else {
              echo "<script>alert('Failed to add product information.');</script>"; 
          }
      } else {
          echo "<script>alert('Product information added, but failed to upload the image.');</script>";
      }
    }
  }
}
}
?>
<script>
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
document.querySelector('form').reset();

</script>

</html>