<?php 
if(isset($_POST['nombre']) && isset($_POST['password'])){

    $nombre = "Galleta";

    $valor = $_POST['nombre'].'|'.$_POST['password'];

    $fecha = time()+(60*60*24);

    setcookie($nombre,$valor,$fecha);

}else{
    $recordar = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="nombre"> <br>
        
        <?php 
        if(isset($_COOKIE['Galleta'])){
            $datos = $_COOKIE['Galleta'];
            $datos_array = explode('|',$datos);
            $contrasena = substr($datos_array[1], 0, 3);
            $recordar = "on";
        }
        ?>
        
        <input type="text" name="password" value="<?php 
        echo ($recordar == "on" ? $contrasena : ""); ?>"> <br>
        
        <input type="checkbox" name="recordar"
        <?php 
        if($recordar == "on"){
            echo "checked";
        }else{
            echo "";
        }
        ?>
        > Recordarme

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
