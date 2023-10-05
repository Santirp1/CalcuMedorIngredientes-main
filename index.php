<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/menu.css">

  <title>Lista Ingredientes</title>
</head>

<body>
  <main style="height: 100vh;" class="container-sm d-flex flex-column align-items-center justify-content-center">
  <form action="login.php" method="post">
    <div style="height: 30vh;"
      class="container-sm h d-flex flex-column mb-5 rounded-3 border border-white text-center align-items-center justify-content-around">
      <h2 class="text-black-50">INICIA SESION</h2>
      <div>
        <div class="col-auto">
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-dark text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
          <label for="inputPassword2" class="visually-hidden">Usuario</label>
          <input name="usuario" type="text" class="form-control borde" id="inputPassword2" placeholder="Usuario">
        </div>
        <div class="col-auto mt-3">
          <label for="inputPassword2" class="visually-hidden">Contrasena</label>
          <input name="clave" type="password" class="form-control borde" id="inputPassword2" placeholder="Contrasena">
        </div>
      </div>
      <div class="d-flex flex-column mt-5">
      <input type="submit" class="btn btn-light border" value="Iniciar Sesion"></input>
      <button type="button" class="btn btn-light border mt-3"><a href="create.php">Registrarse</a></button>
      </div>
    </div>
    </form>
  </main>
  </script>
</body>
</html>