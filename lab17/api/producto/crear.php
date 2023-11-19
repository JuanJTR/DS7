<?php
//encabezadosobligatorios
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");
//obtenerconexiondebasededatos
include_once '../configuracion/conexion.php';

//instanciarelobjetoproducto
include_once '../objetos/productos.php';
$conex=new Conexion();
$db=$conex->obtenerConexion();
$producto=new Producto($db);

//obtenerlosdatos
$data=json_decode(file_get_contents("php://input"));

//asegurarquelosdatosnoestenvacios
if(!empty($data->nombre)&&!empty($data->precio)&&
!empty($data->descripcion)&&!empty($data->categoria_id)){
    //asignarvaloresdepropiedadaproducto
    $producto->nombre=$data->nombre;
    $producto->precio=$data->precio;
    $producto->descripcion=$data->descripcion;
    $producto->categoria_id=$data->categoria_id;
    $producto->creado=date('Y-m-d H:i:s');

    //crearelproducto
    if($producto->crear()){
        //asignarcodigoderespuesta-201creado
        http_response_code(201);
        //informaralusuario
        echo json_encode(array("message"=>"El producto ha sido creado."));
    }else{ //sinopuedecrearelproducto,informaralusuario

        //asignarcodigoderespuesta-503servicionodisponible
        http_response_code(503);
        //informaralusuario
        echo json_encode(array("message"=>"Nosepuedecrearelproducto."));
    }

}else{ //informaralusuarioquelosdatosestanincompletos

    //asignarcodigoderespuesta-400solicitudincorrecta
    http_response_code(400);
    //informaralusuario
    echo json_encode(array("message"=>"Nosepuedecrearelproducto.Losdatosestánincompletos."));
}
?>