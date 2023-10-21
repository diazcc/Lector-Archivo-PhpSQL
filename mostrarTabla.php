<?php
//Modulo para mostrar los datos por cada tabla 

//Se crea una nueva instancia de la base de datos
$db = new Database();

//Se realiza la consulta y se obtiene los datos de la tabla
$consulta_total = "SELECT COUNT(*) as total FROM informacion";
$resultado_total = $db->conexion->query($consulta_total);
$fila_total = $resultado_total->fetch_assoc();
$total_registros = $fila_total['total'];

// Se calcula el número total de paginas
$total_paginas = ceil($total_registros / 1);

// Se define la pagina actual
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Se define el índice del primer resultado en la página actual
$indice_inicial = ($pagina_actual - 1) * 1;

// Se consulta para obtener los resultados de la página actual
$consulta_pagina = "SELECT * FROM informacion LIMIT $indice_inicial, 1";
$resultado_pagina = $db->conexion->query($consulta_pagina);

while ($fila = $resultado_pagina->fetch_assoc()) {
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>Nombre archivo</th>';
    echo '<th>Codigo</th>';
    echo '<th>Cantidad de lineas</th>';
    echo '<th>Cantidad de palabras</th>';
    echo '<th>Cantidad de caracteres</th>';
    echo '<th>Fecha del registro</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $fila['nombrearchivo'] . '</td>';
    echo '<td>' . $fila['codigo'] . '</td>';
    echo '<td>' . $fila['cantlineas'] . '</td>';
    echo '<td>' . $fila['cantpalabras'] . '</td>';
    echo '<td>' . $fila['cantcaracteres'] . '</td>';
    echo '<td>' . $fila['fecharegistro'] . '</td>';
    echo '</tr>';
    echo '</table>';
    echo '<a href="generarPdf.php" target="_blank">Generar PDF</a>';

}

// Aqui se crea los indices de la paginacion
echo '<div class="paginacion">';
echo '<form action="" method="get">';
for ($i = 1; $i <= $total_paginas; $i++) {
    $enlace = '?pagina=' . $i;
    echo '<input type="submit" name="pagina" value="' . $i . '">';
}
echo '</form>';
echo '</div>';
