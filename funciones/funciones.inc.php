<?php

function Listar_Localidades(){
    $Listado=array();
    $MiConexion= new mysqli("consumos1.c75o4mima6rb.us-east-1.rds.amazonaws.com","test","test5678","test_anatod");
    if ($MiConexion!=false){
        $SQL = "SELECT Id, Nombre FROM localidad";
        $rs = mysqli_query($MiConexion, $SQL);
        $i=0;
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['Id'];
            $Listado[$i]['NOMBRE'] = utf8_encode($data['Nombre']);
            $i++;
        }
    }

    return $Listado;
}



function Listar_Clientes(){
     $Listado=array();
    $MiConexion= new mysqli("consumos1.c75o4mima6rb.us-east-1.rds.amazonaws.com","test","test5678","test_anatod");
    if ($MiConexion!=false){
        $SQL = "SELECT C.Id AS ICLI, C.Nombre AS NOMCLI, C.DNI AS DCLI, 
                       C.IdLoc AS ILCLI, L.Nombre AS NLOC 
                FROM clientes C, localidad L
                WHERE C.IdLoc = L.Id
                ORDER BY NOMCLI ASC";
        $rs = mysqli_query($MiConexion, $SQL);
        $i=0;
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['ICLI'];
            $Listado[$i]['NOMBRE'] = utf8_encode($data['NOMCLI']);
            $Listado[$i]['DNI'] = $data['DCLI'];
            $Listado[$i]['LOC'] = utf8_encode($data['NLOC']);
            $i++;
        }
    }

    return $Listado;
}


function Insertar_Cliente(){
    $SQL="INSERT INTO clientes (Nombre, DNI, IdLoc)
        VALUES ('{$_POST['Nombre']}', '{$_POST['DNI']}', '{$_POST['Localidad']}')";
             
    $linkConexion= new mysqli("consumos1.c75o4mima6rb.us-east-1.rds.amazonaws.com","test","test5678","test_anatod");
    //$MensajeError='';
    if (!mysqli_query($linkConexion, $SQL)){
        return false;
    }else {
        echo "entro a la conexion";
        return true;
    }
}

function ControlesValidos(){
    $MensajeError='';
    //voy concatenando los mensajes de error a medida q van saliendo
    $_POST['Nombre']=trim($_POST['Nombre']); //limpio espacios al Nombre
    if (empty($_POST['Nombre'])){
        $MensajeError.='Debe ingresar el nombre <br />';
    }
    if (empty($_POST['DNI']) || !is_numeric($_POST['DNI']) || $_POST['DNI']==0) {
        $_SESSION['MensajeError'].='Debes ingresar el DNI.<br />';
    }
    if (empty($_POST['Localidad']) || !is_numeric($_POST['Localidad'])) {
        $_SESSION['MensajeError'].='Debes seleccionar la Localidad.<br />';
    }
   
    return $MensajeError;
}

function ControlarClienteRepetido($DNI) {

    
    $MensajeError = '';
    
    //me conecto
    $linkConexion = new mysqli("consumos1.c75o4mima6rb.us-east-1.rds.amazonaws.com","test","test5678","test_anatod");
    
    //la consulta debe traer un registro si ese cliente ya fue cargado
    $SQL = "SELECT Id FROM clientes WHERE DNI = '{$DNI}'  ";
    $rs = mysqli_query($linkConexion, $SQL);
    
    $data = mysqli_fetch_array($rs);
    //si el conjunto de registros contiene valores, ese cliente ya se registro
    if ($data != false) {
        $MensajeError = 'Este cliente ya ha sido registrado. <br />';
    }
   
    //devuelvo el mensaje, cargado o vacio segun encuentre o no ese cliente
    return $MensajeError;
}

function ControlarClienteExiste($DNI) {

    $MensajeError = '';
    
    //me conecto
    $linkConexion = new mysqli("consumos1.c75o4mima6rb.us-east-1.rds.amazonaws.com","test","test5678","test_anatod");
    
    //la consulta debe traer un registro si ese cliente ya fue cargado
    $SQL = "SELECT * FROM clientes WHERE DNI = '{$DNI}'  ";
    $rs = mysqli_query($linkConexion, $SQL);
    
    $data = mysqli_fetch_array($rs);
    //si el conjunto de registros contiene valores, ese cliente ya se registro
    if ($data == false) {
        $MensajeError = '';
    } else {
        $MensajeError = 'cliente no registrado';
    }
   
    //devuelvo el mensaje, cargado o vacio segun encuentre o no ese cliente
    return $MensajeError;
}


function Modificar_Cliente($ID) {
    
    $SQL = "UPDATE clientes 
            SET Nombre ='{$_POST['Nombre']}' ,
            DNI = {$_POST['DNI']} 
            WHERE Id=$ID";

    $MiConexion = new mysqli("consumos1.c75o4mima6rb.us-east-1.rds.amazonaws.com","test","test5678","test_anatod");
    if (!mysqli_query($MiConexion, $SQL)) {
        return false;
    } else {
        return true;
    }
}

?>