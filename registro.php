<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "identificador.php";

class Alumno{
    private $codigo, $nombre, $apellidos, $telefono, $correo;
    //Constructor
    public function __construct($codigo, $nombre, $apellidos, $telefono, $correo){
        $this->codigo = ($codigo[0])+1;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->correo = $correo;
    }

    //Setters
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    //Getters
    public function getCodigo(){
        return $this->codigo;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function compruebaCorreo($correo){
        $arroba = false;
        $punto = false;
        $comp = false;
        for ($i=0; $i <= strlen($correo) ; $i++) { 
            if(substr($correo, $i, 1)=="@"){
                $arroba =true;
            }
            if(substr($correo, $i, 1)=="."){
                $punto = true;
            }
        }
        if($arroba == true and $punto == true){
            $comp = true;
        }
        return $comp;
    }
}
$mensaje="";
if(isset($_POST['intentos'])){
    $intentos = $_POST['intentos'];
}else{
    $intentos = 1;
}
if(isset($_POST['botonEnviar'])){
    if($_POST['nombre']!=null and $_POST['apellidos']!=null and $_POST['telefono']!=null and $_POST['correo']!=null){
        $alumno = new Alumno($fila, $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['correo']);
        if($alumno->compruebaCorreo($_POST['correo']) == true){
            $intentos=1;
            try {
                $sql = "INSERT INTO alumnos (CODIGO, NOMBRE, APELLIDOS, TELEFONO, CORREO) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $cod = $alumno->getCodigo();
                $nom = $alumno->getNombre();
                $ape = $alumno->getApellidos();
                $tel = $alumno->getTelefono();
                $cor = $alumno->getCorreo();
                $stmt->bindParam(1, $cod);
                $stmt->bindParam(2, $nom);
                $stmt->bindParam(3, $ape);
                $stmt->bindParam(4, $tel);
                $stmt->bindParam(5, $cor);
                $stmt->execute();
                $mensaje = "Registro insertado correctamente";
                $archivo = fopen("log.txt", "r+b");
                $texto = "INSERT INTO alumnos (CODIGO, NOMBRE, APELLIDOS, TELEFONO, CORREO) VALUES (".$alumno->getCodigo().", ".$alumno->getNombre().", ".$alumno->getApellidos().", ".$alumno->getTelefono().", ".$alumno->getCorreo().")";
                fwrite($archivo, $texto);
                fclose($archivo);
            } catch (PDOException $ex) {
                $mensaje = "Error " . $ex->getMessage();
            }
        }else{
            $mensaje = "Correo introducido erroneamente, debe llevar una @ y un .";
            $intentos = $_POST['intentos'];
            if($intentos>=3){
                header("Location: error.php");
            }
            $intentos ++;
        }
        print_r($alumno);
    }else{
        $mensaje = "No dejes ningun campo vacio porfavor";
    }
}
?>
    <form action="" method="post">
        <fieldset style="width: 75px;">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" maxlength="30"></input></br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" maxlength="30"></input></br>
        <label for="telefono">Telefono:</label>
        <input type="number" name="telefono" max="999999999" min="1"></input></br>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" maxlength="50"></input></br>
        <input type='hidden' name='intentos' value='<?= $intentos?>' ></input>
        <p><?php echo "Intentos restantes: ". 4-$intentos?></p>
        <?php echo $mensaje?>
        <p><input type="submit" name="botonEnviar" value="Ingersar"></p>
        </fieldset>
    </form>
</body>
</html>