<?php 
    // Sambungan ke pangkalan data
    include("connection.php"); 

    // Memeriksa jika borang telah dihantar
    if(isset($_POST["submit"])) { 
        // Mengambil nilai-nilai dari borang
        $nokp = $_POST["nokp"]; 
        $emelpembeli = $_POST["emelpembeli"]; 
        $namapembeli = $_POST["namapembeli"]; 
        $katalaluan = $_POST["katalaluan"]; 

        // Memeriksa sama ada Nombor KP telah digunakan sebelum ini di table pembeli
        $check_ic_query = "SELECT * FROM pembeli WHERE nokp = '$nokp'";
        $check_ic_result = mysqli_query($con, $check_ic_query);
        $num_ic_rows = mysqli_num_rows($check_ic_result);

        // Memeriksa sama ada Nombor KP telah digunakan sebelum ini di table penjual
        $check_ic_query2 = "SELECT * FROM penjual WHERE idpenjual = '$nokp'";
        $check_ic_result2 = mysqli_query($con, $check_ic_query2);
        $num_ic_rows2 = mysqli_num_rows($check_ic_result2);

        // Memeriksa sama ada Emel telah digunakan sebelum ini
        $check_email_query = "SELECT * FROM pembeli WHERE emelpembeli = '$emelpembeli'";
        $check_email_result = mysqli_query($con, $check_email_query);
        $num_email_rows = mysqli_num_rows($check_email_result);

        // Paparan error sekiranya ada Nombor KP atau Emel yang sama
        if ($num_ic_rows > 0 || $num_ic_rows2 > 0) {
            echo "<script>alert('This IC number has been used');</script>";
        } else if ($num_email_rows > 0) {
            echo "<script>alert('This Email has been used');</script>";
        } else {
            // Menyediakan pernyataan SQL dan menjalankan penyisipan rekod baru ke pangkalan data
            $stmt = mysqli_prepare($con, "INSERT INTO pembeli values(?, ?, ?, ?)"); 
            mysqli_stmt_bind_param($stmt, "ssss", $nokp, $emelpembeli, $namapembeli, $katalaluan); 
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
        <a href="menu.php">
            <img class="tajuk" src="imej/tajuk.png" width=500>
        </a>
        <h3 class="panjang">SIGN UP</h3>
        <form class="panjang" action="daftarmasuk.php" method="post">
            <table>
                <tr>
                    <td>Nombor KP</td>
                    <td>
                        <input required type="text" name="nokp" placeholder="xxxxxxxxxxxxxxxx"
                            pattern="[0-9]{12}"
                            oninvalid="this.setCustomValidity('Please enter 12 numbers without -')"
                            oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>
                        <input required type="text" name="namapembeli" placeholder="Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Emel</td>
                    <td>
                        <input required type="email" name="emelpembeli" placeholder="Your Email">
                    </td>
                </tr>
                <tr>
                    <td>Katalaluan</td>
                    <td>
                        <input required type="password" name="katalaluan" placeholder="Password" maxlength="8" title="Maximum length is 8">
                    </td>
                </tr>
            </table>

            <button class="tambah" type="submit" name="submit">Sign Up</button>
            <button class="batal" type="button" onclick="window.location='home.php'">Cancel</button>
        </form>
    </center>
</body>
</html>