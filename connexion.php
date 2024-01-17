<?php
$title ="Connexion";
ob_start();

if(isset($_POST['connexion'])){

     $login = $_POST['login'];
       $pwd = $_POST['password'];

  if(!empty($login) && !empty($pwd)) { 

    require_once 'include/database.php';
    $sqlstmt = $pdo -> prepare("SELECT * FROM users
                                WHERE login = ?
                                and password = ? ");

    $sqlstmt -> execute([$login,$pwd]);

    $user=$sqlstmt -> fetch(PDO::FETCH_ASSOC);

    $find=$sqlstmt->rowCount()>0;

    if($find){

      session_start();
      $_SESSION['user']= $user ; 
            
      header('location:../include/admin.php');          
    } else {
?>
    <div class="alert alert-danger" role="alert">
          Login ou mot de passe incorrects
    </div>
<?php
           }
   } else { 
?>
    <div class="alert alert-danger" role="alert">
      Login et mot de passe sont obligatoires
    </div>
<?php
  }      
}
?>

<?php $content = ob_get_clean(); ?>
<?php include_once 'layout.php'?>