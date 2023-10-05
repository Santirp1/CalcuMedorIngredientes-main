<?php

require_once 'clases/RepositorioRecetas.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./assets/css/menu.css">
  <title>CalcuMedor</title>
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
  <div class="container mx-auto flex justify-center align-center flex-col rounded my-100 shadow-md bg-gray-50">
    <div class="container flex flex-col items-center">
        <h1 class="my-4 text-zinc-600 text-3xl font-bold text-center font-extralight">
          Ingresa la cantidad de comensales
        </h1>
        <label for="cars">Selecciona la receta</label>
            <select name="recetas" id="recetas" onchange="cambiarReceta()">
              <option id="1" value="receta1">Receta1</option>
              <option id="2" value="receta2">Receta2</option>
              <option value="receta3">Receta3</option>
              <option value="receta4">Receta4</option>
              <?php
              $rr = new RepositorioRecetas();
          $arrRecetas = array();
          $arrRecetas = $rr->recuperarRecetas();
          if (strLen($arrRecetas[1]) > 0) {
            $mensaje = $arrRecetas[1];
            echo $mensaje;
                }else{  
                  foreach ($arrRecetas[0] as $value) {
                    echo '<option id="'.$value['id'].'" value="'.$value['nombre'].'">'.$value['nombre'].'</option>';
                  }
                }
                ?>
            </select>
        <div class="flex w-1/2 justify-center">
          <input id="intCantidadComensales" type="text" class="w-20 text-center mr-2 border border-black-200">
          <div class="border bg-white p-1 hover:cursor-pointer" id="btnCalcular" onclick="Calcular()">
            <span>Calcular</span>
          </div>
        </div>
    </div>
    <div id="resultado" class="flex justify-center items-center flex-wrap flex-row">
  <script src="./assets/js/recetas.js"></script>
  <!-- <script src="cambiarReceta.js"></script> -->
</body>
</html>