<?php
session_start();
if (isset($_REQUEST['usuario']) && isset($_REQUEST['clave'])) {
    $usuario = $_REQUEST['usuario'];
    $clave = $_REQUEST['clave'];

    $salt = substr($usuario,0,2);
    $clave_crypt = crypt($clave, $salt);

    require_once('class/usuarios.php');

    $obj_usuarios = new usuarios();
    $usuario_validado = $obj_usuarios->validar_usuario($usuario ,$clave_crypt);

    foreach ($usuario_validado as $array_resp) {
        foreach ($array_resp as $value) {
            $nfilas=$value;
        }
    }

    if ($nfilas > 0) {
        $usuario_validado = $usuario;
        $_SESSION['usuario_validado']=$usuario_validado;
    }
}
?>
<!-- - - - - - codigo HTML - - - - - -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 14 - Login al sitio Noticias</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <?php
    if (isset($_SESSION['usuario_validado'])) {
        //echo ($_SESSION['usuario_validado']);
    ?>
    <h1>Gestion de Noticias</h1>
    <hr>
    <ul>
        <li><a href="lab142.php">Listar todas las noticias</a></li>
        <li><a href="lab143.php">Listar noticias por partes</a></li>
        <li><a href="lab144.php">Buscar noticia</a></li>
    </ul>

    <hr>
    <p>[ <a href="logout.php">Desconectar</a> ]</p>

    <?php
    //intento de entrada fallido 
    }elseif (isset($usuario)) {
        print("<br><br\n>");
        print("<p class='center'>Acceso no autorizado </p\n>");
        print("<p class='center'>[ <a href='login.php'>Conectar</a> ]</p\n>");
    }else { //sesion no iniciada
        print("<br><br\n>");
        print("<p class='parrafocentrado'>Esta zona tiene el acceso restringido. <br>" . 
        " Para entrar debe identificarse </p\n>");
        print("<FORM CLASS='entrada' NAME='login' ACTION='login.php' METHOD='POST'>\n");
        print("<P><LABEL CLASS='etiqueta-entrada'>Usuario:</LABEL>\n");
        print(" <INPUT TYPE='TEXT' NAME='usuario' SIZE='15'></P>\n");
        print("<P><LABEL CLASS='etiqueta-entrada'>Clave: </LABEL>\n"); 
        print(" <INPUT TYPE='PASSWORD' NAME='clave' SIZE='15'></P>\n");
        print("<P><INPUT TYPE='SUBMIT' VALUE='entrar'></P>\n");
        print("</FORM>\n");

        print("<P CLASS='parrafocentrado'>NOTA: si no dispone de identificacion o tiene problemas ". 
        "para entrar<BR>pongase en contacto con el ".
        "<A HREF='MAILTO:webmaster@localhost'>administrador</A> del sitio</P>\n");
    }
    ?>
</body>
</html>