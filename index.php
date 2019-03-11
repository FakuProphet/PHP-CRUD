<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>CRUD EN PHP</title>
  </head>
  <body>
    <h1 class="row justify-content-center">HOLA SOY FACUNDO</h1>
    <br>
    <!-- require_once va a verificar si el archivo ha sido importado, sino lo importa-->
    <?php require_once 'proceso.php'; ?>
     <div class="container">
    <?php if(isset($_SESSION['mensaje'])): ?>
    
    <div class="alert alert-<?=$_SESSION['msg_type']?>"><!--le concatena a el tipo de mensaje el resultado 
                                                        de del msg_type devuelto por el metodo-->
    <?php
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);/*destruye las variables especificadas*/
    ?>
                                                        
    </div>
    
    <?php endif;?>
           
       
   
    
    
   
    <?php 
        $mysqli = new mysqli('localhost','root','','usuariosTest') or die(mysqli_errno($mysqli));
        $consulta = $mysqli->query("Select * from registros") or die($mysqli->error);
      /*  pre_r($consulta->fetch_assoc());*/
      /*  pre_r($consulta->fetch_assoc());*/
      /*
       * Retorna una matriz de strings asociativa que representa a la fila obtenida del resultset, 
       *donde cada llave de la matriz corresponde al nombre de una de las columnas de éste; 
       * o NULL si es que no le quedan filas
       * 
       */
    ?>
    
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
               <?php while ( $fila = $consulta->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['procedencia']; ?></td>
                    <td>
                        <a href="index.php?editar=<?php echo $fila['nro'];?>" 
                           class="btn btn-info">Editar</a>
                        <a href="proceso.php?eliminar=<?php echo $fila['nro'];?>" 
                           class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    
    <?php
    function pre_r($array){
        echo '<pre>';
        print_r($array); /*permite visualizar la informacion de una variable*/
        echo '</pre>';
    }
    ?>
    
    <div class="row justify-content-center">
    <form action="proceso.php" method="POST">
        <input type="hidden" name="nro" value="<?php echo $nro; ?>">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" 
                   value="<?php echo $nombre;?>" placeholder="Ingrese el nombre" >
        </div>
        <div class="form-group">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" 
                   value="<?php echo $ubicacion;?>" placeholder="Ingrese la ubicación" >
        </div>
        <div class="form-group">
            
            <?php if($update==true): ?>
                <button type="submit" class="btn btn-info" name="update">Actualizar</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="guardar">Grabar</button> 
            <?php endif; ?>
                
        </div> 
    </form>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

