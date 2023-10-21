<?php
$db = new Database();
if (isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo'];

    if ($archivo['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo = $archivo['name'];
        $ruta_temporal = $archivo['tmp_name'];

        // Procesar el archivo y calcular líneas, palabras y caracteres
        $contenido = file_get_contents($ruta_temporal);
        $lineas = count(file($ruta_temporal));
        $palabras = str_word_count($contenido);
        $caracteres = strlen($contenido);

        try {
            // Guardar los datos en la base de datos
            $consulta = "INSERT INTO informacion (nombrearchivo, cantlineas, cantpalabras, cantcaracteres, fecharegistro) 
                         VALUES (?, ?, ?, ?, NOW())";
            $sentencia = $db->conexion->prepare($consulta);
            $sentencia->bind_param('siii', $nombre_archivo, $lineas, $palabras, $caracteres);

            if ($sentencia->execute()) {
                header("Location: " . $_SERVER['PHP_SELF']);
            } else {
                echo "Error al guardar los datos en la base de datos.";
            }
            $db->cerrarConexion();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error al cargar el archivo.";
    }
} else {
    echo "No se ha enviado ningún archivo.";
}
