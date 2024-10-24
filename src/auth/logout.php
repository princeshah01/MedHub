<?php

session_start();   // Session start ho rha hai  new  ya tho aagr existing session hai tho woh resume ho raha hai


session_destroy();  // logout kar ne pe session ka data destroy kar rha hai 
$_SESSION = array();  //Session ka sara data ko unset kar raha hai jo v data session mai store hai array k format mai uuse new array se replace kar rha hai 

header("Location: ../../index.php");
exit();

?>