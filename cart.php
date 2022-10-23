<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'Cantidad de productos actualizados!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Carrito</title>
   <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />

     <!-- font awesome cdn link uso de iconos -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- estilo de css   -->
<link rel="stylesheet" href=".///css/styleAirness.css">

</head>
<body>

<?php @include 'header.php'; ?>


<section class="heading">
    <h3>Carrito de compras</h3>
    <p> <a href="home.php">Inicio</a> / Carrito </p>
</section>

<section class="shopping-cart">

    <h1 class="title">Productos añadidos</h1>

    <div class="box-container">


    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    ?>

    <div class="box">

        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Eliminar de la lista de deseos?');"></a>
        <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
        <img src="imagenes_subidas/<?php echo $fetch_cart['image']; ?>" alt="" class="image">
        <div class="name"><?php echo $fetch_cart['name']; ?></div>
        <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
        <form action="" method="post">
                <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
                <input type="submit" value="Acualizar" class="option-btn" name="update_quantity">
        </form>
        <div class="sub-total"> sub-total : <span>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
        
    </div>


    <?php
        $grand_total += $sub_total;
        }
    }else{
        echo '<p class="empty">Tu carrito esta vacio</p>';
    }
    ?>
    </div>

    <div class="more-btn">
        <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('Desea eliminar todo del carrito?');">Vaciar carrito</a>
    </div>

    <div class="cart-total">
        <p>Cuenta total : <span>$<?php echo $grand_total; ?>/-</span></p>
        <a href="shop.php" class="option-btn">Continuar comprando</a>
        <a href="cart
        .php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>">Iniciar el pago</a>
    </div>

</section>




<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>

</body>
</html>