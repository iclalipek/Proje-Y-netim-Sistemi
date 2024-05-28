<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proje Yönetim Sistemi</title>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        
        body {
            padding-top: 56px; 
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
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <a class="navbar-brand" href="#">Proje Yönetim Sistemi</a>
            </nav>

            
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                       
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/ProjeYonetimSistemi/proje/proje_listeleme.php">
                                Proje Listele
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/ProjeYonetimSistemi/proje/calisan_listeleme.php">
                                Çalışan Listele
                            </a>
                        </li>
                        
                        
                    </ul>
                </div>
            </nav>

            
            <main role="main" id="content" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                
                <div class="container mt-4">
                    
                </div>
            </main>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
