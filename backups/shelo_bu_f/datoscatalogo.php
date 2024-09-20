<?php 
    include_once("servidor.php");

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone -> conecta();
    
    $sql = $conexion -> prepare("SELECT * FROM catalogo");

    $sql -> setFetchMode(PDO::FETCH_ASSOC);
    $sql -> execute();

    while($reg = $sql -> fetch())
    {  
        $res[]=array('id' => $reg['id']);
        $res[]=array('nombre' => $reg['nombre']);
        $res[]=array('descripcion' => $reg['descripcion']);
        $res[]=array('cantidad' => $reg['cantidad']);
        $res[]=array('precio' => $reg['precio']);
        $res[]=array('estado' => $reg['estado']);
        $res[]=array('foto' => $reg['foto']);
        $res[]=array('alterno' => $reg['alterno']);
    }

    $sql -> closeCursor();

    echo json_encode($res)
?>