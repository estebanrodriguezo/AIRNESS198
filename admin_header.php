<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>


<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">productos</a>
         <a href="admin_orders.php">ordenes</a>
         <a href="admin_users.php">usuarios</a>
         <a href="admin_contacts.php">mensajes</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="far fa-user-circle"></div>
      </div>

      <div class="account-box">
         <p>Nombre de usuario : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Correo electronico : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">cerrrar sesion</a>
         <div>nuevo <a href="login.php">Iniciar sesion</a> | <a href="register.php">Registrarse</a> </div>
      </div>

   </div>

</header>