<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong> <a href="<?php echo FRONT_ROOT; ?>Home">MacProven</a>
          </strong>
     </span>
     <ul class="navbar-nav ml-auto">

     <?php if(isset($_SESSION['userLogged'])) { ?>
        
         <?php if(isset($_SESSION['userLogged']) && $_SESSION['userLogged']->getIsAdmin() == 0 ){?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Ticket/showGetTicketsFromClient">Mis Tickets</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>PurchaseLine/showCurrentPurchaseLines">Mi carrito</a>
          </li>
         <?php }else { ?>
            <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Home/extranet">Extranet</a>
         </li> <?php } ?>
          <li class="nav-item">   
               <a class="nav-link" href="<?php echo FRONT_ROOT; ?>User/Logout">Cerrar sesión</a>
                <?php } else{?>
                    <a class="nav-link" href="<?php echo FRONT_ROOT; ?>User/showLogin">Login</a>
                    <a class="nav-link" href="<?php echo FRONT_ROOT; ?>User/showAddUser">Sign In</a>
                <?php } ?>
          </li>
     </ul>
</nav>
