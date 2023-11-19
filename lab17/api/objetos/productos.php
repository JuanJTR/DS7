<?php
class Producto{
    //conexiondebasededatosytablaproductos
    private$conn;
    private$nombre_tabla="productos";
    //atributosdelaclase
    public$id;
    public$nombre;
    public$descripcion;
    public$precio;
    public$categoria_id;
    public$categoria_desc;
    public$creado;
    //constructorcon$dbcomoconexionabasededatos
    public function __construct($db){
        $this->conn=$db;
    }

    //leerproductos
    function read(){
        //queryparaseleccionartodos
        $query="SELECT
        c.nombre as categoria_desc,p.id,p.nombre,p.descripcion,p.precio,p.categoria_id,p.creado
        FROM
        ".$this->nombre_tabla." p
        LEFT JOIN
        categorias c
        ON p.categoria_id=c.id
        ORDER BY
        p.creado DESC";

        //sentenciaparaprepararquery
        $stmt=$this->conn->prepare($query);
        
        //ejecutarquery
        $stmt->execute();
        
        return $stmt;
    }

    //crearproducto
    function crear(){

        //queryparainsertarunregistro
        $query="INSERT INTO "
        .$this->nombre_tabla." 
        SET 
        nombre=:nombre,precio=:precio,descripcion=:descripcion,categoria_id=:categoria_id,creado=:creado";
        
        //prepararquery
        $stmt=$this->conn->prepare($query);

        //sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->categoria_id=htmlspecialchars(strip_tags($this->categoria_id));
        $this->creado=htmlspecialchars(strip_tags($this->creado));
        //bindvalues
        $stmt->bindParam(":nombre",$this->nombre);
        $stmt->bindParam(":precio",$this->precio);
        $stmt->bindParam(":descripcion",$this->descripcion);
        $stmt->bindParam(":categoria_id",$this->categoria_id);
        $stmt->bindParam(":creado",$this->creado);
        //executequery
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //utilizadoalcompletarelformulariodeactualizacióndelproducto
    function readOne(){
        //consultaparaleerunsoloregistro
        $query="SELECT 
        c.nombre as categoria_desc,p.id,p.nombre,p.descripcion,p.precio,p.categoria_id,p.creado 
        FROM 
        " .$this->nombre_tabla. " p 
        LEFT JOIN 
        categorias c 
        ON p.categoria_id=c.id 
        WHERE 
        p.id=? LIMIT 
        0,1";
        //preparardeclaracióndeconsulta
        $stmt=$this->conn->prepare($query);
        
        //IDdeenlacedelproductoaactualizar
        $stmt->bindParam(1,$this->id);
        
        //ejecutarconsulta
        $stmt->execute();
        
        //obtenerfilarecuperada
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row !== false) {
            //establecervaloresalaspropiedadesdelobjeto
            $this->nombre=$row['nombre'];
            $this->precio=$row['precio'];
            $this->descripcion=$row['descripcion'];
            $this->categoria_id=$row['categoria_id'];
            $this->categoria_desc=$row['categoria_desc'];
        } else {
            //asignarcodigoderespuesta-404Noencontrado
            http_response_code(404);
            //informarlealusuarioquenoseencontraronproductos
            echo json_encode(
                array("message"=>"El producto no existe :(")
            );
        }
        
        
    }
}
?>