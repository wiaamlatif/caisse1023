<?php
//Liste des articles vendus depuis la derniere MAZ du manager
//Un article -> Les Nr des Tickets date et le nom de user
if(isset($_POST['detailArticle'])){

  $idProduct=$_POST['idProduct'];
  $imgSrc=$_POST['imgSrc'];
  $nameProduct=$_POST['nameProduct'];
  $message=$nameProduct;

//tickets 1:id_ticket     2:id_user 3:id_z  4:nr_ticket
//        5:total_ticket  6:date_ticket     7:valider  

//lignes_ticket 1:id_ligne_ticket  2:id_ticket  3:id_product
//              4:price            5:quantity   6:total_ligne
require_once '../include/database.php';      
      
$sqlstm = $pdo -> prepare('SELECT * FROM lignes_ticket
                           INNER JOIN tickets  ON lignes_ticket.id_ticket = tickets.id_ticket
                           INNER JOIN users    ON users.id_user = tickets.id_user
                           INNER JOIN products ON lignes_ticket.id_product = products.id_product

                           WHERE lignes_ticket.id_product = ?;');

$sqlstm -> execute([$idProduct]);

$produits = $sqlstm -> fetchAll(PDO::FETCH_ASSOC);  

//echo "<pre>";
//var_dump($produits);
//echo "</pre>";

} else {
  header("Location:".$_SERVER['HTTP_REFERER'].""); 
}

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
    $classAlert="alert alert-info py-2 mx-2 w-25";
    
    if(isset($_SESSION['user']['xz'])){
      

    } else {
      header("Location:".$_SERVER['HTTP_REFERER'].""); 
    }
            
    //var_dump($_SESSION);
  
?>

  <div class="container py-2">
    <div class="d-flex flex-column justify-content-center mb3 my-2">
      
      <div class="d-flex flex-column align-content-center mx-2">

        <div class="d-flex flex-row align-items-center">

          <div class="py-2">
            <img class="img img-fluid" src="../uploads/products/<?=$imgSrc?>" width="70px" alt="">
          </div>

          <div class="<?=$classAlert?>" role="alert">
            <h6><?=$message?></h6>
          </div>

        </div>

        <table class="table table-striped table-hover">
          <thead>
            <tr><!-- table row--->
              <th>id_ticket</th><!-- table head--->       
              <th>Nr_ticket</th>          
              <th>User</th>          
              <th style="text-align:center;">Quantite</th> 
              <th>Prix</th> 
              <th>Total</th>          
             
            </tr>
          </thead>
          <tbody>
            <?php   

                $totalItem=0;
                $totalTicket=0;               
                foreach ($produits as $row){ 
                  $totalTicket+=$totalItem;           
            ?>              
              <tr>
                  <td><?=$row['id_ticket']?></td>

                  <td><?=$row['nr_ticket']?></td>
  
                  <td><?=$row['login']?></td>

                  <td style="text-align:center;"><?=$row['quantity']?></td>

                  <td><?=$row['price']?></td>

                  <td class="tdtotalItem"><?= $totalItem ?></td>                  
              </tr>  
            <?php     
                }                             
            ?>          
          </tbody> 
          <tfoot>
            <tr>
              <th colspan="5" style="text-align:right;" ><strong>Total</strong></th>
              <th id="thtotalTicket"><strong><?=$totalTicket?></strong></th>
            </tr>    
            <tr>
              <th colspan="5" style="text-align:right;" >
                <form action="#" method="post">
                  <input type="hidden" name="nr_ticket" value="<?=$lastNumTicket?>">
                  <input type="hidden" name="total_ticket" value="<?=$totalTicket?>">
                  <input type="submit" name="valider" class="btn btn-success" value="Valider Z">
                  <input type="submit" name="vider"   class="btn btn-danger" value="Annuler" onclick="return confirm('Confirmer vider panier?')">
                </form>            
              </th>          
            </tr>    
          </tfoot> 
        </table>        

<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>



