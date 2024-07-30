<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Censo Bolivia 2024</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Censo</h1>
    <form action="validar2.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" maxlength="50" required>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" maxlength="50" required>

        <label for="tipo_vivienda">Tipo de Vivienda:</label>
        <select id="tipo_vivienda" name="tipo_vivienda" required>
            <option value="Casa">Casa</option>
            <option value="Apartamento">Apartamento</option>
            <option value="Otros">Otros</option>
        </select>

        <label for="foto_vivienda">Foto de la Vivienda (JPG, PNG, máx 2 MB):</label>
        <input type="file" id="foto_vivienda" name="foto_vivienda" required>

        <label for="comentarios">Comentarios Adicionales (opcional, máx 500 caracteres):</label>
        <textarea id="comentarios" name="comentarios" maxlength="500"></textarea>

        <input type="submit" name="submit" value="Registrar">
    </form>
</body>
</html>
