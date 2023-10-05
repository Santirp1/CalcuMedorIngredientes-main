<?php
require_once 'clases/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./assets/css/menu.css">
  <title>Menu</title>
</head>
<body>
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
     <li><a href="Recetas.php">Recetas</a></li>
     <li><a href="ingredientes.php">Ingredientes</a></li>
     <li><a href="modificarDatos.php">Modificar Datos</a></li>
     <li><a href="index.php">Cerrar Sesion</a></li>
   </ul>
 </div>
  <main class="bg-gray-50">
    <div class="h-screen w-full flex items-center justify-center">
      <div class="flex flex-col">
      <button class="m-1 px-4 py-1 text-sm font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none text-xl"><a href="CalcularCantidades.php">Calculador</a></button>
      <button class="m-1 px-4 py-1 text-sm font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none text-xl"><a href="ArmarRecetas.php">Armar Receta</a></button>
      <button class="m-1 px-4 py-1 text-sm font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none text-xl"><a href="ingredientes.php">Ingredientes</a></button>
      <button class="m-1 px-4 py-1 text-sm font-semibold bg-gray-100 rounded border border-black-200 hover:text-white hover:bg-gray-400 focus:outline-none text-xl"><a href="modificarDatos.php">Modificar Datos Usuario</a></button>
      </div>
    </div>
  </main>
</body>
</html>