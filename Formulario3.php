<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <div class="form-container">
        <form action="validacion.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            
            <label for="pdf">Archivo PDF (hasta 40 MB):</label>
            <input type="file" name="pdf" id="pdf" accept=".pdf" required>
            
            <label for="foto">Foto (PNG, hasta 2 MB):</label>
            <input type="file" name="foto" id="foto" accept=".png" required>
            
            <input type="submit" name="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
