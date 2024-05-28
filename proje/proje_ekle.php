<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "proje_kontrol_sistemi";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$form_submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$form_submitted) {
    $projeAdi = $_POST["proje_adi"];
    $baslangicTarihi = $_POST["p_bas_tarih"];
    $bitisTarihi = $_POST["p_bit_tarih"];

    $sql = "INSERT INTO proje (proje_adi, p_bas_tarih, p_bit_tarih)
            VALUES (?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $projeAdi, $baslangicTarihi, $bitisTarihi);

    if ($stmt->execute()) {
        echo "Proje başarıyla eklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $form_submitted = true;
}

$conn->close();
?>
