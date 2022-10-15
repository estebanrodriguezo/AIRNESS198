<?php

@include 'config.php';

if (isset($_POST['submit'])) {

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, md5($filter_pass));
    $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'Este usuario ya existe!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'La contraseña no coincide !';
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
            $message[] = 'Registro exitoso!';
            header('location:login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />
    <!-- font awesome cdn link uso de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- estilo de css   -->
    <link rel="stylesheet" href=".//css/styleAirness.css">


</head>

<body>


    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
    ?>


    <section class="form-container">

        <form action="" method="post">
            <h3>Registrate</h3>
            <div class="image-wrapper" >
      <img
      
              src="./Imagenes/airness.jpg"
              alt="Our new company logo"
              title="Logo de nuestra pagina"
             
            />
            </div>
            <input type="text" name="name" class="box" placeholder="Ingresar nombre de usuario" required>
            <input type="email" name="email" class="box" placeholder="Ingresar correo electronico" required>
            <input type="password" name="pass" class="box" placeholder="Ingresar contraseña" required>
            <input type="password" name="cpass" class="box" placeholder="Confirmar contraseña" required>
            <input type="submit" class="btn" name="submit" value="Registrarse">
            <p>Ya tienes una cuenta? <a href="login.php">Ingresa ahora</a></p>
        </form>

    </section>

</body>

</html>