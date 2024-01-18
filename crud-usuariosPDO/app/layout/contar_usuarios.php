<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contar Usuarios</title>
    <link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>Contar Usuarios</h1>
        </div>
        <div id="content">
            <?php
                if (isset($totalUsuarios)) {
                    echo "<p>Total de Usuarios: $totalUsuarios</p>";
                } else {
                    echo "<p>No se pudo obtener la información sobre el total de usuarios.</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>
