<?php 
    include_once("servidor.php");

    $id = $_REQUEST['idJS'];
    $ruta = $_REQUEST['rutaJS'];
    $alt = $_REQUEST['alternoJS'];
    $titulo = $_REQUEST['tituloJS'];
    $descripcion = $_REQUEST['descripcionJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone -> conecta();

    if(empty($id))
    {
        $sql = $conexion -> prepare("INSERT INTO carrusel (imagen, titulo, descripcion, alterno) VALUES (:a, :b, :c, :d)");
    }
    else
    {
        $sql = $conexion->prepare("UPDATE carrusel SET imagen = :a, titulo = :b, descripcion = :c, alterno = :d WHERE id = :id");
        $sql->bindParam(':id', $id);
    }

    $sql -> bindParam(":a", $ruta);
    $sql -> bindParam(":b", $titulo);
    $sql -> bindParam(":c", $descripcion);
    $sql -> bindParam(":d", $alt);

    $res = "";
    
    if($sql -> execute())
    {
        $res = "Ok";
    }
    else
    {
        $res = "Error";
    }

    $sql -> closeCursor();
    
    echo json_encode($res);
?>