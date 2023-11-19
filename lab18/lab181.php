<?php
function verificar_password_strenght($contraseña){
    if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $contraseña)){
        //echo "Su password es seguro.";
        ?>
        <h2>Su password es seguro.</h2>
        <script>
            setTimeout(function() {
                alert("Un alto nivel de seguridad en la contraseña evita vulnerabilidades, muy bien ");
            // Add your redirection or next action here
            //window.location.href = "lab181.php";
            }, 100);
        </script>
        <?php
    }else{
        //echo "Su password no es seguro.";
    }
}

function verificar_email($email){
    if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)){
        return true;
    }else {
        return false;
    }
}

function verificar_ip($ip){
    return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" .
    "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip );
}
if(array_key_exists('enviar', $_POST)){
    //include('class_lib.php');
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $confcontraseña = $_POST['confcontraseña'];
    //--------------------------------------
    $contraseña = $_POST['contraseña'];
    $email = $_POST['email'];
    $ip = $_POST['ip'];


    if (empty($nombre) || empty($apellido) || empty($contraseña) || empty($confcontraseña) || empty($email) || empty($ip)) {
        echo "Por favor, complete todos los campos.";
    } else {
        
        verificar_password_strenght($contraseña);
        verificar_email($email);
        verificar_ip($ip);

        // Valida email
        if (!verificar_email($email)) {
            echo "Por favor, ingrese un correo electrónico válido.";
        }

        // Valida IP address
        if (!verificar_ip($ip)) {
            echo "Por favor, ingrese una dirección IP válida.";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 18.1</title>
    <link rel="stylesheet" href="lab18.css">
</head>
<body>
    <form action="lab181.php" method="post">
        <div>
            Nombre: <input type="text" name="nombre" id="nombre" placeholder="  escribe tu nombre" require>
        </div>
        <br>
        <div>
            Apellido: <input type="text" name="apellido" id="apellido" placeholder="  escribe tu apellido" require>
        </div>
        <br>
        <div>
            Email: <input type="email" name="email" id="email" placeholder="  @gmail" require>
        </div>
        <br>
        <div>
            Contraseña: <input type="text" name="contraseña" id="contraseña" placeholder="  contraseña" require>
        </div>
        <br>
        <div>
            Confirme Contraseña: <input type="text" name="confcontraseña" id="confcontraseña" placeholder="  confirma contraseña" require>
        </div>
        <br>
        <div>
            IP actual del equipo: <input type="text" name="ip" id="ip" placeholder="  0 . 0 . 0 . 0 " require>
        </div>
        <br>
        <div>
            <button name="enviar" type="submit">REGISTRAR USUARIO</button>
        </div>
    </form>
</body>
</html>
