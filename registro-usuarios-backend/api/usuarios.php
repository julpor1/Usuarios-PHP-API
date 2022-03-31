<?php 
include_once ('../class/class-usuario.php');
// echo "Metodo HTTP: ".$_SERVER['REQUEST_METHOD'];
//Recibir peticiones del usuario

// echo 'Informacion:'.file_get_contents('php://input'); 

//Asignarle un formato json a los encabezados, para que no los tome como text

header('Content-Type: application/json');

switch($_SERVER['REQUEST_METHOD']){

     case 'POST':
        $_POST = json_decode(file_get_contents('php://input'),true);
        $usuario = new Usuario($_POST['nombre'],$_POST['apellido'],$_POST['fechaNacimiento'],$_POST['pais']);
        $usuario->guardarUsuario();
        $repuesta['mensaje'] = "Guardar usuario, informacion:".json_encode($_POST);
        echo json_encode($repuesta);
        // echo "Guardar el usuario " .$_POST['nombre']; 

     break;

     case 'GET':
        // echo "Obtener usuario/s";
        if(isset($_GET['id'])){
         Usuario::obtenerUsuario($_GET['id']); 
        }else{
         Usuario::obtenerUsuarios();
        }
        break;

     case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'),true);
        $usuario = new Usuario($_PUT['nombre'],$_PUT['apellido'],$_PUT['fechaNacimiento'],$_PUT['pais']);
        $usuario->actualizarUsuario($_GET['id']);
        $repuesta['mensaje'] = "Actualizar un usuario con el id:".$_GET['id']."Informacion a actualizar :".json_encode($_PUT);
        echo json_encode($repuesta);
        break;
     
     case 'DELETE':
        Usuario::eliminarUsuario($_GET['id']);
        break;
}

//Crear

//Obtener un usuario

//Obtener todos los usuarios

//Actualizar un usuario

//Eliminar un usuario

?>