<header class="menu">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="/Bootstrap/img/cerveza.png" alt="Icono" style="height: 2%; width: 2%;">
            <a class="navbar-brand" href="index.php" style="padding-left: 10px;">Cerveceria Carlos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <ul class="nav-item"><a class="nav-link disabled" href="#">En desarrollo</a></ul>
                    <ul class="nav-item"><a class="nav-link disabled" href="#">En desarrollo</a></ul>
                    <ul class="nav-item"><a class="nav-link disabled" href="#">En desarrollo</a></ul>
            
                    
                </ul>
            </div>

            <?php if (isset($_COOKIE['email'])): ?>
                <div class="nav-item dropdown my-2 my-lg-0">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        require("conexion.php");
                        $conex = new conexion();
                        $con = $conex->conectar();
                        $email = $_COOKIE['email'];                
                        $sql = "SELECT nombre, imagen FROM usuario where email = ?";
                        $sentencia = $con->prepare($sql);
                        $sentencia->bindParam(1, $email, PDO::PARAM_STR);
                        $sentencia->execute();
                        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
                        if(strcmp($result['imagen'], '') == 0): ?>
                            <img src="/Bootstrap/img/usuario.png" style="width: 10%; height: 10%;">
                        <?php else: ?>
                            <img width="50" src="data:image/jpeg;base64,<?php echo  base64_encode($result['imagen']); ?>">
                        <?php endif;
                        echo($result['nombre'])
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="editar.php">Editar Cuenta</a></li>
                        <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <ul class="nav-item dropdown my-2 my-lg-0">
                    <a class="nav-link active" href="login.php">Iniciar Sesion</a>
                </ul>
            <?php endif ?>
        </div>
    </nav>
</header>