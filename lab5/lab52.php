<?php 
if (is_uploaded_file($_FILES['nombre_archivo_cliente']['tmp_name'])) {
    $nombreDirectorio = "archivos/";
    $nombrearchivo = $_FILES['nombre_archivo_cliente']['name'];
    $nombreCompleto = $nombreDirectorio . $nombrearchivo;

    // Valida el tamaño máximo (1MB)
    if ($_FILES['nombre_archivo_cliente']['size'] > 1000000) {
        echo "Archivo muy pesado, el tamaño limite es de 1MB.<br><br>";
    } else {
        // Valida que el archivo sea imagen
        $extension = strtolower(pathinfo($nombrearchivo, PATHINFO_EXTENSION));
        $extensionesPermitidas = array('jpg', 'jpeg', 'gif', 'png');

        if (!in_array($extension, $extensionesPermitidas)) {
            echo "El archivo no es una imagen de tipo soportado (jpg, jpeg, gif, png).<br><br>";
        } else {
            if (is_file($nombreCompleto)) {
                $idUnico = time();
                $nombrearchivo = $idUnico . "-" . $nombrearchivo;
                echo "Archivo repetido, se cambiará el nombre a $nombrearchivo<br><br>";
            }
        }
    }
} else {
    echo "No se ha podido subir el archivo.<br><br>";
}
?>
