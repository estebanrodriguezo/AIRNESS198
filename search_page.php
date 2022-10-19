<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Busqueda</title>
   <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />
   <!-- font awesome cdn link uso de iconos -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- estilo de css   -->
<link rel="stylesheet" href=".///css/styleAirness.css">

</head>
<body>

   
<?php @include 'header.php'; ?>


<section class="heading">
    <h3>Pagina de busqueda</h3>
    <p> <a href="home.php">Inicio</a> / buscar </p>
</section>

<section class="search-form">
    <form action="" method="POST">
        <input type="text" class="box" placeholder="Buscar producto..." name="search_box">
        <input type="submit" class="btn" value="Buscar" name="search_btn">
    </form>
</section>

<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>

</body>
</html>

