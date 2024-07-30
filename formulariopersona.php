<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $carrera = $_POST['carrera'];
    $abreviacionCarrera = substr($carrera, 0, 3);

    $directorio = "C:/xampp/htdocs/archivos";
    $nombreArchivo = $directorio . "/" . $nombre . "_" . $abreviacionCarrera . ".txt";

    if (file_exists($nombreArchivo)) {
        $mensaje = "La persona ya existe.";
    } else {
        $contenido = "Nombre: $nombre\nApellido: $apellido Carrera: $carrera";
        file_put_contents($nombreArchivo, $contenido);
        $mensaje = "Persona guardada exitosamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Persona</title>
</head>
<body>
    <h1>Formulario Persona</h1>
    <?php
    if (isset($mensaje)) {
        echo "<script>alert('$mensaje');</script>";
    }
    ?>
    <form action="formularioPersona.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br><br>
        <label for="carrera">Carrera:</label>
        <input type="text" id="carrera" name="carrera" required>
        <br><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
