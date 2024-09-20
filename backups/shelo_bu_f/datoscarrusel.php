<?php 
    include_once("servidor.php");

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone -> conecta();
    
    $sql = $conexion -> prepare("SELECT * FROM carrusel");

    $sql -> setFetchMode(PDO::FETCH_ASSOC);
    $sql -> execute();

    while($reg = $sql -> fetch())
    {  
        $res[]=array('id' => $reg['id']);
        $res[]=array('imagen' => $reg['imagen']);
        $res[]=array('titulo' => $reg['titulo']);
        $res[]=array('descripcion' => $reg['descripcion']);
        $res[]=array('alterno' => $reg['alterno']);
    }

    $sql -> closeCursor();

    echo json_encode($res)
?>