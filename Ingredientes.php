<?php
require_once 'clases/RepositorioIngredientes.php';
require_once 'clases/usuario.php';
session_start();
$usuario = unserialize($_SESSION['usuario']);
$ID_Usuario = $usuario->getid();
if (isset($_POST['id']) && isset($_POST['unidadDeMedida']) && isset($_POST['precio']) && isset($_POST['nombre'])) {
  $ri = new RepositorioIngredientes();
  $result = $ri->RecuperarIngrediente($_POST['id'] );
    if( $result == 1 ) {
      $ri = new RepositorioIngredientes();
        $result = $ri->ActualizarIngrediente($_POST['unidadDeMedida'], $_POST['precio'], $_POST['nombre'], $_POST['id'], $ID_Usuario);
        if( $result === true ) {
            $redirigir = 'ingredientes.php';
        } else {
            $redirigir = 'ingredientes.php';
        }
        header('Location: ' . $redirigir);
    }
}else{
if (isset($_POST['unidadDeMedida']) && isset($_POST['precio']) && isset($_POST['nombre']) && isset($_POST['icono']) ) {
  $ri = new RepositorioIngredientes();
  $result = $ri->InsertarIngrediente($_POST['nombre'], $_POST['unidadDeMedida'], $_POST['precio'], $_POST['icono'], $ID_Usuario);
  if( $result === true ) {
      $redirigir = 'ingredientes.php';
  } else {
      $redirigir = 'ingredientes.php';
  }
  header('Location: ' . $redirigir);
}
}
if (isset($_POST['eliminar']) && isset($_POST['id'])) {
$ri = new RepositorioIngredientes();
  $result = $ri->EliminarIngrediente($_POST['id']);
  if( $result === true ) {
      $redirigir = 'ingredientes.php';
  } else {
      $redirigir = 'ingredientes.php';
  }
  header('Location: ' . $redirigir);
}
  $ri = new RepositorioIngredientes();
  $resultadoBarato = $ri->RecuperarIngredienteBarato();
  strlen($resultadoBarato['nombre']) > 0 ? $barato = $resultadoBarato['nombre'] : $barato = '';
  $ri = new RepositorioIngredientes();
  $resultadoCaro = $ri->RecuperarIngredienteCaro();
  strlen($resultadoCaro['nombre']) > 0 ? $caro = $resultadoCaro['nombre'] : $caro = '';
  $ri = new RepositorioIngredientes();
  $resultadoTotal = $ri->RecuperarIngredientesTotal();
  strlen(reset($resultadoTotal)) > 0 ? $total = reset($resultadoTotal) : $total = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/menu.css">
  <title>CalcuMedor</title>
</head>
<body id="cuerpo">
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
  <div class="container mx-auto flex justify-center align-center flex-col rounded my-100 shadow-md bg-gray-50">
    <div class="container flex flex-col items-center">
        <h1 class="my-4 text-zinc-600 text-3xl font-bold text-center font-extralight">
          Configuracion ingredientes
        </h1>
        <div class="flex flex-col justify-center w-58 shadow-md m-5 hover:scale-110 bg-white space-y-15 border rounded">
          <div class="text-center text-zinc-600 text-3xl font-bold text-center font-extralight">
          <h2 id="btnDatosUtiles" class=" px-4 py-1 text-sm font-semibold bg-gray-100  border border-black-200 focus:outline-none" type="submit" value="">Datos Utiles</h2>
          </div>
          <div class="w-full flex flex-col space-around m-2">
          <p class="datosUtiles text-zinc-600 ">El ingrediente mas caro es: <span class="font-bold"><?php echo isset($caro) ? $caro : ''; ?></span></p>
          <p class="datosUtiles text-zinc-600 ">El ingrediente mas barato es: <span class="font-bold"><?php echo isset($barato) ? $barato : ''; ?></span></p>
          <p class="datosUtiles text-zinc-600 ">La suma de los ingredientes es: <span class="font-bold">$<?php echo isset($total) ? $total : ''; ?></span></p>
          </div>
        </div>
    </div>
    <div id="divNuevoIngrediente" class="flex flex-col lg:w-full align-center justify-center items-center">
      <div  class="flex flex-col align-center justify-center">
      <button id="nuevoIngrediente" type="submit" class="m-1 px-4 py-1 text-sm font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none" onclick="">Nuevo Ingrediente</button>
      </div>
        <form id="formNuevoIngrediente" class="hidden" action="ingredientes.php" method="post">
          <div id=""
            class="recetas flex flex-col items-center justify-center w-58 text-center rounded shadow-md m-5 hover:scale-105 bg-white  space-y-15">
            <div class="flex flex-row items-center">
              <div>
                <picture
                  class="flex row justify-center m-2 border border-solid border-black p-1 hover:bg-gray-400 hover:text-white hover:cursor-pointer">
                  <img id="iconoSeleccionado" src="" value="asd" class="w-8 hidden" alt="" NAME="icono"><input
                    id="inputIcono" type="hidden" value="" name="icono">
                  <h5 id="iconoNuevo">imagen</h5>
                </picture>
                <ul id="listaIconos" class="hidden flex">
                  <li><img src="./assets/images/cup.png" NAME="cup.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                  <li><img src="./assets/images/pan.png" NAME="pan.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                  <li><img src="./assets/images/ddl.png" NAME="ddl.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                  <li><img src="./assets/images/factura.png" NAME="factura.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                  <li><img src="./assets/images/leche.png" NAME="leche.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                  <li><img src="./assets/images/alfajor.png" NAME="alfajor.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                  <li><img src="./assets/images/jugo.png" NAME="jugo.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                  <li><img src="./assets/images/galletitas.png" NAME="galletitas.png"
                      class="w-8 hover:border border-solid border-black p-1 iconoLista"></li>
                </ul>
              </div>
              <h2 class="text-s mx-2"><input value="" name="nombre"
                  class="w-3/4 h-5 border border-transparent border-b-black focus:outline-none text-xs text-center ml-2"
                  placeholder="Nombre" maxlength="25" autocomplete="nope"></input></h2>
            </div>
            <div class="flex flex-row items-center">
              <div class="flex flex-col justify-center items-center">
                <div class="flex text-start">
                  <div class="w-2/4 text-start pl-1 flex flex-col"><label class="text-s" for="cantidad">Unidad de
                      Medida</label><label class="text-s" for="precio">Precio</label></div>
                  <div class="text-center w-2/4"><input id="unidadDeMedidaNuevo" value="" name="unidadDeMedida"
                      type="text"
                      class="w-3/4 h-5 border border-transparent border-b-black focus:outline-none text-xs text-center ml-2"
                      placeholder="Unidad de Medida"  maxlength="25" autocomplete="nope"><br><span>$</span><input id="precioNuevo" value="" name="precio"
                      type="number"
                      class="w-3/4 h-5 border border-solid border-transparent border-b-black focus:outline-none text-xs text-center"
                      placeholder="Precio" autocomplete="nope"></div>
                </div>
                <div class="flex flex-row my-3"><button id="btnGuardarNuevo" type="submit"
                    class="m-1 px-4 py-1 text-xs font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none w-20"
                    value="">Guardar</button></div>
              </div>
            </div>
          </div>
        </form>
    </div>
    <div class="flex justify-center items-center flex-wrap flex-col lg:flex-row">
    <?php
    require_once 'clases/RepositorioIngredientes.php';
    $arrIngredientes = array();
    $ri = new RepositorioIngredientes();
    $arrIngredientes = $ri->RecuperarIngredientes();
    foreach ($arrIngredientes as $value) {
      echo '
    <form id="formIngrediente'.$value['id'].'" action="ingredientes.php" method="post">
    <div id="'.$value['id'].'" class="recetas flex flex-col items-center justify-center w-58 text-center rounded shadow-md m-5 hover:scale-110 bg-white space-y-15">
    <div id="eliminar'.$value['id'].'"></div>
    <span class="w-full flex justify-end"><img id="'.$value['id'].'" class="eliminarIngrediente" src="./assets/images/x.png"></span>
    <input type="hidden" value="'.$value['id'].'" name="id">
    <div class="flex flex-row items-center justify-center align-center w-full">
      <div clas="w-1/4">
        <picture class="flex row justify-center m-2">
          <img src="./assets/images/'.$value['icono'].'" class="w-8" alt="'.$value['nombre'].'">
        </picture>
      </div>
      <div class="w-3/4">
      <h2 class="text-s mx-2 ">
        <input id="'.$value['nombre'].'" class="w-full text-center" value="'.$value['nombre'].'" name="nombre" disabled  maxlength="25" autocomplete="nope"></input>
      </h2>
      </div>
    </div>
    <div class="flex flex-row items-center">
      <div class="flex flex-col justify-center items-center">
        <div class="flex text-start">
          <div class="w-2/4 text-start pl-1 flex flex-col"> 
            <label class="text-s" for="cantidad">Unidad de Medida</label>
            <label class="text-s" for="precio">Precio</label>
          </div>
          <div class="text-center w-2/4">
            <input id="cantidad'.$value['nombre'].'" value="'.$value['unidadDeMedida'].'" name="unidadDeMedida" type="text" class="w-3/4 h-5 border border-transparent border-b-black focus:outline-none text-xs text-center ml-2" disabled maxlength="25" autocomplete="nope"><br>
            <span>$</span><input id="precio'.$value['nombre'].'" value="'.$value['precio'].'" name="precio" type="number" class="w-3/4 h-5 border border-solid border-transparent border-b-black focus:outline-none text-xs text-center" disabled> 
          </div>
        </div>
        <div class="flex flex-row my-3">
              <button id="'.$value['nombre'].'" type="reset" class="btnEditar m-1 px-4 py-1 text-xs font-semibold bg-gray-100 rounded border border-black-200 hover:text-white pointer hover:bg-gray-400 focus:outline-none w-20">Editar</button>
              <button id="btnGuardar" type="submit" class="btnGuardar m-1 px-4 py-1 text-xs font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none w-20" value="Guardar">Guardar</button>
            </div>
      </div>
    </div>
  </div>
  </form>
  ';
    }
  ?>
  </div>
  <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
  <script src="./assets/js/ingredientes.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>