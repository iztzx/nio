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
} elseif ($_SESSION["status"]=="penjual") {
  echo "<script>
    window.location.href = 'account.php';
  </script>";
  exit;
} elseif ($_SESSION["status"] !== "admin") {
  echo "<script>
  alert('Please sign in as an admin.');
  window.location.href = 'index.php';
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
<head>
  <title>Edit Seller</title>
  <link rel="stylesheet" href="penjualedit.css">
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
    <li><a href="home_edit_penjual.php">Edit Sellers</a></li>
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
  <div class="main-content">
    <center>
      <h1>Edit Sellers</h1>
    </center>
    <div class="penjual-container">
      <?php
      // Sambungan ke pangkalan data
      include("connection.php");

      if ($_SESSION["status"] === "admin") {
        if (isset($_GET['search'])) {
          $search = mysqli_real_escape_string($con, $_GET['search']);
          $sql = "SELECT * FROM penjual WHERE idpenjual LIKE '%$search%' OR namapenjual LIKE '%$search%' ORDER BY idpenjual ASC";
          $emptyResultMsg = "There are no sellers with the search term '$search' yet.";
        } else {
          $sql = "SELECT * FROM penjual ORDER BY idpenjual ASC";
          $emptyResultMsg = "There are no sellers listed yet.";
        }
      }

      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) == 0) {
        echo "<font size=\"5\">$emptyResultMsg</font>";
      } else {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="penjual-card" id="penjual-' . $row["idpenjual"] . '">';
          echo '  <div class="penjual-info">';
          echo '    <h3>' . $row["idpenjual"] . '</h3>';
          echo '    <h3>' . $row["namapenjual"] . '</h3>';
          echo '  </div>';
          echo '  <div class="button-container">';
          echo '    <form action="edit_penjual.php" method="GET">';
          echo '      <input type="hidden" name="id" value="' . $row['idpenjual'] . '">';
          echo '      <button type="submit" class="edit-penjual-btn">Edit Seller</button>';
          echo '    </form>';
          echo '    <button class="remove-btn" onclick="removePenjual(\'' . $row['idpenjual'] . '\')">Remove Seller</button>';
          echo '  </div>';
          echo '</div>';
        }
      }

      if($scrollTo) {
        echo "<script>
        function setPenjualHash() {
          window.location.hash = 'penjual-" . $scrollTo . "';
        }

        window.addEventListener('load', setPenjualHash);
        </script>";
      }
      ?>
    </div>
  </div>
</body>
</html>
