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
   <title>Pedidos</title>

   <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />

     <!-- font awesome cdn link uso de iconos -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- estilo de css   -->
    <link rel="stylesheet" href=".///css/styleAirness.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Tus pedidos</h3>
    <p> <a href="home.php">Inicio</a> / Pedidos </p>
</section>

<section class="placed-orders">

    <h1 class="title">Pedidos realizados</h1>

    <div class="box-container">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="box">
        <p> fecha del pedido : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
        <p> nombre : <span><?php echo $fetch_orders['name']; ?></span> </p>
        <p> celular : <span><?php echo $fetch_orders['number']; ?></span> </p>
        <p> correo : <span><?php echo $fetch_orders['email']; ?></span> </p>
        <p> direccion : <span><?php echo $fetch_orders['address']; ?></span> </p>
        <p> metodo de pago : <span><?php echo $fetch_orders['method']; ?></span> </p>
        <p> tus pedidos : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
        <p> precio total : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
        <p> estado de pago : <span style="color:<?php if($fetch_orders['payment_status'] == 'pendiente'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">no hay pedidos realizados aun!</p>';
    }
    ?>
    </div>

</section>



<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>

</body>
</html>