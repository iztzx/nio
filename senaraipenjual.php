<?PHP

 
include ('header.php');

   
   //langkah 3 pangil fail
   include('connection.php');
   //langkah 4 bina header
   echo"<a href='daftarpenjual.php'>[Daftar Penjual]</a>";
 echo" 
   <table border='1' width='100%' bgcolor='#FFF454'>

   <tr>
   <td>ID Penjual</td>
   <td>Nama Penjual</td>
   <td>Kata Laluan</td>
   <td>Kemaskini</td>
   <td>Padam Data</td>
   </tr>
   ";
   //langkah 5 pilih data dari database
   $sqlselect=mysqli_query($con,"
   select* from penjual
  

   ");
   //langkah 6
   while($datayangdipilih=mysqli_fetch_array($sqlselect)){
      //langkah 7  
      echo"
<tr width='100%'>
   <td>".$datayangdipilih['idpenjual']."</td>
   <td>".$datayangdipilih['namapenjual']."</td>
   <td>".$datayangdipilih['katalaluan']."</td>
   
   <td>
   <a href ='kemaskinipenjual.php?idpenjual=".$datayangdipilih['idpenjual']."'>Kemaskini</a>
   </td>
   <td>
   <a href ='padampenjual.php?idpenjual=".$datayangdipilih['idpenjual']."'
   onClick=\"return confirm('AMARAN! PEMADAMAN DATA PENJUAL SEKALIGUS
    TIDAK DAPAT DIPEROLEH SEMULA')\"
   >Padam</a>
   </td>
 </tr>
 ";
   }
   echo"
   </table>";








   echo"<a href='menuutama.php'>Kembali Ke Menu Utama</a>";

?> 