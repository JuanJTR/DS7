<?php
//encabezadosobligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");
//incluirarchivosdeconexionyobjetos
include_once '../configuracion/conexion.php';
include_once '../objetos/productos.php';

//inicializar base de datos y objeto producto
$conex=new Conexion();
$db=$conex->obtenerConexion();

//inicializarobjeto
$producto=new Producto($db);

//queryproductos
$stmt=$producto->read();
$num=$stmt->rowCount();

//verificarsihaymasde0registrosencontrados
if($num>0){
    //arreglodeproductos
    $products_arr=array();
    $products_arr["records"]=array();
    //obtienetodoelcontenidodelatabla
    //fetch()esmasrapidoquefetchAll()
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        //extraerfila
        //esto creara de $row['nombre']a
        //solamente$nombre
        extract($row);
        $product_item=array(
            "id"=>$id,
            "nombre"=>$nombre,
            "descripcion"=>html_entity_decode($descripcion),
            "precio"=>$precio,
            "categoria_id"=>$categoria_id,
            "categoria_desc"=>$categoria_desc
        );
            array_push($products_arr["records"],$product_item);
    }

    //asignarcodigoderespuesta-200OK
    http_response_code(200);

    //mostrarproductosenformatojson
    echo json_encode($products_arr);
}else {
    //asignarcodigoderespuesta-404Noencontrado
    http_response_code(404);
    
    //informarlealusuarioquenoseencontraronproductos
    echo json_encode(
        array("message"=>"Noseencontraronproductos.")
    );
}