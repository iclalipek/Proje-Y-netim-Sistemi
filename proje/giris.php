<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "proje_kontrol_sistemi";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $admin_query = "SELECT * FROM  admin  WHERE admin_adi = '$username' AND admin_sifre = '$password'";
    $admin_result = $conn->query($admin_query);

    if ($admin_result->num_rows > 0) {
        
        echo "Admin Giriş işlemi başarılı";
        header("Location: ../data/secondadmin.php");
    } else {
        
        $calisan_query = "SELECT * FROM calisanlar WHERE calisan_adi = '$username' AND calisan_sifre = '$password'";
        $calisan_result = $conn->query($calisan_query);

        if ($calisan_result->num_rows > 0) {
            
            
            header("Location: ../data/secondcalisan.php");
            exit(); 
        } else {
            
            echo "Kullanıcı veya şifre hatalı";
        }
    }

    
    //$conn->close();
}
?>
