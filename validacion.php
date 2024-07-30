<?php
if (isset($_POST['submit'])) {

    $pdf = $_FILES['pdf'];
    $pdf_name = basename($pdf['name']);
    $pdf_type = $pdf['type'];
    $pdf_size = $pdf['size'];
    $pdf_tmp_name = $pdf['tmp_name'];
    $pdf_error = $pdf['error'];

    $foto = $_FILES['foto'];
    $foto_name = basename($foto['name']);
    $foto_type = $foto['type'];
    $foto_size = $foto['size'];
    $foto_tmp_name = $foto['tmp_name'];
    $foto_error = $foto['error'];

    $nombre = $_POST['nombre'];

    $allowed_pdf_type = 'application/pdf';
    $allowed_foto_type = 'image/png';
    $max_pdf_size = 40 * 1024 * 1024; // 40 MB
    $max_foto_size = 2 * 1024 * 1024; // 2 MB

    $errors = [];

    if ($pdf_type != $allowed_pdf_type) {
        $errors[] = "Error: El archivo PDF debe ser un archivo .pdf.";
    }
    if ($pdf_size > $max_pdf_size) {
        $errors[] = "Error: El archivo PDF no debe exceder los 40 MB.";
    }

    if ($foto_type != $allowed_foto_type) {
        $errors[] = "Error: La foto debe ser un archivo .png.";
    }
    if ($foto_size > $max_foto_size) {
        $errors[] = "Error: La foto no debe exceder los 2 MB.";
    }

    if (empty($errors)) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $pdf_dest = $upload_dir . $pdf_name;
        $foto_dest = $upload_dir . $foto_name;

        if (move_uploaded_file($pdf_tmp_name, $pdf_dest) && move_uploaded_file($foto_tmp_name, $foto_dest)) {
            echo "<div style='background-color: #f0f0f0; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;'>
                    <h1 style='color: #333;'>Resultados del Formulario</h1>
                    <p style='font-size: 18px; color: #555;'>Nombre: " . htmlspecialchars($nombre) . "</p>
                    <img src='$foto_dest' alt='Foto' style='max-width: 100%; height: auto; border: 2px solid #ccc; border-radius: 8px;'><br><br>
                    <embed src='$pdf_dest' type='application/pdf' style='width: 100%; height: 400px; border-radius: 8px;'><br><br>
                    <a href='formulario3.php' style='display: inline-block; padding: 10px 20px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;'>Volver al formulario</a>
                  </div>";
        } else {
            echo "<div style='color: #dc3545; font-weight: bold;'>Error al subir los archivos.<br></div>";
        }
    } else {
        echo "<div style='color: #dc3545; font-weight: bold;'><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul></div>";
    }
} else {
    echo "<div style='color: #dc3545; font-weight: bold;'>No se ha enviado el formulario.</div>";
}
?>
