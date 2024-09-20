<?php 
    include_once("servidor.php");

    $email = $_REQUEST['correoJS'];
    $password = $_REQUEST['passwordJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone->conecta();

    $sql = $conexion->prepare("SELECT * FROM cuentas WHERE email = '$email'");
    $sql -> setfetchMode(PDO::FETCH_ASSOC);

    if($sql -> execute())
    {
        $res = $sql->fetch();
    }
    
    $sql->closeCursor();
    
    echo json_encode($res);
?>