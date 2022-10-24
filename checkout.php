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
   <title>Pagos</title>

   <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />

     <!-- font awesome cdn link uso de iconos -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- estilo de css   -->
    <link rel="stylesheet" href=".///css/styleAirness.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Proceder a pagar</h3>
    <p> <a href="home.php">Inicio</a> / Pagos </p>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['name'] ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '.$fetch_cart['quantity']  ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">El carrito esta vacio!</p>';
        }
    ?>
    <div class="grand-total">cuenta total : <span>$<?php echo $grand_total; ?>/-</span></div>
</section>


<section class="checkout">

        <form action="" method="POST">
            <h3>Haz tu pedido</h3>

            <div class="flex">
                <div class="inputBox">
                    <span>Tu nombre :</span>
                    <input type="text" name="name" placeholder="Ingresa tu nombre">
                </div>
                <div class="inputBox">
                    <span>Tu celular :</span>
                    <input type="number" name="number" min="0" placeholder="Ingresa tu numero de celular">
                </div>
                <div class="inputBox">
                    <span>Tu correo :</span>
                    <input type="email" name="email" placeholder="Ingresa tu correo electronico">
                </div>
                <div class="inputBox">
                    <span>Metodo de pago :</span>
                    <select name="method">
                        <option value="cash on delivery">Pago contra-entrega</option>
                        <option value="credit card">Tarjeta de credito</option>                        
                        <option value="debit card">Tarjeta de debito</option>
                        <option value="paypal">Paypal</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Direccion 01 :</span>
                    <input type="text" name="flat" placeholder="ejemplo: Edificio, Conjunto recidencial, etc...">
                </div>
                <div class="inputBox">
                    <span>Direccion 02 :</span>
                    <input type="text" name="street" placeholder="ejemplo: calle #32a 80 -18.">
                </div>
                <div class="inputBox">
                    <span>Ciudad :</span>
                    <input type="text" name="city" placeholder="ejemplo: popayan">
                </div>
                <div class="inputBox">
                    <span>Departamento :</span>
                    <input type="text" name="state" placeholder="ejemplo: cauca">
                </div>
                <div class="inputBox">
                    <span>Pais :</span>
                    <input type="text" name="country" placeholder="ejemplo: colombia">
                </div>
                <div class="inputBox">
                    <span>Codigo postal :</span>
                    <input type="number" min="0" name="pin_code" placeholder="ejemplo: 52006">
                </div>
            </div>
            <input type="submit" name="order" value="Ordenar ahora!" class="btn">
        </form>

</section>




<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>

</body>
</html>