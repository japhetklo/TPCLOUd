 <?php

use function PHPSTORM_META\elementType;

 if (isset($_SESSION['idAdmin'])) {
  $idAdm=$_SESSION['idAdmin'];
    $reqAdm=$bdd->query("SELECT * FROM admin WHERE id='$idAdm'");
    $resAdm=$reqAdm->fetch();
 }
  
   ?>
 <div class="d-flex align-items-center justify-content-between">
      <a href="index" class="logo d-flex align-items-center">
  
        <span class="d-none d-lg-block text-uppercase">cloud computing</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

  
 <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
           
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <hr class="dropdown-divider">
            </li>

           

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

       

         

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li>
              <hr class="dropdown-divider">
            </li>

            
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->
        <?php 
if (!empty($resAdm)) :
?>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/admin/<?= $resAdm['photoAdmin'] ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $resAdm['mail']?></span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $resAdm['nomAdmin'] ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="myprofil">
                <i class="bi bi-person"></i>
                <span>My Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="deconnexion">
                <i class="bi bi-box-arrow-right"></i>
                <span>Déconnexion</span>
              </a>
            </li>
            <?php 
endif; 
if (empty($resAdm)) :
?>
<div class="row mb-3" >
<div class="col-sm-12">
<a href="addetudiant.php"><button class="btn btn-primary">crée un compte</button></a>
</div>
</div> 
<?php 
endif;

?>

          </ul>
        </li>

      </ul>
    </nav>