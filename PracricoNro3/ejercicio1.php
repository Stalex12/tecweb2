<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Proyecto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Formulario</h1>
    <form action="validar1.php" method="post" enctype="multipart/form-data">
        <label for="nombre_proyecto">Nombre del Proyecto:</label>
        <input type="text" id="nombre_proyecto" name="nombre_proyecto" required>

        <label for="descripcion_proyecto">Descripción del Proyecto:</label>
        <textarea id="descripcion_proyecto" name="descripcion_proyecto" rows="4" required></textarea>

        <label for="documento_proyecto">Documento del Proyecto (PDF o DOCX, máx 5 MB):</label>
        <input type="file" id="documento_proyecto" name="documento_proyecto" required>

        <input type="submit" name="submit" value="Enviar">
    </form>
</body>
</html>
