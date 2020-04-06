<?php

require_once '../datos/Conexion.clase.php';

class Articulo extends Conexion {
    
    public function listar() {
        try {
            $sql = "
               select
                    a.codigo_producto,
                    a.nombre,
                    a.precio_venta,
                    a.stock,
                    a.ubicacion
                from
                    producto a
                    inner join categoria c on ( a.codigo_categoria = c.codigo_categoria )
                order by
                         a.codigo_producto
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    //Función que permite obtener la foto del usuario
    //Función que permite obtener la foto del usuario
    public function obtenerFoto($codigo) {
        $foto = "../fotos-articulos/".$codigo;

        if (file_exists( $foto . ".png" )){
            $foto = $foto . ".png";

        }else if (file_exists( $foto . ".PNG" )){
            $foto = $foto . ".PNG";

        }else if (file_exists( $foto . ".jpg" )){
            $foto = $foto . ".jpg";

        }else if (file_exists( $foto . ".JPG" )){
            $foto = $foto . ".JPG";

        }else{
            $foto = "none";
        }

        if ($foto == "none"){
            return $foto;
        }else{
            return Funciones::$DIRECCION_WEB_SERVICE . $foto;
        }

    }
    
}
