<?php
$directorio = "C:/xampp/htdocs/archivos";
$archivo = $directorio . "/resultado.txt";

if (isset($_POST['submit'])) {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
    $carrera = isset($_POST['carrera']) ? $_POST['carrera'] : "";
    $abreviacionCarrera = substr($carrera, 0, 3);

    $nombreArchivo = $directorio . "/" . $nombre . "_" . $abreviacionCarrera . ".txt";

    if (file_exists($nombreArchivo)) {
        $mensaje = "La persona ya existe.";
    } else {
        $datos = fopen($nombreArchivo, "w");
        
        if ($datos) {
            fwrite($datos, "Nombre: " . $nombre . "\n");
            fwrite($datos, "Apellido: " . $apellido . "\n");
            fwrite($datos, "Carrera: " . $carrera . "\n");
            fclose($datos);
            $mensaje = "Persona guardada exitosamente.";
        } else {
            $mensaje = "Error al intentar guardar los datos.";
        }
    }

    if (file_exists($nombreArchivo)) {
        $datos = fopen($nombreArchivo, "r");
        if ($datos) {
            while (!feof($datos)) {
                $linea = fgets($datos, 1024);
                $contenido .= $linea . "<br>";
            }
            fclose($datos);
        }
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
    <?php
    if (isset($contenido)) {
        echo $contenido;
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
        <button type="submit" name="submit">Guardar</button>
    </form>
</body>
</html>
