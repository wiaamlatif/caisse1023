<?php 
    session_start();

    if(isset($_SESSION['user']['xz'])){

      $xz=$_SESSION['user']['xz'];           
      $xzPeriode=$_SESSION['user']['xzPeriode']; 
      $xzUact=$_SESSION['user']['xzUact'];
              
    } else {
      header("Location:".$_SERVER['HTTP_REFERER'].""); 
    }

    switch ($xzPeriode) {
      case 'Manager':
        xz_manager($xz,$xzUact);
        break;
      case 'Horaire':
        echo "Horaire";
        break;
      case 'Jour':
        echo "Jour";
        break; 
      case 'Mois':
        echo "Mois";
        break;
    }//switch
    
function xz_manager($xz,$xzUact){

  switch ($xzUact) {
    
    case 'User':  
      header("Location:users.php");
    break;      
     
    case 'Article': 

      if($xz=="X"){      
          header("Location:articlesX.php");}      
        elseif($xz=="Z"){
          header("Location:articlesZ.php");
      }      

    break;

    case 'Categorie':
      echo "Categorie";
    break; 

    case 'Ticket':
      echo "Ticket";
    break;

  }//switch  

}//function xz_manager


?>

 




