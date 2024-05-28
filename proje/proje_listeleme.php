<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeler</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f4f4f4;
        }

        h2, h3 {
            color: #3498db;
        }

        table {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
            overflow-x: auto;
            position: relative;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
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
            margin-bottom: 10px; 
            position: absolute;
            bottom: -50px; 
            left: 0; 
        }

        button:hover {
            background-color: #2980b9;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .project-details {
            display: none;
            margin-top: 20px;
        }

        
        a {
            color: black;
            text-decoration: none;
        }

        a:hover {
            color: blue;
        }
    </style>
    
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "proje_kontrol_sistemi";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$sqlProject = "SELECT proje.*, IF(gorev.gorev_durumu = 'Tamamlanmadı', 'Tamamlandı', 'Devam Ediyor') AS proje_gorev_durumu,
              CASE WHEN gorev.gorev_durumu != 'Tamamlandı' AND proje.p_bit_tarih < CURRENT_DATE THEN DATEDIFF(CURRENT_DATE, proje.p_bit_tarih) ELSE NULL END AS gecikme_gun
              FROM proje
              LEFT JOIN gorev ON proje.proje_id = gorev.proje_id
              GROUP BY proje.proje_id";
$resultProject = $conn->query($sqlProject);



if ($resultProject->num_rows > 0) {
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Proje ID</th>
                    <th>Proje Adı</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                    <th>Proje Gecikme Tarihi</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $resultProject->fetch_assoc()) {
        $gecikme_tarihi = ($row['proje_gec_tarih'] !== NULL) ? $row['proje_gec_tarih'] : null;

        
        if ($row['p_bit_tarih'] < date('Y-m-d') && $row['proje_gorev_durumu'] !== 'Tamamlandı') {
            
            $gecikme_tarihi = date('Y-m-d', strtotime($row['p_bit_tarih'] . ' + 15 days'));

           
            $proje_id = $row['proje_id'];
            $sqlUpdate = "UPDATE proje SET proje_gec_tarih = '$gecikme_tarihi' WHERE proje_id = $proje_id";
            $conn->query($sqlUpdate);
        }

        echo "<tr>
                <td>{$row['proje_id']}</td>
                <td><a href='gorev_ekle.php?proje_id={$row['proje_id']}'>{$row['proje_adi']}</a></td>
                <td>{$row['p_bas_tarih']}</td>
                <td>{$row['p_bit_tarih']}</td>
                <td>{$gecikme_tarihi}</td>
            </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Hiç proje bulunamadı.";
}

$conn->close();
?>
</body>
</html>