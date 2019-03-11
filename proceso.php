<?php
/*
 * Esto puede ser útil si quieres validar que un archivo reciba variables POST, 
 * ya que podrías acceder por url localhost/mifolder/archivo1.php, 
 * si accedes así no estás enviando ningún valor por POST, 
 * entonces no entra al If.
 * 
 */
session_start();
$mysqly = new mysqli('localhost','root','','usuariosTest') or die(mysqli_error($mysqly));


$n = 0;
$update = false;
$nombre = '';
$ubicacion = '';




if(isset($_POST['guardar'])){
$nombre = $_POST['nombre'];
$ubicacion = $_POST['ubicacion'];

$mysqly->query("INSERT INTO registros (nombre,procedencia) VALUES ('$nombre','$ubicacion')")
        or die($mysqly->error);
$_SESSION['mensaje'] = "Se realizó correctamente el registro.";
$_SESSION['msg_type'] = "success";

header("location: index.php");

}


 if(isset($_POST['update'])){
 $n = $_POST['n'];
 $nombre = $_POST['nombre'];
 $ubicacion = $_POST['ubicacion'];
 
 $mysqly->query("UPDATE registros SET nombre='$nombre', procedencia='$ubicacion' WHERE nro=$n") 
        or die($mysqly->error);
 $_SESSION['mensaje'] = "Se actualizó correctamente el registro.";
 $_SESSION['msg_type'] = "warning";

 header("location: index.php");
 
}



/*isset()  Determina si una variable está definida y no es NULL*/
if(isset($_GET['eliminar'])){
    $nro = $_GET['eliminar'];
    $mysqly->query("Delete from registros where nro=$nro") 
            or die($mysqly->error);
$_SESSION['mensaje'] = "Se eliminó correctamente el registro.";
$_SESSION['msg_type'] = "danger";

header("location: index.php");

}

if (isset($_GET['editar'])){
    $n = $_GET['editar'];
    $update = true;
    $resultado = $mysqly->query("Select * from registros where nro=$n")
                 or die($mysqly->error);
    
    if(count($resultado)==1){
        $fila = $resultado -> fetch_array();
        $nombre = $fila['nombre'];
        $ubicacion = $fila['procedencia'];
    }
    
    
   
    
    
}
