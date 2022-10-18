<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>AIRNESS</title>
   <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />
   
    <!-- font awesome cdn link uso de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- estilo de css   -->
    <link rel="stylesheet" href="./css/styleAirness.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Sobre nosotros</h3>
    <p> <a href="home.php">Inicio</a> / Sobre nosotros </p>
</section>


<section class="about">

    <div class="flex">

        <div class="image">
            <img src="./Imagenes/STW.jpg" alt="">
        </div>

        <div class="content">
            <h3>¿Por qué Airness?</h3>
            <p>Por ser una tienda exclusiva con productos premium de marcas como: nike sportswear y lanzamientos únicos y exclusivos en el país, le damos a nuestros clientes y consumidores
            una sensación de ser únicos al momento de vestir y, gracias a que el término hype en terminología coloquial en USA significa valorar al máximo una idea o producto, queremos que
            nuestros clientes sientan el hype con la exclusividad de los mismos.</p>
            <a href="shop.php" class="btn">Comprar ahora</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>¿Qué ofrecemos?</h3>
            <p>Mantener a los clientes actualizados con los nuevos estilos y, ocasionalmente, incluso ofrecer beneficios por su apoyo.</p>
            <a href="contact.php" class="btn">Contactanos</a>
        </div>

        <div class="image">
            <img src="./Imagenes/STW4.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="./Imagenes/STW6.jpg" alt="">
        </div>

        <div class="content">
            <h3>¿Quienes somos?</h3>
            <p>Somos una de las primeras concept stores de Colombia, especializadas en sneakers, sportwear, y accesorios para el día a día. Nuestro objetivo principal es poderle brindar a nuestros clientes los últimos lanzamientos a nivel mundial en cuanto a sneakers y sportwear, acompañándolos paso a paso con la mejor asesoría especializada en cuanto historia, tecnología, rendimiento y comodidad.</p>
        </div>

    </div>

</section>





<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>

</body>
</html>