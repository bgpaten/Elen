<?php

require "config.php";

$id = $_GET["id"];

$soal = mysqli_query($connect, "SELECT * FROM soal WHERE id = '$id'");

$soalData = mysqli_fetch_assoc($soal);

$hapus = mysqli_query($connect, "DELETE FROM soal WHERE id =$id");

session_start();
$_SESSION['hapus'] = "Successfull";

header("Location: detail_matkul.php?id=$soalData[matkul_id]");
