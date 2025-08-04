<?php
function mostrarError($errores,$campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class = 'alerta alerta-error'>".$errores[$campo].'</div>'  ;
    }

    return $alerta;
}

function borrarErrores(){
    if(isset($_SESSION['errores'])){
        unset($_SESSION['errores']);
        
    }
    if(isset($_SESSION['completado'])){
        unset($_SESSION['completado']);
    }

    if(isset($_SESSION['errores_entrada'])){
        unset($_SESSION['errores_entrada']);
    }

    return true;
}


function conseguirCategorias($db){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($db,$sql);
    $resul = array();
    if($categorias && mysqli_num_rows($categorias) >= 1 ){
        $resul = $categorias;
    }
    return $resul;

}


function conseguirEntradas($db, $limit = null, $categoria = null, $busqueda = null) {
    // Consulta base
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e " .
           "INNER JOIN categorias c ON e.categoria_id = c.id ";
    
    // Array para las condiciones WHERE
    $condiciones = array();
    
    // Agregar condición de categoría si existe
    if (!empty($categoria) && is_numeric($categoria)) {
        $categoria = (int)$categoria; // Convertir a entero por seguridad
        $condiciones[] = "e.categoria_id = $categoria";
    }
    
    // Agregar condición de búsqueda si existe
    if (!empty($busqueda)) {
        $busqueda_segura = mysqli_real_escape_string($db, $busqueda);
        $condiciones[] = "(e.titulo LIKE '%$busqueda_segura%' OR e.descripcion LIKE '%$busqueda_segura%')";
    }
    
    // Si hay condiciones, agregarlas con WHERE
    if (!empty($condiciones)) {
        $sql .= "WHERE " . implode(" AND ", $condiciones) . " ";
    }
    
    // Ordenar por ID descendente
    $sql .= "ORDER BY e.id DESC ";
    
    // Agregar límite si se especifica
    if ($limit && is_numeric($limit)) {
        $limit = (int)$limit;
        $sql .= "LIMIT $limit";
    }
    
    // Ejecutar la consulta
    $entradas = mysqli_query($db, $sql);
    
    // Verificar si hay error en la consulta
    if (!$entradas) {
        echo "Error en la consulta: " . mysqli_error($db);
        echo "<br>SQL generado: " . $sql;
        return false;
    }
    
    return $entradas;
}

function conseguirCategoria($db,$id){
    
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($db,$sql);
    $resul = array();
    if($categorias && mysqli_num_rows($categorias) >= 1 ){
        $resul = mysqli_fetch_assoc($categorias);
    }
    return $resul;

}

function conseguirEntrada($db,$id_entrada){
    $sql = "SELECT e.*, c.nombre as categoria, CONCAT(u.nombre,' ',u.apellidos) as usuario FROM entradas e ".
    "INNER JOIN categorias c ON e.categoria_id = c.id " . 
    "INNER JOIN usuarios u ON e.usuario_id = u.id " . 
    "WHERE e.id = $id_entrada";
    $entrada = mysqli_query($db,$sql);

    $resultado = array();

    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado = mysqli_fetch_assoc($entrada);
    }
    return $resultado;
}


 