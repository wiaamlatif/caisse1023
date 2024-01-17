<?php
  session_start();

  if(!isset($_SESSION['user'])){

    header('location:index.php');            
  
  }

  $currentPage = $_SERVER['PHP_SELF']; 
?>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Caisse Coffee (Admin)</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav fw-bolder">
       
                <li class='nav-item'>
                <a class='nav-link' href='../categories/liste.php'>Categories</a>
                </li>

                <li class='nav-item'>
                <a class='nav-link' href='../products/liste.php'>Products</a>
                </li>
               
                <li class='nav-item'>
                <a class='nav-link' href='../x_z/askXZ.php'>X/Z</a>
                </li>                

                <li class='nav-item'>
                <a class='nav-link' href='#'>Personnels</a>
                </li>

                <li class='nav-item'>
                <a class='nav-link' href='#'>Clients</a>
                </li>                

                <li class='nav-item'>
                <a class='nav-link' href='#'>Users</a>
                </li>                                
                
                <li class='nav-item'>
                <a class='nav-link' href='#'>Front-end</a>
                </li>                

                <li class='nav-item'>
                <a class='nav-link <?php if($currentPage=="/include/deconnexion.php"){echo "active";};?>' href='../include/deconnexion.php'>Deconnexion</a>
                </li>
        
      </ul>
    </div>
  </div>
</nav>

<?php
/*  echo "=======(page:nav.php)=======<br>";
  echo "<pre>==(_SESSION)=======<br>";
  print_r($_SESSION['user']);
  echo "</pre>"; */
?>
