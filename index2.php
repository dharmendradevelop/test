<?php 
try{
$server='localhost';
$user='root';
$password='';
$db='phppdo';
$dbcon=new PDO("mysql:host=$server; dbname=$db", $user, $password);
// ========================insert query 
$insertdetails="insert into studentdetails(name,age,gender,class,mobile) values('Geeta',14,'Female',9,'9898876567')";
// $dbcon->query($insertdetails);
$dbcon->exec($insertdetails);
// ===================== select query
$selectquery="select * from studentdetails where id='3'";
$stdetails=$dbcon->query($selectquery);
// $result=$stdetails->fetch(PDO::FETCH_ASSOC); // key value show
// $result=$stdetails->fetch(PDO::FETCH_NUM); // index value show
$result=$stdetails->fetch(PDO::FETCH_OBJ);
print_r($result);
echo'My name is '.$result->name;

}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
}

?>