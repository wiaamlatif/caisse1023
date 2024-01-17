<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
</head>
<body>
    <?php include '../include/navConnexion.php';?>

    <?php

       if(isset($_POST['add'])){
         $login= $_POST['login'];
         $pwd= $_POST['password'];

         $date = date( format:'Y-m-d');

         if(!empty($login) && !empty($pwd)){

          require_once '../include/database.php';

          $sqlstm = $pdo -> prepare('INSERT INTO users (login,password,created_at) 
                                     VALUES (?,?,?)');
                                    
          $sqlstm -> execute([$login,$pwd,$date]);

         //Redirection
         // header('location:C:\caisse1023\index.php');
           
         } else
         {
          ?>      

          <div class="alert alert-danger" role="alert">
            Login et mot de passe sont obligatoires
          </div>

          <?php      
         }
       }

    ?>

    <div class="container py-2">

    <h3>Inscription</h3>

      <form method="post">

        <label class="form-label">Login</label>
        <input type="text" class="form-control" name="login">

        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">

        <input type="submit" value="Add User" class="btn btn-primary my-2" name="add">

      </form>

    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>