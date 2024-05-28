<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çalışan Listeleme</title>
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
$dbname = "proje_kontrol_sistemi";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}


$sql = "SELECT calisan_id, calisan_adi, calisan_soyadi FROM calisanlar";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Adı</th><th>Soyadı</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["calisan_id"]. "</td>
                <td><a href='calisan_detay.php?calisanId=" . $row["calisan_id"] . "'>" . $row["calisan_adi"]. "</a></td>
                <td>" . $row["calisan_soyadi"]. "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Veritabanında çalışan bulunamadı.";
}


$conn->close();
?>


</body>
</html>