<?php 
require_once('connections.php');
// ========================insert query 
$updatedetails="update studentdetails set name='Reema' where id=''";
$dbcon->query($updatedetails);
//$dbcon->exec(updatedetails);
// ===================== select query
$selectquery="select * from studentdetails";
$stdetails=$dbcon->query($selectquery);
$result=$stdetails->fetch(PDO::FETCH_ASSOC);
print_r($result);
//echo'My name is '.$result['name'];

?>