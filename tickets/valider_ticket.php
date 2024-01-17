<?php
$idTicket= $_GET['id'];
$flag = $_GET['flag'];

require_once '../include/database.php';   

$sqlstm = $pdo -> prepare('UPDATE tickets
                           SET valider=?
                           WHERE id_ticket =?
                         ');

$sqlstm -> execute([$flag,$idTicket]);

header( "location:".$_SERVER['HTTP_REFERER']);


                         




