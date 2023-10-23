<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <H1>Manejo de sesiones</H1>
    <H2>Paso 3: la variable ya ha sido destruida y su valor se ha perdido</H2>

    <?PHP
    if (isset($_SESSION['var'])){
        $var = $_SESSION['var'];
    }else{
        $var = "";
    }
    print ("<P>Valor de la variable de sesion: $var</P>\n"); 
    session_destroy ();
    ?>
<A HREF="lab121.php" >Volver al paso 1</A>
</body>
</html>