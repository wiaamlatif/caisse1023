<?php
$idTicket=$_GET['id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Ticket <?= $idTicket ?></title>
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

      <h4>Detail Ticket (<?=$idTicket?>)</h4>

      <table class="table table-striped table-hover">
        <thead>
          <tr><!-- table row--->
            <th>Id_ticket</th><!-- table head--->
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
              $sqlstm = $pdo -> prepare('SELECT * FROM tickets
                                        INNER JOIN users ON tickets.id_user = users.id_user 
                                        WHERE tickets.id_ticket = ?;');                                    
              
              $sqlstm -> execute([$idTicket]);

              $myTicket = $sqlstm ->fetch(PDO::FETCH_OBJ);                
          ?> 

          <tr>
            <td><?=$myTicket -> id_ticket?></td>
            <td><?=$myTicket -> login?></td>
            <td><?=$myTicket -> nr_ticket?></td>
            <td><?=$myTicket -> total_ticket?> MAD</td>        
            <td><?=$myTicket -> date_ticket?></td>

            <?php if($myTicket -> valider == 0) {    ?>
            <td>
              <a href="valider_ticket.php?id=<?=$idTicket?>&flag=1" class="btn btn-success btn-sm">Valider Ticket</a>
            </td>
            <?php } elseif($myTicket -> valider == 1){   ?>
            <td>
              <a href="valider_ticket.php?id=<?=$idTicket?>&flag=0" class="btn btn-danger ?> btn-sm">Annuler Ticket</a>
            </td>
            <?php }   ?>

          </tr>  

        </tbody>        
      </table>

      <table class="table table-striped table-hover">
          <thead>
            <tr><!-- table row--->
              <th>Id_ligne_ticket</th><!-- table head--->
              <th>Nom prd</th>
              <th>Price</th>
              <th>Qty</th>
              <th>total</th>          
            </tr>
          </thead>
          <tbody>

            <?php 
                //lignes_ticket 1:id_ligne_ticket  2:id_ticket  3:id_product
                //              4:price            5:quantity   6:total_ligne
            
                $sqlstm = $pdo -> prepare('SELECT * FROM lignes_ticket
                                          INNER JOIN products ON lignes_ticket.id_product = products.id_product
                                          WHERE lignes_ticket.id_ticket = ?;');

                $sqlstm -> execute([$idTicket]);
              
                $produits = $sqlstm -> fetchAll(PDO::FETCH_ASSOC);      

                foreach ($produits as $row) {  
            ?> 

            <tr>
              <td><?=$row['id_ligne_ticket']?></td>
              <td><?=$row['name_product']?></td>
              <td><?=$row['price']?></td>         
              <td><?=$row['quantity']?></td>
              <td><?=$row['total_ligne']?> MAD</td>
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