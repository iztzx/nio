<?php
include("header.php");

// Sambungan ke pangkalan data
include("connection.php");

//Semak sama ada pengguna telah log masuk
if (empty($_SESSION['status']) || $_SESSION['status'] !== 'pembeli') {
    echo "<script>
        alert('Please sign in as an user.');
        window.location.href = 'menu.php';
    </script>";
    exit;
}

// Semak sama ada parameter 'action' telah ditetapkan dan tambah/keluarkan produk dalam senarai mengikutnya
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $quantity = 1; 
                
                // Tambah atau kemaskini produk ke dalam pangkalan data
                $nokp = $_SESSION['nokp'];
                $today = date('Y-m-d');

                $check_query = "SELECT * FROM bandingan WHERE nokp = '$nokp' AND idproduk = '$id'";
                $check_result = mysqli_query($con, $check_query);

                if (mysqli_num_rows($check_result) > 0) {
                    $update_query = "UPDATE bandingan SET kuantiti = kuantiti + '$quantity' WHERE nokp = '$nokp' AND idproduk = '$id'";
                    mysqli_query($con, $update_query);
                } else {
                    $insert_query = "INSERT INTO bandingan (nokp, idproduk, tarikh, kuantiti) VALUES ('$nokp', '$id', '$today', '$quantity')";
                    mysqli_query($con, $insert_query);
                }

                // Kembali ke laman senarai bandingan
                header("Location: cart.php");
                exit();
            }
            break;

        case 'clear':
            // Kosongkan senarai
            $nokp = $_SESSION['nokp'];
            $clear_query = "DELETE FROM bandingan WHERE nokp = '$nokp'";
            mysqli_query($con, $clear_query);

            // Selepas pemprosesan data, kembali ke senarai bandingan
            header("Location: cart.php");
            exit();
            break;

        case 'remove':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $nokp = $_SESSION['nokp'];

                // Kosongkan produk dalam senarai dalam database
                $remove_query = "DELETE FROM bandingan WHERE nokp = '$nokp' AND idproduk = '$id'";
                mysqli_query($con, $remove_query);

                // Selepas pemprosesan data, kembali ke senarai perbandingan
                header("Location: cart.php");
                exit();
            }
            break;
    }
}

// Dapatkan senarai perbandingan dari jadual 'bandingan'
$nokp = $_SESSION['nokp'];
$cart_query = "SELECT b.idproduk, p.namaproduk, p.gambar, p.harga, b.kuantiti FROM bandingan b INNER JOIN produk p ON b.idproduk = p.idproduk WHERE b.nokp = '$nokp'";
$cart_result = mysqli_query($con, $cart_query);

$cart_items = array();
$total = 0;

while ($row = mysqli_fetch_assoc($cart_result)) {
    $id = $row['idproduk'];
    $quantity = $row['kuantiti'];
    $subtotal = $row['harga'] * $quantity;
    $total += $subtotal;

    $cart_items[$id] = array(
        'namaproduk' => $row['namaproduk'],
        'gambar' => $row['gambar'],
        'harga' => $row['harga'],
        'quantity' => $quantity,
        'subtotal' => $subtotal
    );
}

// Kemas kini kuantiti produk sekiranya jadual dihantar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['quantity'])) {
        $id = $_POST['id'];
        $quantity = intval($_POST['quantity']);
        
        // Kemas kini quantity dalam jadual 'bandingan'
        $nokp = $_SESSION['nokp'];
        $update_query = "UPDATE bandingan SET kuantiti = '$quantity' WHERE nokp = '$nokp' AND idproduk = '$id'";
        mysqli_query($con, $update_query);

        // Selepas pemprosesan data, kembali ke senarai perbandingan
        header("Location: cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="cart.css">
    <title>Comparison List</title>
    <script>
        function confirmRemove() {
            return confirm("Are you sure you want to remove this item from the comparison?");
        }
    </script>
</head>
<body>
    <div class="main-content">
        <center>
            <br>
            <h1 style="margin-top:-25px;">Comparison List</h1>
        </center>

        <div class="product-container">
            <?php
            if (empty($cart_items)) {
                echo "<p>Your comparison list is empty.</p>";
            } else {
                echo "<table>";
                echo "<thead><tr><th>Product Name</th><th>Image</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr></thead>";
                echo "<tbody>";

                foreach ($cart_items as $id => $item) {
                    echo '<tr>';
                    echo '<td>' . $item["namaproduk"] . '</td>';
                    echo '<td><img src="product-img/' . $item["gambar"] . '" alt="Product Image"></td>';
                    echo '<td>RM' . $item["harga"] . '</td>';
                    echo '<td>';
                    echo '<form method="post" action="cart.php">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<input type="number" name="quantity" min="1" value="' . $item["quantity"] . '" onchange="this.form.submit()" title="Minimum quantity is 1">';
                    echo '</form>';
                    echo '</td>';
                    echo '<td class="subtotal">RM' . number_format($item["subtotal"], 2) . '</td>';
                    echo '<td>';
                    echo '<form method="post" action="cart.php?action=remove&id=' . $id . '" onsubmit="return confirmRemove()">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<button class="remove-from-cart-btn" type="submit" style="font-family:\'Inter\'">Remove</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo "<tr><td colspan='3'><strong>Total</strong></td><td class='total'><strong>RM$total</strong></td><td></td></tr>";
                echo "</tbody>";
                echo "</table>";
                echo "<br>";
                echo '<form method="post" action="cart.php?action=clear">';
                echo '<button class="clear-cart-btn" type="submit" style="font-family:\'Inter\'">Clear Comparison</button>';
                echo '</form>';
                echo '<button class="print-btn" onclick="window.print()">Print</button>';
            }
            ?>
        </div>
    </div>
</body>
</html>
