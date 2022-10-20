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

    </form>


    <?php
        $grand_total += $fetch_wishlist['price'];
        }
    }else{
          echo '<p class="empty">Tu lista de deseos esta vacia</p>';
    }
    ?>
    </div>

    </section>



<?php @include 'footer.php'; ?>

<script src="./js/script.js"></script>
</body>
</html>