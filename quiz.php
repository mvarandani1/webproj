<?php include 'includes/header.php' ?>
<?php include 'includes/commonfunction.php' ?>
<div class="container masthead mt-5">
<?php


if(isset($_GET['user_id']))
{
  $user_id=$_GET['user_id'];
  
if(!checkuserid($connection,$user_id))
{
  echo"<h1>Link Broken Try Again with proper URL</h1>";
  exit;
}
else if(hasattempted($connection,$user_id,getfriendip())>0) {
  $friendid=hasattempted($connection,$user_id,getfriendip());
  header("Location: quizanswers.php?user_id=$user_id&urid=$friendid");
}
}
else {
  echo"<h1>Link Broken Try Again with proper URL</h1>";
  exit;
}
  if(isset($_SESSION['hasQuiz']))
  {
    header("Location:index.php");
  }
 ?>

  <div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8 border border-dark box text-center" style="">
      <div class="h4 mt-3">
        How Well Do You know Mahesh
      </div>
      <div class="guestInfo mt-3 p-3">
        <form action="" method="post">
  <div class="form-group ">
    <label for="name" id="guestName">Name:</label>
    <input type="text" class="form-control" placeholder="For ex: jack" id="name" name="name">
  </div>
  <div class="btnCover mx-3"><input type="submit" id='submitbtn' name='submit' class="btn btn-block btn-secondary" value='submit'/></div>
</form>
      </div>
    </div>
    <div class="col-md-2">

    </div>
</div>
<?php
// Function to get the client IP address
function getfriendip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
    if(isset($_GET['user_id']))
    {
      $user_id=$_GET['user_id'];
      $curr_date = date("Y-m-d H:i:s");
      $friendip=getfriendip();
      $sql="Insert into result (Uid,friendname,datetime,score,friendip) values('$user_id','$name','$curr_date',0,'$friendip')";
      $result=mysqli_query($connection,$sql);
      if($result)
      {
        $friendid=$connection->insert_id;
        $_SESSION['user_id']=$user_id;
        $_SESSION['friendid']=$friendid;
        header('location:quizanswers.php?user_id='.$user_id.'&urid='.$friendid);
      }
      else
      {
        echo"<script>alert('Something went wrong')</script>";
      }
  }

}
 ?>
