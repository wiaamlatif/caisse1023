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
//tickets 1:id_ticket     2:id_user 3:id_z  4:nr_ticket
//        5:total_ticket  6:date_ticket     7:valider
    ?>   

    <div class="container py-2">

    <h4>Liste des tickets</h4>

    <table class="table table-striped table-hover">
      <thead>
        <tr><!-- table row--->
          <th>Id_user</th><!-- table head--->
          <th>Login</th>
          <th>Nr_ticket</th>         
          <th>Total Ticket</th>     
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>

      <?php 
          require_once '../include/database.php';   

          $sqlstm = $pdo -> query(' SELECT *
                                    FROM tickets
                                    INNER JOIN users ON tickets.id_user = users.id_user 
                                    ORDER BY tickets.id_ticket 
                                    DESC ;')                                  

          -> fetchAll(PDO::FETCH_ASSOC);      

          foreach ($sqlstm as $row) {  
      ?>              
        <tr>
           <td><?=$row['id_ticket']?></td>
           <td><?=$row['login']?></td>
           <td><?=$row['nr_ticket']?></td>
           <td><?=$row['total_ticket']?> MAD</td>           
           <td><?=$row['date_ticket']?></td>

           <td>
             <a href="detail_ticket.php?id=<?=$row['id_ticket']?>" class="btn btn-primary btn-sm">Detail</a>
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