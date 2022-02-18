<?php 
require_once('connections.php');
try{
// ===================== select query
$selectquery="select * from admin";
$stdetails=$dbcon->prepare($selectquery);
$result=$stdetails->fetch(PDO::FETCH_ASSOC);
$stdetails->execute();
//echo'My name is '.$result['username'];

}catch(PDOException $e){
echo 'Error:'.$e->getMessage();
}

?>
<table border="1" width="100%">
<tr><th>Sr.No.</th><th>Name</th><th>Email</th></tr>
<?php
while ($rows=$stdetails->fetch(PDO::FETCH_ASSOC)) {
?>
    <tr>
      <td><?php echo $rows['id']; ?></td>
      <td><?php echo $rows['username']; ?></td>
      <td><?php echo $rows['email']; ?></td>
  </tr>
<?php
 }
?>
</table>