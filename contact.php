<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'Este mensaje ya fue enviado!';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'El mensaje fue enviado!';
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contactanos</title>
   <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />
   <!-- font awesome cdn link uso de iconos -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- estilo de css   -->
<link rel="stylesheet" href=".///css/styleAirness.css">

</head>
<body>

   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>contactanos</h3>
    <p> <a href="home.php">Inicio</a> / contactanos </p>
</section>

<section class="contact">

    <form action="" method="POST">
        <h3>Envianos un mensaje!</h3>
        <input type="text" name="name" placeholder="Ingrese su nombre" class="box" required> 
        <input type="email" name="email" placeholder="Ingrese su correo" class="box" required>
        <input type="number" name="number" placeholder="Ingrese su celular" class="box" required>
        <textarea name="message" class="box" placeholder="Ingrese su mensaje" required cols="30" rows="10"></textarea>
        <input type="submit" value="Enviar" name="send" class="btn">
    </form>

</section>



<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>

</body>
</html>

