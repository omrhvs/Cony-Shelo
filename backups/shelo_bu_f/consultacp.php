<?php
    include_once "servidor.php";
    
    $cp = $_REQUEST['codigo'];

    $cone = new servidor("localhost", "shelo-cony", "");
    $conexion = $cone->conecta();

    $sql = $conexion -> prepare("SELECT * FROM codigospostales WHERE cp = $cp");
    $sql -> setfetchMode(PDO::FETCH_ASSOC);
    $sql -> execute();

    while($reg=$sql->fetch())
    {
        $res[]=array('id'=>$reg['id']);
        $res[]=array('cp'=>$reg['cp']);
        $res[]=array('colonia'=>$reg['colonia']);
        $res[]=array('municipio'=>$reg['municipio']);
        $res[]=array('ciudad'=>$reg['ciudad']);
        $res[]=array('estado'=>$reg['estado']);
    }

    echo json_encode($res);

    $sql->closeCursor();
?>