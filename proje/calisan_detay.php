
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çalışan Detayları</title>
    
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proje_kontrol_sistemi";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

$calisanId = $_GET['calisanId'];
$sql = "SELECT * FROM gorev WHERE calisan_id = $calisanId";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    echo "<h2>Çalışanın Görevleri</h2>";
    echo "<table border='1'><tr><th>Görev ID</th><th>Görev Adı</th><th>Başlangıç Tarihi</th><th>Bitiş Tarihi</th><th>Görev Durumu</th><th>Gecikme Tarihi</th><th>Proje ID</th><th>İşlem</th></tr>";
   
    while($row = $result->fetch_assoc()) {
        $projeId = $row["proje_id"];

        $sqlProje = "SELECT * FROM proje WHERE proje_id = $projeId";
        $resultProje = $conn->query($sqlProje);
        


        if ($resultProje->num_rows > 0) {
            $proje = $resultProje->fetch_assoc();
            $gecikme_tarihi = ($proje['proje_gec_tarih'] !== NULL && $proje['p_bit_tarih'] < date('Y-m-d')) ? date('Y-m-d', strtotime($proje['p_bit_tarih'] . ' + 15 days')) : NULL;

           
            echo "<tr>
                    <td>" . $row["gorev_id"]. "</td>
                    <td>" . $row["gorev_aciklamasi"]. "</td>
                    <td>" . $row["gorev_bas_tarih"]. "</td>
                    <td>" . $row["gorev_bit_tarih"]. "</td>
                    <td>" . $row["gorev_durumu"]. "</td>
                    <td>" . $gecikme_tarihi . "</td>
                    <td>" . $row["proje_id"]. "</td>
                    <td>
                        <form action='' method='post'>
                            <label for='newStatus'>Yeni Görev Durumu:</label>
                            <select name='newStatus'>
                                <option value='Tamamlandı'>Tamamlandı</option>
                                <option value='Devam Ediyor'>Devam Ediyor</option>
                                <option value='Tamamlanmadı'>Tamamlanmadı</option>
                            </select>
                            <input type='hidden' name='calisanId' value='$calisanId'>
                            <input type='hidden' name='gorevId' value='" . $row["gorev_id"] . "'>
                            <button type='submit'>Durumu Güncelle</button>
                        </form>
                    </td>
                </tr>";
                
            }
        }

            

    echo "</table>";
}
else {
    echo "Bu çalışana ait görev bulunamadı.";
}

$sqlTamamlanan = "SELECT COUNT(*) as tamamlananGorevSayisi FROM gorev WHERE calisan_id = $calisanId AND gorev_durumu = 'Tamamlandı'";
$resultTamamlanan = $conn->query($sqlTamamlanan);


$sqlDevamEden = "SELECT COUNT(*) as devamEdenGorevSayisi FROM gorev WHERE calisan_id = $calisanId AND gorev_durumu = 'Devam_ediyor'";
$resultDevamEden = $conn->query($sqlDevamEden);


$sqlTamamlanmayan = "SELECT COUNT(*) as tamamlanmayanGorevSayisi FROM gorev WHERE calisan_id = $calisanId AND gorev_durumu = 'Tamamlanmadı'";
$resultTamamlanmayan = $conn->query($sqlTamamlanmayan);


if ($resultTamamlanan->num_rows > 0) {
    $rowTamamlanan = $resultTamamlanan->fetch_assoc();
    $tamamlananGorevSayisi = $rowTamamlanan["tamamlananGorevSayisi"];
} else {
    $tamamlananGorevSayisi = 0;
}


if ($resultDevamEden->num_rows > 0) {
    $rowDevamEden = $resultDevamEden->fetch_assoc();
    $devamEdenGorevSayisi = $rowDevamEden["devamEdenGorevSayisi"];
} else {
    $devamEdenGorevSayisi = 0;
}


if ($resultTamamlanmayan->num_rows > 0) {
    $rowTamamlanmayan = $resultTamamlanmayan->fetch_assoc();
    $tamamlanmayanGorevSayisi = $rowTamamlanmayan["tamamlanmayanGorevSayisi"];
} else {
    $tamamlanmayanGorevSayisi = 0;
}


echo "<h3>Çalışanın Görev Sayıları</h3>";
echo "<p>Toplam " . ($tamamlananGorevSayisi + $devamEdenGorevSayisi + $tamamlanmayanGorevSayisi) . " görevi bulunmaktadır.</p>";
echo "<ul>";
echo "<li>Tamamlanan Görevler: $tamamlananGorevSayisi</li>";
echo "<li>Devam Eden Görevler: $devamEdenGorevSayisi</li>";
echo "<li>Tamamlanmayan Görevler: $tamamlanmayanGorevSayisi</li>";
echo "</ul>";





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $calisanId = $_POST["calisanId"];
    $gorevId = $_POST["gorevId"];
    $newStatus = $_POST["newStatus"];

    $updateSql = "UPDATE gorev SET gorev_durumu = '$newStatus' WHERE gorev_id = $gorevId";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "Görev durumu başarıyla güncellendi.";
    } else {
        echo "Hata: " . $conn->error;
    }
}

$conn->close();
?>






</body>
</html>