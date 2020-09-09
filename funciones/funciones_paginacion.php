<?php


function ObraSocial_Paginado($RegistroInicial , $CantidadParaMostrar){
    //Esta funcion traera LIMITADA la consulta
    // --> Desde el registro dado en el primer parametro
    // --> contando tantos registros como indique el 2do parametro
    $mensaje='';
    try{
      $conexion = new PDO('mysql:host=localhost;dbname=clinic','root','');
    }catch(PDOException $e){
      echo "Error: ". $e->getMessage();
    }

     $consulta = $conexion -> prepare("
          SELECT * FROM obra_social ORDER BY id_obrasocial limit $vRegistroInicial  , $vCantidadParaMostrar");

    $consulta ->execute();
    $consulta = $consulta ->fetchAll();
    if(!$consulta){
      $mensaje .= 'NO HAY OBRAS SOCIALES PARA MOSTRAR';
     }
     return $consulta;
}

?>