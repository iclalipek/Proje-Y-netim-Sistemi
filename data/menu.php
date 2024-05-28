<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proje Yönetim Sistemi</title>

   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
      
        body {
            padding-top: 70px; 
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

        #login-form {
            width: 300px;
            margin: 50px auto 0; 
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            margin-bottom: 10px;
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
        }

        button:hover {
            background-color: #2980b9;
        }

        #error-message {
            color: red;
            margin-top: 10px;
        }

        
        #login-form label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        #login-form form {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Proje Yönetim Sistemi</a>
        </nav>
    </div>
</div>

<div id="login-form">
    <form id="form" onsubmit="return validateForm();" method="post" action="proje/giris.php">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Şifre:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Giriş</button>
    </form>

    <div id="error-message"></div>
</div>

<script>
    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var errorMessage = document.getElementById("error-message");

        if (username === "" || password === "") {
            errorMessage.innerHTML = "Kullanıcı adı ve şifre boş bırakılamaz!";
            return false;
        } else {
            errorMessage.innerHTML = "";
            return true;
        }
    }
</script>

</body>

</html>
