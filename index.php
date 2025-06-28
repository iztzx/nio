<?php
    session_start();
    // Sambungan ke pangkalan data
    include("connection.php");

    // Semak jika borang telah dihantar
    if(isset($_POST["submit"])){
        // Dapatkan input dari borang
        $nokp = mysqli_real_escape_string($con, $_POST["nokp"]); 
        $katalaluan = mysqli_real_escape_string($con, $_POST["katalaluan"]);
        
        // Flag untuk menyimpan keputusan carian pengguna
        $jumpa = FALSE;
        $user_found = FALSE;
        
        // Semak dalam jadual pembeli
        $sql = "SELECT * FROM pembeli WHERE (nokp=? OR emelpembeli=?) AND katalaluan=?";
        $stmt = mysqli_stmt_init($con);
            if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $nokp, $nokp, $katalaluan);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
            // Pengguna pembeli dijumpai
            $user_found = TRUE;
            $jumpa = TRUE;
            $pembeli = mysqli_fetch_array($result);
            $_SESSION["nokp"] = $pembeli["nokp"];
            $_SESSION["nama"] = $pembeli["namapembeli"];
            $_SESSION["status"] = "pembeli";
        }
    }    

        // Jika pengguna tidak dijumpai dalam jadual pembeli
        if(!$user_found){
            // Semak dalam jadual penjual
            $sql = "SELECT * FROM penjual WHERE idpenjual=? AND katalaluan=?";
            $stmt = mysqli_stmt_init($con);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $nokp, $katalaluan);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                    // Pengguna penjual dijumpai
                    $jumpa = TRUE;
                    $penjual = mysqli_fetch_array($result);
                    $_SESSION["nokp"] = $penjual["idpenjual"];
                    $_SESSION["nama"] = $penjual["namapenjual"];
                    $_SESSION["status"] = "penjual";
                }
            }
        }

        // Jika pengguna tidak dijumpai dalam jadual penjual
        if(!$user_found){
            // Semak dalam jadual admin
            $sql = "SELECT * FROM admin WHERE idadmin=? AND katalaluan=?";
            $stmt = mysqli_stmt_init($con);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $nokp, $katalaluan);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                    // Pengguna admin dijumpai
                    $jumpa = TRUE;
                    $admin = mysqli_fetch_array($result);
                    $_SESSION["nokp"] = $admin["idadmin"];
                    $_SESSION["nama"] = $admin["namaadmin"];
                    $_SESSION["status"] = "admin";
                }
            }
        }
        
        // Jika jumpa pengguna
        if($jumpa){
            // Semak status pengguna dan lakukan tindakan yang berkaitan
            if($_SESSION["status"] == "pembeli"){
                echo "<script>
                alert('Logged in successfully.');
                window.location='pembeli_home.php';
                </script>";
            } else if ($_SESSION["status"] == "penjual"){
                echo "<script>
                alert('Logged in successfully.');
                window.location='penjual_home.php';
                </script>";
            } else if ($_SESSION["status"] == "admin" ){
                echo "<script>
                alert('Logged in successfully.');
                window.location='admin_home.php';
                </script>";
            };
        }

        // Jika tidak jumpa pengguna
        if($jumpa==FALSE){
            echo "<script>
                alert('Incorrect user id or password. Please try again.');
                window.location='index.php';
                </script>";
        }
    }
?>
<link rel="stylesheet" href="abutton.css">
<link rel="stylesheet" href="aborang.css">

<!DOCTYPE html>
<html>
<center>
    <a href="menu.php"><img class="tajuk" src="imej/tajuk.png" width=500></a>
</center>
<h3 class="pendek">LOG IN</h3>
<center>
<form class="pendek" action="index.php" method="post">
    <table>
        <tr>
            <td><img src="imej/user.png" width= 60px></td>
            <td><input type="text" name="nokp" placeholder="Your ID here (User ID/Email)" required></td>
        </tr>
        <tr>
            <td><img src="imej/lock.png" width= 60px></td>
            <td><input type="password" name="katalaluan" placeholder="Password" maxlength="8" required></td>
        </tr>
    </table>
    <button class="login" type="submit"name="submit">Login</button> 
    <button class="signup" type="button" onclick="window.location='home.php'"> Sign Up </button>
</center>
</form>
</html>