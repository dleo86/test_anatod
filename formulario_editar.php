<?php
session_start();
require_once 'funciones/funciones.inc.php';
require_once 'class.database.php';
//si pulsa el boton comienzo validando los controles
if (!empty($_POST['btnEditar'])) {
    $_SESSION['Mensaje'] = ControlesValidos();
    
    //esta funcion devolvera un mensaje si el mail ya fue registrado
    //este mensaje se concatena al mensaje anterior
    $_SESSION['Mensaje'].= ControlarClienteExiste($_POST['Id']); 
    
    //si la funcion devuelve los mensajes, los mostrare mas abajo
    //si la funcion devuelve un mensaje vacio, entonces ya puedo registrar
    if (empty($_SESSION['Mensaje'])) {
        if (Modificar_Cliente($_POST['Id']) != false) {
            $_SESSION['Mensaje'] = 'Registro almacenado!!';
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['Mensaje'] = 'Error al intentar almacenar.';
            echo "error al almacenar";
        }
    }
}

$ListadoLocalidades = Listar_Localidades();
$cntLocalidades = count($ListadoLocalidades);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Editar</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/estilos.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <?php/*
         if (!empty($_SESSION['Mensaje'])) {
            echo $_SESSION['Mensaje'];
        }*/
        ?>
        <div class="container">

            <form method="post" id="idform">
                <h2>
                    Editar datos de Clientes
                </h2>
                <h4>
                    * Todos los datos son requeridos<br />
                    
                    
                </h4>  
                Id:
                <input type="text" name="Id" id="Id" value="<?php echo!empty($_POST['Id']) ? $_POST['Id'] : ''; ?>" />
                <br /><br />
                Nombre:
                <input type="text" name="Nombre" id="Nombre" value="<?php echo!empty($_POST['Nombre']) ? $_POST['Nombre'] : ''; ?>" />
                <br /><br />
                DNI:
                <input type="text" name="DNI" id="DNI"value="<?php echo!empty($_POST['DNI']) ? $_POST['DNI'] : ''; ?>" />
                <br /><br />
                Localidad:
                <select name= "Localidad"><option value="">Selecciona una localidad...</option>
                    <?php
                      for ($i = 0; $i < $cntLocalidades; $i++) {
                          $seleccionado = !empty($_POST['Localidad']) && $_POST['Localidad'] == $ListadoLocalidades[$i]['Id'] ? 'selected' : '';
                    ?>
                    <option value="<?php echo $ListadoLocalidades[$i]['Id'] ?>"  <?php echo $seleccionado; ?> >
                    <?php echo $ListadoLocalidades[$i]['NOMBRE'] ?>
                    </option>
                   <?php } ?>
               </select>
                <br /><br />
                
                <button type="submit" name="btnEditar" id="btnEnviar" value="btnEditar">Editar</button><br /><br />
                <a href="index.php" class="link">Volver al indice</a><br />
            </form>

        </div>            

        

    </body>
</html>
