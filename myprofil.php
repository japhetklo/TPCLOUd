<?php
  session_start();
include('includes/session.php');
include('includes/linkdb.php');
$idAdm=$_SESSION['idAdmin'];
$reqAdm=$bdd->query("SELECT * FROM admin WHERE id='$idAdm'");
$resAdm=$reqAdm->fetch();
$idadm=$resAdm['id'];
if (isset($_POST['modif'])) {
  $nom=htmlspecialchars(addslashes(trim($_POST['nom'])));
  $mail=htmlspecialchars(htmlentities(trim($_POST['mail'])));
  $image=htmlspecialchars(htmlentities(trim($_FILES['image']['name'])));
  if (!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_FILES['image'])) {
       $extensionValide=array('png', 'jpg', 'jpeg');
        $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionValide)){
          $chemin="assets/img/admin/".$nom.".".$extensionUpload;
          $imageNom=$nom.".".$extensionUpload;
          $resultat=move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
          if ($resultat) {
                 $reqUp=$bdd->query("UPDATE admin SET nomAdmin='$nom',mail='$mail',photoAdmin='$imageNom' WHERE id='$idadm'");
              if ($reqUp)
             {
               $erreur= '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                Modification fait avec succès.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }else{
              $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Echec de faire la modification, veuillez réessayer à nouveau.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
           
          }else{
            $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Echec,veuillez réssayer à nouveau.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            
          }

        }else{
          $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Le format de ce fichier n\'est pas pris en charge.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }

  }else{
    $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Tous les champs sont obligatoires, veuillez réessayer à nouveau.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
  }
  
}
//Pour changer le mot de passe
if (isset($_POST['changer'])) {
  $password=htmlspecialchars(htmlentities(trim(sha1(md5($_POST['password'])))));
  $newpassword=htmlspecialchars(htmlentities(trim(sha1(md5($_POST['newpassword'])))));
  $confpassword=htmlspecialchars(htmlentities(trim(sha1(md5($_POST['confpassword'])))));
  if (!empty($_POST['password']) AND !empty($_POST['newpassword']) AND !empty($_POST['confpassword'])) {
      if ($newpassword!=$confpassword) {
            $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Vos deux mot de passe doivent être identiques.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
      }else{
         $selPass=$bdd->query("SELECT * FROM admin WHERE password='$password'");
            $result=$selPass->rowCount();
        if ($result==1) {
            if (strlen($_POST['newpassword'])>2) {
             $adm=$selPass->fetch();
              $idadm=$adm['idAdmin'];
              $updPass=$bdd->query("UPDATE admin SET password='$newpassword' WHERE id='$idadm'");
              if ($updPass) {
                $erreur= '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                Mot de pase modifier avec succès.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }else{
                $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Echec de modifier le mot de passe.Réessayer à nouveau.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }
            }else{
              $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Vous devez avoir au moins 3 caractères.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }else{
          $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Vous avez entre mot de passe incorrect.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      }
  }else{
    $erreur= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Tous les champs sont obligatoires, veuillez réessayer à nouveau.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('includes/header.php'); ?>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
      <?php include('includes/nav.php');?>

  </header><!-- End Header -->

  <?php include('includes/menus.php');?>
  <main id="main" class="main">
      <div>
          <?php 
          if (isset($erreur)) {
            echo $erreur;
            }
          ?>
      </div>
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/admin/<?= $resAdm['photoAdmin'] ?>" alt="Profile" class="rounded-circle">
              <h2><?= $resAdm['nomAdmin'] ?></h2>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Voir</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier Profil</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Details Profil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom</div>
                    <div class="col-lg-9 col-md-8"><?= $resAdm['nomAdmin']?></div>
                  </div>

                 

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $resAdm['mail']?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image Profil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/admin/<?= $resAdm['photoAdmin']?>" alt="Profile">
                        <div class="pt-2">
                          
                        </div>
                      </div>
                    </div>
                      <div class="row mb-3">
                      <label for="photo" class="col-md-4 col-lg-3 col-form-label">Photo</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="file" name="image" class="form-control" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="nom" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="nom" class="form-control" required>
                      </div>
                    </div>

                    

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="email" name="mail" class="form-control" required>
                      </div>
                    </div>
                  
                    <div class="text-center">
                      <button type="submit" name="modif" class="btn btn-primary">Modifier</button>
                    </div>
                  </form><!-- End Profile Edit Form -->
                    
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Ancien Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="password"  name="password" class="form-control" id="currentPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="password" name="newpassword" class="form-control" id="newPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmer Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="password" name="confpassword" class="form-control" id="renewPassword" required>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="changer" class="btn btn-primary">Changer Password</button>
                    </div>
                  </form><!-- End Change Password Form -->
            
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('includes/footer.php');?>

  <!-- Vendor JS Files -->
  <?php include('includes/script.php'); ?>

</body>

</html>