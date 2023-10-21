<?php
require('tcpdf/tcpdf.php');
require('conex.php');

$pdf = new TCPDF();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
$html = '<table border="1">
    <tr>
        <th>Nombre archivo</th>
        <th>Cantidad de lineas</th>
        <th>Cantidad de palabras</th>
        <th>Cantidad de caracteres</th>
        <th>Fecha del registro</th>
    </tr>';

// Obtener los datos
$db = new Database();
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$resultados_por_pagina = 10;
$datos = $db->obtenerData($pagina_actual, $resultados_por_pagina);

foreach ($datos as $fila) {
    $html .= '<tr>';
    $html .= '<td>' . $fila['nombrearchivo'] . '</td>';
    $html .= '<td>' . $fila['cantlineas'] . '</td>';
    $html .= '<td>' . $fila['cantpalabras'] . '</td>';
    $html .= '<td>' . $fila['cantcaracteres'] . '</td>';
    $html .= '<td>' . $fila['fecharegistro'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('datos.pdf', 'I');
