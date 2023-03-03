<?php
session_start();
include('includes/linkdb.php');
if (isset($_POST['submit'])) {
  $nom=htmlspecialchars(addslashes(trim($_POST['nom'])));
  $passw=htmlspecialchars(htmlentities(trim(sha1(md5($_POST['passw'])))));
  if (!empty($_POST['nom'])  AND !empty($_POST['passw'])) {
     $req=$bdd->query("SELECT * FROM admin WHERE nom='$nom'");
    $nm=$req->rowCount();
    if ($nm==1) {
      $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Administrateur existe déjà.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
          
    }else{
    

         
                 $reqIns=$bdd->query("INSERT INTO admin(id,nom,password) VALUES (NULL,'$nom','$passw')");
           
              if ($reqIns)
             {
               $erreur= '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                Administrateur ajouté avec succès.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            else{
              $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Echec d\'enregistrement, veuillez réessayer à nouveau.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
           
          

        }
    }
   
 else{
      $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Tous les champs sont obligatoires
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include('includes/header.php');
  ?>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
      <?php
        include('includes/nav.php');
      ?>
  </header><!-- End Header -->
  <?php
  ?>
  <main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-5">
            <div>
              <?php 
                if (isset($erreur)) {
                  echo $erreur;
                }
               ?>
            </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter un etudiant</h5>

              <!-- General Form Elements -->
              <form method="POST" enctype="multipart/form-data"> 
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <label>Password</label>
                    <input type="password" name="passw" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <input type="submit" name="submit" class="form-control btn btn-primary" value="Enregistrer" >
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        <div class="col-lg-7">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">La liste de tous les etudiants</h5>

              <table class="table datatable overflow-auto">
                <thead>
                  <tr>
                  <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">password</th>
                
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $req1=$bdd->query("SELECT * FROM admin ");
                    foreach ($req1 as $am) {
                     ?>
                     <td scope="row"><?= $am['id']; ?></td>
                    <td scope="row"><?= $am['nom']; ?></td>
                    <td class="overflow-auto"><?= $am['password']; ?></td>
                  
                
                  </tr> 
                  <?php
                    }
                    ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
              

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
    include('includes/footer.php');
  ?>

  <!-- Vendor JS Files -->
  <?php 
    include('includes/script.php');
  ?>

</body>

</html>