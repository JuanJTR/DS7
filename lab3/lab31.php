<?php
$diametro= floatval($_POST['diam']);
$altura= floatval($_POST['altu']);
$radio= $diametro/2;
$Pi= 3.141593;
$volumen= $Pi*$radio*$radio*$altura;
echo "<br> El volumen del cilindro es de  ". $volumen. " metros cubicos";
?>