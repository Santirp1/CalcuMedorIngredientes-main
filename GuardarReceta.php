<?php

require_once 'clases/RepositorioRecetas.php';
require_once 'clases/RepositorioIngredientes.php';
// $resultado = $_POST['idReceta']; 
if(isset($_POST["arrIngredientesReceta"]) && isset($_POST["nombreReceta"]) && isset($_POST["descripcionReceta"]))
{
  try {
    $descripcionReceta = $_POST["descripcionReceta"];
    $nombreReceta = $_POST["nombreReceta"];
    $resultado = $_POST['arrIngredientesReceta'];
    $rr = new RepositorioRecetas();
    $ri = new RepositorioIngredientes();
    // $arrIngredientes = array();
    $arrIngredientes = $resultado;
    $ultimoID = $rr->RecuperarUltimoID();
    $nuevoID = $ultimoID['id']+1;
    foreach ($arrIngredientes as $ingrediente => $value) {
      $arrDatosIngrediente = array();
      $arrDatosIngrediente = $ri->RecuperarIngredienteIndividual($value);
      var_dump($arrDatosIngrediente['0']['precio']);
      $arrRecetas = $rr->GrabarReceta($nuevoID, $nombreReceta, $descripcionReceta, $arrDatosIngrediente['0']['nombre'], 1,
      $arrDatosIngrediente['0']['unidadDeMedida'], $arrDatosIngrediente['0']['precio'], $arrDatosIngrediente['0']['icono']);
    }
}catch (Exception $e) {
    echo $e->getMessage();
}finally {
    echo '<script>LlamarAlerta(1)</script>';
}

}

?>