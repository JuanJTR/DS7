<?php 
if (is_uploaded_file($_FILES['nombre_archivo_cliente']['tmp_name'])) {
    $nombreDirectorio = "archivos";
    $nombrearchivo = $_FILES['nombre_archivo_cliente']['name'];
    $nombreCompleto = $nombreDirectorio . $nombrearchivo;
    if (is_file($nombreCompleto)) {
        # code...
        $idUnico = time();
        $nombrearchivo = $idUnico . "-" . $nombrearchivo;
        echo "Archivo repetido, se cambiara le nombre a $nombrearchivo<br><br>";

    }
} else {
    # code...
    echo "No se a podido subir el archivo <br>";
}

?>