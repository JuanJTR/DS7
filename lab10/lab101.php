<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 10.1</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <?php
    //require_once("class/votos.php");
    require_once('class/votos.php');
    if (array_key_exists('enviar', $_POST)) {
        print ("<H1>Encuesta. Voto registrado</H1>\n");
        $obj_votos = new votos();
        $result_votos = $obj_votos->listar_votos();

        foreach ($result_votos as $result_voto) {
            $votos1=$result_voto['votos1'];
            $votos2=$result_voto['votos2'];
        }
        
        $voto = $_REQUEST['voto'];
        if ($voto=="si") {
            $votos1 = $votos1 + 1;
        } else if ($voto == "no") {
            $votos2= $votos2 + 1;
        }
        $obj_votos=new votos();
        $result = $obj_votos->actualizar_votos ($votos1, $votos2);
        
        if ($result) {
            print ("<P>Su voto ha sido registrado. Gracias por participar</P>\n");
            print ("<A HREF='lab102.php'>Ver resultados</A>\n");
        } else {
            print ("<A HREF='lab101.php'>Error al actualizar su voto</A>\n");
        }
        
    } else {
        # code...
        ?>
        <h1>Encuesta</h1>
        <P>¿Cree ud. que el precio de la vivienda seguira subiendo al ritmo actual?</P>
        <form action="lab101.php" method="post">
            <INPUT TYPE="RADIO" NAME="voto" VALUE="si" CHECKED>Si<BR>
            <INPUT TYPE="RADIO" NAME="voto" VALUE="no">No<BR><BR>
            <INPUT TYPE="SUBMIT" NAME="enviar" VALUE="votar">

        </form>
        <A HREF="lab102.php">Ver resultados</A>
    <?php
    }
    ?>
    
</body>
</html>