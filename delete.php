<?php 
require_once('connections.php');
// ========================delete query 
$deletedetails="delete from studentdetails where id='' ";
$dbcon->query($deletedetails);
// ===================== select query
$selectquery="select * from studentdetails";
$stdetails=$dbcon->query($selectquery);
$result=$stdetails->fetch(PDO::FETCH_ASSOC);
print_r($result);


?>

