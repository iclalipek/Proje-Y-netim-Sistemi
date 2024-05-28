<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev Ekle</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f4f4f4;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: calc(100% - 20px);
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <form action="gorev_ekle.php" method="post">
        <h2>Görev Ekle</h2>
       
        <input type="hidden" id="proje_id" name="proje_id" value="<?php echo isset($_GET['proje_id']) ? $_GET['proje_id'] : ''; ?>">

        <label for="gorev_bas_tarih">Başlangıç Tarihi:</label>
        <input type="date" id="gorev_bas_tarih" name="gorev_bas_tarih" required>

        <label for="gorev_bit_tarih">Bitiş Tarihi:</label>
        <input type="date" id="gorev_bit_tarih" name="gorev_bit_tarih" required>

        <label for="adam_gun_degeri">Adam Gün Değeri:</label>
        <input type="text" id="adam_gun_degeri" name="adam_gun_degeri" required>

        <label for="gorev_aciklamasi">Görev Açıklaması:</label>
        <textarea id="gorev_aciklamasi" name="gorev_aciklamasi" rows="4" required></textarea>
        
        <label for="gorev_durumu">Görev Durumu:</label>
        <select id="gorev_durumu" name="gorev_durumu" required>
            <option value="tamamlandi">Tamamlandı</option>
            <option value="tamamlanmadi">Tamamlanmadı</option>
            <option value="devam_ediyor">Devam Ediyor</option>
        </select>

        <label for="calisan_id">Çalışan ID:</label>
        <input type="text" id="calisan_id" name="calisan_id" required>

        <button type="submit">Görev Ekle</button>
    </form>

</body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proje_kontrol_sistemi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gorev_bas_tarih = $_POST['gorev_bas_tarih'];
    $gorev_bit_tarih = $_POST['gorev_bit_tarih'];
    $adam_gun_degeri = $_POST['adam_gun_degeri'];
    $gorev_aciklamasi = $_POST['gorev_aciklamasi'];
    $proje_id = $_POST['proje_id'];
    $calisan_id = $_POST['calisan_id'];
    $gorev_durumu = $_POST['gorev_durumu'];

    $sql = "INSERT INTO gorev (gorev_bas_tarih, gorev_bit_tarih, adam_gun_degeri, gorev_aciklamasi, proje_id, calisan_id, gorev_durumu)
            VALUES ('$gorev_bas_tarih', '$gorev_bit_tarih', '$adam_gun_degeri', '$gorev_aciklamasi', '$proje_id', '$calisan_id', '$gorev_durumu')";

    if ($conn->query($sql) === TRUE) {
        echo "Görev eklendi.";
    } else {
        echo "Hata: " . $conn->error;
    }
}

$conn->close();
?>

</html>