<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="archivo" accept=".txt">
        <input type="submit" value="Cargar y Procesar">
    </form>
    <h1>Tabla de datos</h1>
    <?php
    require_once 'conex.php';
    require_once 'lectorArchivo.php';
    require 'mostrarTabla.php';
    ?>
</body>

</html>