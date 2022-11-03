<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Ya se agrego al carrito';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Producto añadido al carrito';
    }

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    header('location:wishlist.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de deseos</title>
    <link rel="icon" type="image/jpg" href="./Imagenes/airness.jpg" />
    <!-- font awesome cdn link uso de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- estilo de css   -->
    <link rel="stylesheet" href=".///css/styleAirness.css">
</head>
<body>
      
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Lista de deseos</h3>
    <p> <a href="home.php">Inicio</a> / Wishlist </p>
</section>

    <section class="wishlist">

    <h1 class="title">Productos añadidos</h1>

    <div class="box-container">


    <?php
        $grand_total = 0;
        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_wishlist) > 0){
            while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
    ?>

    <form action="" method="POST" class="box">
    <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('Eliminar de la lista de deseos?');"></a>
    <a href="view_page.php?pid=<?php echo $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
    <img src="imagenes_subidas/<?php echo $fetch_wishlist['image']; ?>" alt="" class="image">
    <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
    <div class="price">COP <?php echo $fetch_wishlist['price']; ?>/-</div>
    <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['pid']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
    <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
    <input type="submit" value="Añadir al carrito" name="add_to_cart" class="btn">

    </form>


    <?php
        $grand_total += $fetch_wishlist['price'];
        }
    }else{
          echo '<p class="empty">Tu lista de deseos esta vacia</p>';
    }
    ?>
    </div>

    <div class="wishlist-total">
        <p>Cuenta total : <span>COP <?php echo $grand_total; ?>/-</span></p>
        <a href="shop.php" class="option-btn">Continuar comprando</a>
        <a href="wishlist.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('Desea vaciar la lista de deseos?');">Vaciar lista de deseos</a>
    </div>

</section>



<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>
</body>
</html>