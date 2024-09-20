<?php 
    include_once("servidor.php");

    $foto = $_FILES['fotoJS'];

    if($foto['error'] === UPLOAD_ERR_OK)
    {
        echo json_encode(array("resultado" => "okay"));
    }
    else
    {
        switch ($foto['error'])
        {
            case UPLOAD_ERR_INI_SIZE:
                echo json_encode("El archivo es demasiado grande (tamaño máximo permitido: " . ini_get('upload_max_filesize') . ")");
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo json_encode("El archivo es demasiado grande (tamaño máximo permitido: " . $_POST['MAX_FILE_SIZE'] . ")");
                break;
            case UPLOAD_ERR_PARTIAL:
                echo json_encode("El archivo se subió parcialmente.");
                break;
            case UPLOAD_ERR_NO_FILE:
                echo json_encode("Ningún archivo fue subido.");
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo json_encode("Falta la carpeta temporal.");
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo json_encode("Error al escribir el archivo en el disco.");
                break;
            case UPLOAD_ERR_EXTENSION:
                echo json_encode("Una extensión de PHP detuvo la subida de archivos.");
                break;
            default:
                echo json_encode("Error desconocido al subir el archivo.");
                break;
        }
    }
?>