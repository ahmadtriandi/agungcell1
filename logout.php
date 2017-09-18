<?php
session_start();
//hapus session
unset($_session["nama"]);
//redirect ke halaman login.php
header("location: login.php");
?>
