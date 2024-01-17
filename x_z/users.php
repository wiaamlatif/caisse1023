<?php
// Calling by routeXZ.php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
die();*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste Commandes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
</head>
<body>
    <?php include '../include/navAdmin.php';?>

    <?php

    $xz=$_SESSION['user']['xz'];

    if($xz=="X"){      
      $actionXZ="usersX.php";
      $valueXZ="Etat X";
    }      
     elseif($xz=="Z"){
      $actionXZ="usersZ.php";
      $valueXZ="Etat Z";
    }  

//tickets 1:id_ticket     2:id_user 3:id_z  4:nr_ticket
//        5:total_ticket  6:date_ticket     7:valider
    ?>  
     
    <div class="container py-2">

      <h4>Liste Users</h4>

      <table class="table table-striped table-hover">

        <thead>
        <tr><!-- table row--->
        <th width="20%">Id_user</th><!-- table head--->
        <th width="20%">Login</th>
        <th width="20%">Password</th>
        <th width="20%">Date</th>
        <th width="20%">Action</th>
        </tr>
        </thead>

        <tbody>
          <?php 
            require_once '../include/database.php';      
            $sqlstm = $pdo -> query('SELECT * FROM users')

            -> fetchAll(PDO::FETCH_ASSOC);      
            foreach ($sqlstm as $row) {  
          ?>  
          <tr>
            <td><?=$row['id_user']?></td>
            <td><?=$row['login']?></td>
            <td><?=$row['password']?></td>
            <td><?=$row['created_at']?></td>
            <td><?= date_format(date_create($row['created_at']),format:'d/m/y' )?></td>

            <td>
              <div class="d-flex py-2">
                <form action="<?=$actionXZ?>" method="post">             
                <input type="hidden" name="idUser" value="<?=$row['id_user']?>">
                <input type="hidden" name="login" value="<?=$row['login']?>">          
                <input type="submit" value="<?=$valueXZ?>" name="xzUser" class="btn btn-success btn-sm mx-1">
                </form>
              </div>  
            </td>
          </tr>  
          <?php     
          }                             
          ?>          
        </tbody>        
      </table>      

    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>