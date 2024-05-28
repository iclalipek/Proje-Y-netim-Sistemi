<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen görev ID'sini al
    $gorevID = $_POST["gorev_id"];

    // Veritabanına bağlanma
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proje_kontrol_sistemi";

    // Veritabanı bağlantısını kontrol et
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanına bağlanılamadı: " . $conn->connect_error);
    }

    // Görevi silme SQL sorgusu
    $sql = "DELETE FROM gorev WHERE gorev_id = $gorevID";

    // Sorguyu çalıştır ve başarı kontrol et
    if ($conn->query($sql) === TRUE) {
        echo "Silindi Görev ID: " . $gorevID;
    } else {
        echo "Hata oluştu: " . $conn->error;
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
}

?>
