<?php
    // Sambungan ke pangkalan data
    include("connection.php");

    // Memeriksa jika borang telah dihantar
    if (isset($_POST["submit"])) {
        // Mengambil nilai-nilai dari borang
        $idpenjual = $_POST["idpenjual"];
        $namapenjual = $_POST["namapenjual"];
        $katalaluan = $_POST["katalaluan"];

        // Memeriksa sama ada ID penjual telah digunakan sebelum ini di table pembeli
        $check_query = "SELECT * FROM pembeli WHERE nokp = '$idpenjual'";
        $check_result = mysqli_query($con, $check_query);
        $num_rows = mysqli_num_rows($check_result);
                
        // Memeriksa sama ada ID penjual telah digunakan sebelum ini di table penjual
        $check_query2 = "SELECT * FROM penjual WHERE idpenjual = '$idpenjual'";
        $check_result2 = mysqli_query($con, $check_query2);
        $num_rows2 = mysqli_num_rows($check_result2);
                
        // Paparan error sekiranya ada ID penjual yang sama
        if ($num_rows > 0 || $num_rows2 > 0) {
            echo "<script>alert('This Seller ID has been used');</script>";
        } else {
            // Menyediakan pernyataan SQL dan menjalankan penyisipan rekod baru ke pangkalan data
            $stmt = mysqli_prepare($con, "INSERT INTO penjual (idpenjual, namapenjual, katalaluan) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $idpenjual, $namapenjual, $katalaluan);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);

            // Memaparkan mesej berjaya atau tidak berjaya selepas penyisipan rekod
            if($result) {
                echo "<script>alert('Signed up successful.')</script>"; 
                echo "<script>window.location='index.php'</script>"; 
            } else { 
                echo "<script>alert('Sign up failed.')</script>"; 
                echo "<script>window.location='daftarmasuk.php'</script>"; 
            }
        }
    } 
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<!DOCTYPE html>
<html>
<body>
    <center>
        <a href="menu.php"><img class="tajuk" src="imej/tajuk.png" width="500"></a>
    </center>
    <center>
        <h3 class="panjang">SELLER CENTRE</h3>
        <form class="panjang" action="daftarpenjual.php" method="post">
            <table>
                <tr>
                    <td>Seller ID</td>
                    <td>
                        <input required type="text" name="idpenjual" placeholder="xxxxxxxxxxxxxxxx" 
                            pattern="[0-9]{12}" 
                            oninvalid="this.setCustomValidity('Please enter 12 numbers without -')" 
                            oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <td>Seller Name</td>
                    <td><input required type="text" name="namapenjual" placeholder="Your name"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input required type="password" name="katalaluan" placeholder="Password" maxlength="8" title="Maximum length is 8"></td>
                </tr>
            </table>

            <button class="tambah" type="submit" name="submit">Sign Up</button>
            <button class="batal" type="button" onclick="window.location='home.php'">Cancel</button>
        </form>
    </center>
</body>
</html>