<?php 
// include_once("php/sesion.php");
// $sess = new sesion();
// session_set_save_handler($sess, false);
// session_start();

// $_SESSION['prueba']=1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="menu">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <img src="img/cerveza.png" alt="Icono" style="height: 2%; width: 2%;">
                <a class="navbar-brand" href="index.php" style="padding-left: 10px;">Cerveceria Carlos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link disabled" href="#">En desarrollo</a>
                        <a class="nav-link disabled" href="#">En desarrollo</a>
                        <a class="nav-link disabled" href="#">En desarrollo</a>        
                    </div>
                </div>
                <a class="nav-link active" href="login.html">Iniciar Sesion</a>
            </div>
        </nav>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>