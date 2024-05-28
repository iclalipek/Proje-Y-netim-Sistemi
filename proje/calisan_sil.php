<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proje_kontrol_sistemi";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Veritabanına bağlantı hatası: " . $conn->connect_error);
    }

    
    $calisanAdi = isset($_POST['ad']) ? $_POST['ad'] : '';
    $calisanSoyadi = isset($_POST['soyad']) ? $_POST['soyad'] : '';

    
    $sql = "DELETE FROM calisanlar WHERE calisan_adi = ? AND calisan_soyadi = ?";

    
    $stmt = $conn->prepare($sql);

   
    $stmt->bind_param("ss", $calisanAdi, $calisanSoyadi);

   
    if ($stmt->execute()) {
        echo "Çalışan silindi: " . $calisanAdi . " " . $calisanSoyadi;
    } else {
        echo "Hata oluştu: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
