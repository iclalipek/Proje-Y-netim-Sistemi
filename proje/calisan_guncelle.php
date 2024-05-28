<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proje_kontrol_sistemi";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eskiAd = $_POST['eskiAd'];
    $eskiSoyad = $_POST['eskiSoyad'];
    $yeniAd = $_POST['yeniAd'];
    $yeniSoyad = $_POST['yeniSoyad'];

    
    $sql = "UPDATE calisanlar SET calisan_adi='$yeniAd', calisan_soyadi='$yeniSoyad' WHERE calisan_adi='$eskiAd' AND calisan_soyadi='$eskiSoyad'";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla güncellendi.";
    } else {
        echo "Güncelleme hatası: " . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çalışan Güncelleme Formu</title>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
       
        body {
            padding-top: 56px; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @media (min-width: 768px) {
            body {
                padding-top: 0;
            }

            #sidebar {
                position: fixed;
                height: 100%;
                width: 250px;
                margin-top: 56px; 
            }

            #content {
                margin-left: 250px; 
            }
        }
        .container-fluid {
            margin-top: 80px; 
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            margin-top: 20px;
        }

        label,
        input {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <h2>Çalışan Güncelleme Formu</h2>
    <form action="" method="post">
        <label for="eskiAd">Eski Ad:</label>
        <input type="text" name="eskiAd" required><br>
        
        <label for="eskiSoyad">Eski Soyad:</label>
        <input type="text" name="eskiSoyad" required><br>
        
        <label for="yeniAd">Yeni Ad:</label>
        <input type="text" name="yeniAd" required><br>
        
        <label for="yeniSoyad">Yeni Soyad:</label>
        <input type="text" name="yeniSoyad" required><br>

        <button type="submit">Güncelle</button>
    </form>
</body>

</html>
