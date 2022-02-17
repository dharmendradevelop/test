<?php 
require_once('connections.php');
// ========================insert query 
$insertdetails="insert into studentdetails(name,age,gender,class,mobile) values(:name,:age,:gender,:class,:mobile)";
$stmt=$dbcon->prepare($insertdetails);
$stmt->bindparam(':name',$name);
$stmt->bindparam(':age',$age);
$stmt->bindparam(':gender',$gender);
$stmt->bindparam(':class',$class);
$stmt->bindparam(':mobile',$mobile);
$stmt->exicute();

?>