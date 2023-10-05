<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="./assets/css/menu.css">
  <title>Document</title>
</head>

<body>
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
  <h1 class="my-4 text-zinc-600 text-3xl font-bold text-center font-extralight">
    Arma tus recetas
  </h1>
  <h2 id="resultado"></h2>
  <form id="formNuevoIngrediente" class="" action="ingredientes.php" method="post">
    <div id="" class="recetas flex flex-col items-center justify-center w-58 text-center rounded shadow-md m-5 hover:scale-105 bg-white  space-y-15">
      <div class="flex flex-row items-center">
        <h2 class="text-s mx-2"><input id="nombreRecetaNueva" value="" name="nombre" class="w-3/4 h-5 border border-transparent border-b-black focus:outline-none text-xs text-center ml-2" placeholder="Nombre"></input></h2>
      </div>
      <div class="mt-2">
        <textarea id="descripcionReceta" class="text-xs border resize-none rounded-md text-center" name="" id="" cols="25" rows="4" placeholder="Descripcion"></textarea>
      </div>
    </div>
  </form>
  <div class="flex flex-wrap justify-center shadow-md mb-10 m-2">
    <?php
    require_once 'clases/RepositorioIngredientes.php';
    $arrIngredientes = array();
    $ri = new RepositorioIngredientes();
    $arrIngredientes = $ri->RecuperarIngredientes();
    foreach ($arrIngredientes as $value) {
      echo '
      <div id="' . $value['id'] . '" class="ingredientes">
      <div class="flex flex-col items-center justify-center text-center m-2 rounded shadow-md hover:scale-110 bg-white space-y-15 w-16">
        <div id="eliminar' . $value['id'] . '"></div>
        <span class="w-full flex justify-end"><img id="eliminarIngredienteAgregado" class="eliminarIngrediente w-3" src="./assets/images/x.png"></span>
        <input type="hidden" value="' . $value['id'] . '" name="id">
        <div class="flex flex-row items-center justify-center align-center w-full">
          <div class="flex flex-col items-center justify-center align-center">
            <div clas="">
              <picture class="flex row justify-center">
                <img src="./assets/images/' . $value['icono'] . '" class="w-8" alt="' . $value['nombre'] . '">
              </picture>
            </div>
            <div class="flex">
            <h2 class="text-xs">
              <input id="' . $value['nombre'] . '" class="w-full text-center text-xs" value="' . $value['nombre'] . '" name="nombre" disabled></input>
              <input id="cantidad' . $value['id'] . '" class="w-full text-center text-xs border hidden" value="" name="cantidad"></input>
            </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  ';
    }
    ?>


  </div>
  <!-- agregar mas -->
  </div>
  <!--RECETA NUEVA-->

  <form action="" method="">
    <div class="flex flex-col shadow-md m-3">
      <!--INGREDIENTES-->
      <div id="recetaNueva" class="flex flex-row flex-wrap align-center justify-center">

      </div>
      <!--INGREDIENTES-->
      <!--BOTONES-->
      <div class="flex flex-row w-full justify-center">
      <!-- <input id="btnAgregarCantidad" type="button" class="btnGuardar m-1 px-4 py-1 text-xs font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none w-20" onclick="habilitarInputsCantidades()">Agregar Cantidades</input> -->
        <button id="btnGuardar" type="" class="btnGuardar m-1 px-4 py-1 text-xs font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none w-20" value="Guardar"
        onclick="guardarReceta()">Guardar</button>
      </div>
      <!--BOTONES-->
    </div>
  </form>

  <!--RECETA NUEVA-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="cardRecetas.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>