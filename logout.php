<?php
session_start();
session_destroy();
echo "<script>alert('You had been logged out.') </script>";
?>
<script>window.location='menu.php'</script>