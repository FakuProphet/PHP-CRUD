<?php
/*
 * Esto puede ser útil si quieres validar que un archivo reciba variables POST, 
 * ya que podrías acceder por url localhost/mifolder/archivo1.php, 
 * si accedes así no estás enviando ningún valor por POST, 
 * entonces no entra al If.
 * 
 */

$mysqly = new mysqli('localhost','root','','usuariosTest') or die(mysqli_error($mysqly));
if(isset($_POST['guardar'])){
$nombre = $_POST['nombre'];
$ubicacion = $_POST['ubicacion'];

$mysqly->query("INSERT INTO registros (nombre,procedencia) VALUES ('$nombre','$ubicacion')")
        or die($mysqly->error);
}