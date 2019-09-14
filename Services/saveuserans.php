<?php include '../includes/db.php'?>
<?php
$q_no=$_POST['q_no'];
$clickedoption=$_POST['clickedoption'];
$type=$_POST['type'];
$friendid=$_POST['urid'];
$curr_date = date("Y-m-d H:i:s");
$sql="Insert into friendsans(friendid,q_no,ans,result,date)values($friendid,$q_no,'$clickedoption',$type,'$curr_date')";
mysqli_query($connection,$sql);
 ?>
