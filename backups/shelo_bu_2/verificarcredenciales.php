<?php 
    include_once("servidor.php");

    $correo = $_REQUEST['correoJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone->conecta();

    $sql = $conexion->prepare("SELECT * FROM cuentas WHERE email = '$correo'");
    $sql -> setfetchMode(PDO::FETCH_ASSOC);
    
    if($sql -> execute())
    {
        $reg=$sql->fetch();
    }
    
    $sql -> closeCursor();
?>