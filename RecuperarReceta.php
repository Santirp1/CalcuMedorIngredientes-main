<?php

require_once 'clases/RepositorioRecetas.php';
// $resultado = $_POST['idReceta']; 
if(isset($_POST["idReceta"]))
{
$resultado = $_POST['idReceta'];
$rr = new RepositorioRecetas();
$arrRecetas = array();
$arrRecetas = $rr->recuperarReceta($resultado);
if (strLen($arrRecetas[1]) > 0) {
  $mensaje = $arrRecetas[1];
  echo $mensaje;
}else{
  foreach ($arrRecetas[0] as $value) {
    echo '<div id="'.$value['nombre'].'" class="w-32 h-40 text-center rounded shadow-md m-2 hover:scale-105 bg-white space-y-15">
    <picture class="flex justify-center my-3">
      <img src="./assets/images/'.$value['icono'].'" alt="Taza">
    </picture>
    <h2 class="">
      '.$value['ingrediente'].' ('.$value['unidadDeMedida'].')
    </h2>
    <span class="hidden cantidadIngrediente" id="intCantidad'.$value['ingrediente'].'">'.$value['cantidad'].'</span>
    <span id="'.$value['ingrediente'].'" class="my-2 totalIngrediente">0</span>
  </div>';
  }
}

}
?>