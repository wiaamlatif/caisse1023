<?php
// calling by navAdmin.php
// xzPeriode -> Manager;Horaire;Journalier;Semaine,Mois
// xzUact -> Articles;Users;Categories;Tickets
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">  
</head>
<body>
<?php include '../include/navAdmin.php';?>

<?php 

    // Initialise Variables
    $classAlert="alert alert-primary py-2 mx-2 w-50";
    
    $displayUact="display:none";
    $displayXz="display:none";
    $displayResetOk="display:none";

    $message="ETAT des X/Z";
    $xzPeriode="Choisir Manager, Horaire, Journalier, Semaine, Mois ?"; 
    $xzUact="Choisir User, Article, Categorie ou Ticket ?";
    $xz="X ou Z ?"; 

     
    if(isset($_SESSION['user']['xzPeriode'])){
      $classAlert="alert alert-success w-50";
      $xzPeriode=$_SESSION['user']['xzPeriode']; 
      $message ="Etat ".lcfirst($xzPeriode);  
      $displayUact="display:block";          
    } 
 
  
    if(isset($_SESSION['user']['xzUact'])){
      $xzUact=$_SESSION['user']['xzUact'];             
      $message.=" / ".lcfirst($xzUact);
      $displayXz="display:block";
      $displayResetOk="display:block";            
    } 
    
    if(isset($_SESSION['user']['xz'])){
      $xz=$_SESSION['user']['xz'];           
      $message=$xz." ".$xzPeriode." / ".lcfirst($xzUact)."s";
    }
    
    //var_dump($_SESSION);
  
?>

  <div class="container py-2">
    <div class="d-flex flex-column justify-content-center mb3 my-2">
      
      <div class="d-flex flex-column align-content-center mx-2">

        <div class="<?=$classAlert?>" role="alert">
          <h3><?=$message?></h3>
        </div>
       
        <div class="py-2 mx-2" id="xzPeriodeDiv">
          <form action="xzSession.php" method="post">
            <select class="btn btn-success  btn-sm mx-2" name="xzPeriode" id="xzPeriode" onchange="xz_Periode()">
              <option value="" disabled selected><?=$xzPeriode?></option>
              <option value="Manager">Manager </option>
              <option value="Horaire">Horaire </option>
              <option value="Jour">Jour</option>
              <option value="Semaine">Semaine </option>
              <option value="Mois">Mois</option>
            </select>          
            <input type="submit" name="submit" id="btnXzPeriode" style="display:none;">
          </form>
        </div>

        <div class="py-2 mx-2" id="xzUactDiv" style="<?=$displayUact?>">
          <form  action="xzSession.php" method="post" >
            <select class="btn btn-success btn-sm mx-2" name="xzUact" id="xzUact" onchange="xz_Uact()">            
              <option value="" disabled selected style=""><?=$xzUact?></option>
              <option value="User">User</option>
              <option value="Article">Article </option>
              <option value="Categorie">Categorie</option>
              <option value="Ticket">Ticket </option>                    
            </select>
            <input type="submit" name="submit"  id="btnXzUact" style="display:none;">          
          </form>
        </div>

        <div class="py-2 mx-2" id="xzDiv" style="<?=$displayXz?>">
          <form action="xzSession.php" method="post">
            <select class="btn btn-primary  btn-sm mx-2" name="xz" id="xz" onchange="xz_Etat()">                        
              <option value="" disabled selected><?=$xz?></option>
              <option value="X">X</option>
              <option value="Z">Z</option>  
            </select>
            <input type="submit" name="submit"  id="btnXz" style="display:none;">          
          </form>
        </div>
    
        <div class="py-2 mx-2" id="ResetOkDiv" style="<?=$displayResetOk?>">
          <form action="xzSession.php" method="post">         
            <input class="btn btn-danger btn-sm mx-1" type="submit" name="reset"  id="reset" value="Reset">          
            <input class="btn btn-success btn-sm" type="submit" name="okGetEtat"  id="okGetEtat" value="OK">          
          </form>        
        </div>

             
      </div>

    </div>
  </div>

<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>



