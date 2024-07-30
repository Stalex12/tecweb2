<?php
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $tipo_vivienda = $_POST['tipo_vivienda'];
    $foto_vivienda = $_FILES['foto_vivienda'];
    $comentarios = $_POST['comentarios'];

    $errores = [];

    if (!preg_match('/^[a-zA-Z\s]+$/', $nombre)) {
        $errores[] = "El nombre debe contener solo letras y espacios.";
    }
    if (!preg_match('/^[a-zA-Z\s]+$/', $direccion)) {
        $errores[] = "La dirección debe contener solo letras y espacios.";
    }

    if (strlen($nombre) > 50) {
        $errores[] = "El nombre no debe exceder los 50 caracteres.";
    }
    if (strlen($direccion) > 50) {
        $errores[] = "La dirección no debe exceder los 50 caracteres.";
    }

    $tipos_vivienda = ['Casa', 'Apartamento', 'Otros'];
    if (!in_array($tipo_vivienda, $tipos_vivienda)) {
        $errores[] = "El tipo de vivienda seleccionado no es válido.";
    }

    $tipos_permitidos_foto = ['image/jpeg', 'image/png'];
    if (!in_array($foto_vivienda['type'], $tipos_permitidos_foto)) {
        $errores[] = "La foto de la vivienda debe ser un archivo JPG o PNG.";
    }
    if ($foto_vivienda['size'] > 2 * 1024 * 1024) { 
        $errores[] = "La foto de la vivienda no debe exceder los 2 MB.";
    }

    if (strlen($comentarios) > 500) {
        $errores[] = "Los comentarios no deben exceder los 500 caracteres.";
    }

    if (empty($errores)) {
        $dir_subida = 'practica_3/';
        if (!is_dir($dir_subida)) {
            mkdir($dir_subida, 0777, true);
        }

        $nombre_unico_foto = $nombre . '_' . time() . '_' . basename($foto_vivienda['name']);
        $foto_destino = $dir_subida . $nombre_unico_foto;

        if (move_uploaded_file($foto_vivienda['tmp_name'], $foto_destino)) {
            $datos = "Nombre: " . $nombre . "\n" .
                     "Dirección: " . $direccion . "\n" .
                     "Tipo de Vivienda: " . $tipo_vivienda . "\n" .
                     "Comentarios: " . $comentarios . "\n";
            $nombre_archivo = $dir_subida . 'registro_' . time() . '.txt';
            file_put_contents($nombre_archivo, $datos);

            echo "<div style='background-color: rgb(209, 242, 235); padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;'>
                    <h1 style='color: rgb(19, 141, 117);'>Registro Exitoso</h1>
                    <p style='font-size: 18px; color: rgb(23, 165, 137);'>Nombre: " . htmlspecialchars($nombre) . "</p>
                    <p style='font-size: 18px; color: rgb(23, 165, 137);'>Dirección: " . htmlspecialchars($direccion) . "</p>
                    <p style='font-size: 18px; color: rgb(23, 165, 137);'>Tipo de Vivienda: " . htmlspecialchars($tipo_vivienda) . "</p>
                    <p style='font-size: 18px; color: rgb(23, 165, 137);'>Comentarios: " . htmlspecialchars($comentarios) . "</p>
                    <img src='$foto_destino' alt='Foto de la Vivienda' width='300'><br><br>
                    <a href='ejercicio2.php' style='display: inline-block; padding: 10px 20px; background-color: rgb(72, 201, 176); color: white; text-decoration: none; border-radius: 4px;'>Volver al formulario</a>
                  </div>";
        } else {
            echo "<div style='color: rgb(23, 165, 137); font-weight: bold;'>Error al subir la foto.<br></div>";
        }
    } else {
        echo "<div style='background-color: rgb(209, 242, 235); padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
                <ul style='color: rgb(23, 165, 137); font-weight: bold;'>";
        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>
              <a href='ejercicio2.php' style='display: inline-block; padding: 10px 20px; background-color: rgb(72, 201, 176); color: white; text-decoration: none; border-radius: 4px;'>Volver al formulario</a>
              </div>";
    }
} else {
    echo "<div style='color: rgb(23, 165, 137); font-weight: bold;'>No se ha enviado el formulario.</div>";
}
?>
