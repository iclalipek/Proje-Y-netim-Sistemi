<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "proje_kontrol_sistemi";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


$calisanAdi = $_POST['calisan_adi'];
$calisanSoyadi = $_POST['calisan_soyadi'];
$calisanSifre = $_POST['calisan_sifre'];



$sql = "INSERT INTO calisanlar (calisan_adi, calisan_soyadi,calisan_sifre) VALUES ('$calisanAdi', '$calisanSoyadi','$calisanSifre')";


if ($conn->query($sql) === TRUE) {
    echo "Yeni çalışan başarıyla eklendi.";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
