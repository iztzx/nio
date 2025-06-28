<?php
// Sambungan ke pangkalan data
include("connection.php");

// Fungsi scroll to
if (isset($scrollTo)) {
  echo '<script>
  function scrollToProduct() {
    var product = document.getElementById("product-' . $scrollTo . '");
    if (product) {
      var topOffset = product.getBoundingClientRect().top + window.pageYOffset;
      window.scrollTo({ top: topOffset, behavior: "smooth" });
    }
  }

  window.addEventListener("load", scrollToProduct);
  </script>';
}

// Tetapkan kategori berdasarkan laman semasa
$category = '';
if (basename($_SERVER['PHP_SELF']) == 'audio.php') {
  $category = 'AUDIO';
} elseif (basename($_SERVER['PHP_SELF']) == 'mobile.php') {
  $category = 'MOBILE';
} elseif (basename($_SERVER['PHP_SELF']) == 'c&l.php') {
  $category = 'COMPUTERS_LAPTOPS';
} elseif (basename($_SERVER['PHP_SELF']) == 'tv&m.php') {
  $category = 'TV_MONITORS';
} elseif (basename($_SERVER['PHP_SELF']) == 'ha.php') {
  $category = 'HOME_APPLIANCES';
} elseif (basename($_SERVER['PHP_SELF']) == 'accessories.php') {
  $category = 'ACCESSORIES';
}
// Memeriksa jika parameter 'search' telah dihantar melalui URL.
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
    // Melakukan carian
    $sql = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%'";

    if (!empty($category)) {
    // Menambah syarat tambahan kepada kod SQL jika terdapat kategori yang ditetapkan.
    $sql .= " AND category = '$category'";
  }
  // Menambah syarat secara menaik kepada kod SQL.
  $sql .= " ORDER BY namaproduk ASC";
    } else {
    // Memeriksa jika kategori tidak kosong.
    if (!empty($category)) {
        $sql = "SELECT * FROM produk WHERE category = '$category' ORDER BY namaproduk ASC";
    } else {
    $sql = "SELECT * FROM produk ORDER BY category ASC, namaproduk ASC";
  }
}

$result = mysqli_query($con, $sql);

// Jika tiada hasil untuk carian $search
if (mysqli_num_rows($result) == 0) {
  echo "<br><center><font size=\"5\">There are no results for the search term '$search'</font></center>";
} else {
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="product-card" id="product-' . $row["idproduk"] . '">';
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