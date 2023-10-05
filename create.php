<?php
require_once 'clases/ControladorSesion.php';
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $cs = new ControladorSesion();
    $result = $cs->create($_POST['usuario'], $_POST['clave'], $_POST['nombre'], 
                          $_POST['apellido'], $_POST['email'], );
    if( $result[0] === true ) {
        $redirigir = 'index.php?mensaje='.$result[1];
    } else {
        $redirigir = 'create.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?><!DOCTYPE html> 
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bienvenido al sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/menu.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body style="height: 100vh;" class="container-sm d-flex flex-column align-items-center justify-content-center">
    <div> 
        <div class="jumbotron text-center">
            <h1>LISTA INGREDIENTES</h1>
        </div>
        <div class="text-center">
            <h3>Crear nuevo usuario</h3>
            <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>

            <form action="create.php" method="post">
                <input name="usuario" class="form-control form-control-sm borde" placeholder="Usuario"><br>
                <input name="clave" type="password" class="form-control form-control-sm borde"
                    placeholder="Contraseña"><br>
                <input name="nombre" class="form-control form-control-sm borde" placeholder="Nombre"><br>
                <input name="apellido" class="form-control form-control-sm borde" placeholder="Apellido"><br>
                <input name="email" type="email" placeholder="Email" class="form-control form-control-sm mb-5 borde">
                <input type="submit" value="Registrarse" class="btn btn-light">
            </form>
        </div>
    </div>

</body>

</html>
