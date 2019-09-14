<?php include '../includes/db.php'?>
<?php
$urid=$_POST['urid'];
$sql="update result set attempted=1 where id=$urid";
$a=mysqli_query($connection,$sql);
echo $a;
 ?>
