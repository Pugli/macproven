<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong> <a href="<?php echo FRONT_ROOT; ?>Home">MacProven</a>
          </strong>
     </span>
     <ul class="navbar-nav ml-auto">
        <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Home/extranet">Extranet</a>
          </li>
         <?php if(isset($_SESSION['userLogged'])){?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Event/showCheckEventForCategory">consultar por categorias</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT?>Event/showCheckEventForDate">consultar por fechas</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Ticket/showGetTicketsFromClient">consultar por artistas</a>
          </li>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Ticket/showGetTicketsFromClient">Mis Tickets</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>PurchaseLine/showCurrentPurchaseLines">Mi carrito</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Purchase/addPurchase">Confirmar Compra</a>
          </li>
          <li class="nav-item">   
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>User/Logout">Cerrar sesión</a>
                <?php } else{?>
                    <a class="nav-link" href="<?php echo FRONT_ROOT; ?>User/showLogin">Login</a>
                <?php } ?>
          </li>
     </ul>
</nav>