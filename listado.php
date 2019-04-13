<?php require_once 'funciones/funciones.inc.php';
require_once 'class.database.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Listado</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/estilos.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        <div class="container">
            <form method="post" id="idform">
            <?php
                //llamo a la funcion que devolvera el listado de Generos
                //$ListadoClientes = Listar_Clientes();
                $ListadoClientes = Listar_Clientes();
                //si el array tiene datos procedo a mostrarlos en tabla
                if (!empty($ListadoClientes)) {
                    ?>

                    <h3>Listado de Clientes</h3>
                    <table border="2">
                        <tr>
                            <td>Id</td>
                            <td>Nombre</td>
                            <td>DNI</td>
                            <td>Localidad</td>
                        </tr>
                        <?php
                        $cantClientes = count($ListadoClientes);
                        for ($i = 0; $i < $cantClientes; $i++) {
                            //repito los Renglones <tr> por cada Elemento de mi array                                                                    
                            /* recordar q en las tablas: 
                             * Renglon --> <tr>
                             * Dato en celda --> <td>
                             */
                            ?>
                            <tr>
                                <td><?php echo $ListadoClientes[$i]['ID']; ?></td>                                             
                                <td><?php echo $ListadoClientes[$i]['NOMBRE']; ?></td>
                                <td><?php echo $ListadoClientes[$i]['DNI']; ?></td>
                                <td><?php echo$ListadoClientes[$i]['LOC']; ?></td> 
                            </tr>
                            <?php
                        } //FIN FOR
                        ?>
                    </table>
                    <?php
                } else {
                    //el array esta vacio, es decir la consulta no arroja resultados
                    echo 'No hay clientes cargados a&uacute;n.';
                }
            
            ?>
            <a href="index.php" class="link">Volver al indice</a><br />
           </form>
        </div>            


    </body>
</html>
