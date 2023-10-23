<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 12</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <H1>Manejo de sesiones</H1>
    <H2>Paso 1: se crea la variable de sesion y se almacena</H2>

    <?PHP
    $var = "Ejemplo Sesiones";
    $_SESSION['var'] = $var;
    print ("<P>Valor de la variable de sesion: $var</P>\n");
    ?>

    <A HREF="lab122.php">Paso 2</A>
</body>
</html>

