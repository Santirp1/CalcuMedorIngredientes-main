
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Modificacion de datos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/menu.css">
    </head>
    <body style="height: 100vh;">
    <div class="header"></div>
 <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
 <label for="openSidebarMenu" class="sidebarIconToggle">
   <div class="spinner diagonal part-1"></div>
   <div class="spinner horizontal"></div>
   <div class="spinner diagonal part-2"></div>
 </label>
 <div id="sidebarMenu">
   <ul class="sidebarMenuInner">
      <li><a href="menu.php">Menu</a></li>
      <li><a href="CalcularCantidades.php">Calculador</a></li>
      <li><a href="ArmarRecetas.php">Armar Receta</a></li>
      <li><a href="ingredientes.php">Ingredientes</a></li>
      <li><a href="modificarDatos.php">Modificar Datos</a></li>
      <li><a href="index.php">Cerrar Sesion</a></li>
   </ul>
 </div>
    <div class="container-sm d-flex flex-column align-items-center justify-content-center mt-5">
      <div class="jumbotron text-center">
      <h1>Datos de Usuario</h1>
      </div>    
      <div class="text-center">
        <h3>Modifica tus datos</h3>
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
        <?php
        require_once 'clases/usuario.php';
        session_start();
        $usuario = unserialize($_SESSION['usuario']);
        $nombreUsuario = $usuario->getUsuario();
        $nombre = $usuario->getNombre();
        $apellido = $usuario->getApellido();
        $email = $usuario->getEmail();
        echo '<form action="update.php" method="post">';
        echo '<label>Nombre de Usuario</label>';
        echo '<input name="usuario" class="form-control form-control-sm borde" placeholder="Usuario" value='.$nombreUsuario.'><br>';
        echo '<label>Nombre</label>';
        echo '<input name="nombre" class="form-control form-control-sm borde" placeholder="Nombre" value='.$nombre.'><br>';
        echo '<label>Apellido</label>';
        echo '<input name="apellido" class="form-control form-control-sm borde" placeholder="Apellido" value='.$apellido.'><br>';
        echo '<label>Email</label>';
        echo '<input name="email" type="email" placeholder="Email" class="form-control form-control-sm borde mb-5" value='.$email.'>';
        echo '<input type="submit" value="Aceptar Cambios" class="px-4 py-1 text-sm font-semibold bg-gray-100 rounded border border-black-200 focus:outline-none">';
        echo '</form>';
        ?>
      </div> 
      </div>
    </body>
</html>