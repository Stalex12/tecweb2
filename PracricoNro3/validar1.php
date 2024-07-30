<?php
if (isset($_POST['submit'])) {
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $descripcion_proyecto = $_POST['descripcion_proyecto'];
    $documento_proyecto = $_FILES['documento_proyecto'];

    $doc_name = basename($documento_proyecto['name']);
    $doc_type = $documento_proyecto['type'];
    $doc_size = $documento_proyecto['size'];
    $doc_tmp_name = $documento_proyecto['tmp_name'];
    $doc_error = $documento_proyecto['error'];

    $allowed_types = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $max_size = 5 * 1024 * 1024; // 5 MB

    $errors = [];

    if (!preg_match('/^[a-zA-Z0-9 ]+$/', $nombre_proyecto)) {
        $errors[] = "El nombre del proyecto debe contener solo letras, números y espacios.";
    }

    if (strlen($descripcion_proyecto) < 50) {
        $errors[] = "La descripción del proyecto debe tener un mínimo de 50 caracteres.";
    }

    if (!in_array($doc_type, $allowed_types)) {
        $errors[] = "El documento del proyecto debe ser un archivo PDF o DOCX.";
    }
    if ($doc_size > $max_size) {
        $errors[] = "El documento del proyecto no debe exceder los 5 MB.";
    }

    if (empty($errors)) {
        $upload_dir = 'practica_3/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $unique_name = $nombre_proyecto . '_' . date('YmdHis') . '.' . pathinfo($doc_name, PATHINFO_EXTENSION);
        $doc_dest = $upload_dir . $unique_name;

        if (move_uploaded_file($doc_tmp_name, $doc_dest)) {
            echo "<div style='background-color: rgb(209, 242, 235); padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;'>
                    <h1 style='color: rgb(19, 141, 117);'>Proyecto Subido Exitosamente</h1>
                    <p style='font-size: 18px; color: rgb(23, 165, 137);'>Nombre del Proyecto: " . htmlspecialchars($nombre_proyecto) . "</p>
                    <p style='font-size: 18px; color: rgb(23, 165, 137);'>Descripción del Proyecto: " . htmlspecialchars($descripcion_proyecto) . "</p>
                    <a href='$doc_dest' style='display: inline-block; padding: 10px 20px; background-color: rgb(72, 201, 176); color: white; text-decoration: none; border-radius: 4px;'>Ver Documento</a><br><br>
                    <a href='ejercicio1.php' style='display: inline-block; padding: 10px 20px; background-color: rgb(72, 201, 176); color: white; text-decoration: none; border-radius: 4px;'>Volver al formulario</a>
                  </div>";
        } else {
            echo "<div style='color: rgb(23, 165, 137); font-weight: bold;'>Error al subir el archivo.<br></div>";
        }
    } else {
        echo "<div style='color: rgb(23, 165, 137); font-weight: bold;'><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul></div>";
    }
} else {
    echo "<div style='color: rgb(23, 165, 137); font-weight: bold;'>No se ha enviado el formulario.</div>";
}
?>
