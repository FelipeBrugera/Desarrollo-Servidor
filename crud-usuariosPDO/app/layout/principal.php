<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container" >
<div id="header">
<h1>GESTIÓN DE USUARIOS versión 1.1 + BD (PDO) HOLA2</h1>
</div>
<div id="content">
<form>
    login: <input type="text" name="id1">
    <button name="orden" value="Buscar"> Buscar </button>
</form>
<?= $contenido ?>
<form>
<button name="orden" value="Nuevo"> Nuevo </button>
<button name="orden" value="Terminar"> Terminar </button>
<button name="orden" value="Contar"> Contar </button>
</form>
</div>
</div>
</body>
