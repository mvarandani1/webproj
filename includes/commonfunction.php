<?php
error_reporting(1);
function checkuserid($connection,$user_id)
{
  $sql="select * from users where u_id='$user_id'";
  $row=mysqli_query($connection,$sql);
  if(mysqli_num_rows($row)>0)
  {
    return 1;
  }
  else {

    return 0;
  }
}
function checkFriendid($connection,$id)
{
  $sql="select * from result id='$id'";
  if(mysqli_num_rows(mysqli_query($connection,$sql))>0)
  {
    return 1;
  }
  else {
    return 0;
  }
}

function hasattempted($connection, $userid, $friendip)
{
  $friendid=0;
  $sql="Select * from result where Uid='$userid' and friendip='$friendip' and attempted=1";
  $row=mysqli_query($connection,$sql);
  if(mysqli_num_rows($row)>0)
  {
    $friendid=$row['id'];
    return $friendid;
  }
  else {
    return 0;
  }
}

 ?>
