<?php
class Usuario {
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $pais;
    
    public function __construct($nombre,$apellido,$fechaNacimiento,$pais)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->pais = $pais;
    }

    //Get the value of nombre

    public function getNombre(){
        return $this->nombre;
    }

    //Get the value of pais

    public function getPais(){
        return $this->pais;
    }
  
    public function setpais($pais){
        $this->pais = $pais;
        return $this;
    }

     
    //CRUD 
    public function guardarUsuario(){
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo,true);

        $usuarios[] = array(
            "usuario" => $this->nombre,
            "apellido" => $this->apellido,
            "fechaNacimiento" => $this->fechaNacimiento,
            "pais" => $this->pais
        );
        //fopen abre un fichero o un URL Y "W" me permite la apertura para sólo escritura
        $archivo = fopen("../../data/usuarios.json","w");
        fwrite($archivo,json_encode($usuarios));
        fclose($archivo);
    }

   public static function obtenerUsuarios(){
     $contenidoArchivo = file_get_contents("../../data/usuarios.json");
     echo $contenidoArchivo;
    }

    public static function obtenerUsuario($indice){
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo,true);
        echo json_encode($usuarios[$indice]);

       }

    public function actualizarUsuario($indice){
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo,true);
        // $usuario = $usuarios[$indice];
        $usuario = array(
            'usuario' => $this->nombre,
            'apellido' =>  $this->apellido,
            'fechaNacimiento' =>  $this->fechaNacimiento,
            'pais' =>  $this->pais
        );
        $usuarios[$indice] = $usuario;
        $archivo = fopen("../../data/usuarios.json","w");
        fwrite($archivo,json_encode( $usuarios));
        fclose($archivo);

    }

    public static function eliminarUsuario($indice){
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo,true);
        //array_splice() Elimina una porción del array y la reemplaza con otra cosa
        array_splice($usuarios,$indice,1);
        $archivo = fopen("../../data/usuarios.json","w");
        fwrite($archivo,json_encode( $usuarios));
        fclose($archivo);

    }

}

?>