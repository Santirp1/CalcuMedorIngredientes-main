<?php
require_once 'clases/ControladorSesion.php';
if (isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])) {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    if (strlen($usuario) < 1 or strlen($nombre) < 1 or $apellido === '' or $email === '') {
        $redirigir = 'modificarDatos.php?mensaje="Faltan completar Datos"';
    }else{
        $cs = new ControladorSesion();
        $result = $cs->update($_POST['usuario'], $_POST['nombre'], 
                              $_POST['apellido'], $_POST['email']);
        if( $result[0] === true ) {
            $redirigir = 'index.php?mensaje='.$result[1];
        } else {
            $redirigir = 'menu.php?mensaje='.$result[1];
        }
        header('Location: ' . $redirigir);
    }
}
?>