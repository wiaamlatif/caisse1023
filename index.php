<?php
$title ="Connexion";
ob_start();
?>

<form action="connexion.php" method="post">

<label class="form-label">Login</label>
<input type="text" class="form-control" name="login">

<label class="form-label">Password</label>
<input type="password" class="form-control" name="password">

<input type="submit" value="Connexion" class="btn btn-primary my-2" name="connexion">

</form>

<?php $content = ob_get_clean(); ?>
<?php include_once 'layout.php'?>

<?php
/*
echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/
?>



