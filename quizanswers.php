<?php include 'includes/header.php' ?>
<?php
if(!isset($_GET['user_id'])&&!isset($_GET['urid']))
{
  header('location:quiz.php');
  exit;
}
$GLOBALS['urid']=$_GET['urid'];
$GLOBALS['user_id']=$_GET['user_id'];

 ?>

<header class="masthead  text-center" >
  <div class="container" id='mainwindow'>

<?php
$append="";
$sql="select q_no from friendsans where friendid=$GLOBALS[urid] order by id desc limit 1";
$res=mysqli_query($connection,$sql);
if(mysqli_num_rows($res))
{
  $row=mysqli_fetch_assoc($res);
  $append=" and Qid>".$row['q_no'];

  if($row['q_no']>=9)
  {
    header("location: score.php?urid=$GLOBALS[urid]");
    exit;
  }
}
$user_id=$_GET['user_id'];
$sql="Select * from usersq where Uid='$user_id'".$append;
$anssql=mysqli_query($connection,$sql);
$row=mysqli_fetch_assoc($anssql);

  $q_id=$row['Qid'];
  $question=$row['Question'];
  $color=$row['color'];
 ?>
 <div class="row mt-2" id="questionContainer<?php echo $i ?>">
   <div class="col-md-2 col-sm-2 col-xs">
     &nbsp;
   </div>
   <div class="col-md-8 col-sm-8 col-xs  h-75 p-5 contentmaindiv"  style="background:<?php echo $color ?>">
        <h2 style="color:black">Question <span id='mainqno'><?php echo $q_id+1 ?></span> of 10</h2>
        <div class="mt-3 mb-2 qcover">
          <textarea row="2" class="w-100 font-22 qheight p-8 textq question" name="question<?php echo $i ?>" id="question<?php echo $i ?>" class='Qtext' placeholder="Write Your Question here" autofocus disabled><?php echo $question ?></textarea>
        </div>
        <div class="optioncover mt-3">
        <?php
        $optionQuery="select * from usersoption where Uid='$user_id' and Qid=$q_id";
        $optionans=mysqli_query($connection,$optionQuery);
        while($optionrow=mysqli_fetch_assoc($optionans)) {
           $option=$optionrow['options'];
           $id=implode("",explode(' ',$option));

           echo"<div class='mt-2 answercolumn' qno='$q_id' id='$id' value='$option'  onclick='checkans(this)' >$option</div>";
        }
         ?>
       </div>
     </div>
     <div class="col-md-2 col-sm-2 col-xs">
       &nbsp;
     </div>
     </div>




<header>
  <?php include 'includes/footer.php'?>
<script>
$gl_score=0;
function checkans(ans)
{

  $q_no=$(ans).attr('qno');
  $user_id="<?php echo $user_id?>";
  $clickedoption=$(ans).attr("value");
;
  $.ajax({

          type: "POST",
          url: "Services/checkansService.php",
          ContentType: "application/json",
          data: {q_no:$q_no, user_id:$user_id},
          cache: false,
          success: function(e){

               $optionans=JSON.parse(e);
               if($clickedoption==$optionans)
               {
                 $(ans).addClass("greenbar");
                 $gl_score+=1;
                 saveans(1,$q_no,$clickedoption);
                 savescore(1);
               }
               else {
                 $(ans).addClass("redbar");
                 $id="#"+$optionans.replace(" ","");
                 $($id).addClass("greenbar");
                 saveans(0,$q_no,$clickedoption);
                 savescore(0);
                 //$('body').css("pointer-events","none");
               }
               setTimeout(function()
               {
                   $('.contentmaindiv').attr('disabled', true);
               if($q_no<9)
                {changequestion($q_no);}
                else{
                  debugger;
                  $urid=<?php echo $GLOBALS['urid'];?>;
                  updateattemptstatus($urid)
                window.location='score.php?urid=<?php echo $GLOBALS['urid'] ?>';
                }
                $('.contentmaindiv').removeAttr('disabled');
              }, 1000);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('jqXHR:');
                          console.log(jqXHR);
                          console.log('textStatus:');
                          console.log(textStatus);
                          console.log('errorThrown:');
                          console.log(errorThrown);
                          }
      });
}
function updateattemptstatus($urid)
{
  $.ajax({

          type: "POST",
          url: "Services/updateattemptstatusservice.php",
          ContentType: "application/json",
          data: {urid:$urid},
          cache: false,
          success: function(e){
            debugger;
            console.log(e);
            ;
          },
          error: function(jqXHR, textStatus, errorThrown) {
            debugger;
            console.log('jqXHR:');
                          console.log(jqXHR);
                          console.log('textStatus:');
                          console.log(textStatus);
                          console.log('errorThrown:');
                          console.log(errorThrown);
                          }
      });

}
function changequestion($q_no)
{
  $.ajax({

          type: "POST",
          url: "Services/QuestionwithoptionService.php",
          ContentType: "application/json",
          data: {q_no:$q_no, user_id:$user_id},
          cache: false,
          success: function(e){
               $optionans=JSON.parse(e);
               $question=$optionans['question'];
               $options=$optionans["options"];
               $color=$optionans["color"];
               $('.contentmaindiv').css('background',$color);
               $qno=parseInt($('#mainqno').text());
               $('#mainqno').text($qno+1);
               $('.optioncover').text('');

               $('.question').val($question);
               $q_id=$q_no;
               $q_id++;
//5               $('.question').attr("id")="question"+($q_no+1)
               for($i=0;$i<$options.length;$i++)
               {;
                 $id=$options[$i].replace(/\s/g, '');
                 $('.optioncover').append("<div class='mt-2 answercolumn' qno="+$q_id+" id='"+$id+"' value='"+$options[$i]+"'  onclick='checkans(this)' >"+$options[$i]+"</div>");
               }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('jqXHR:');
                          console.log(jqXHR);
                          console.log('textStatus:');
                          console.log(textStatus);
                          console.log('errorThrown:');
                          console.log(errorThrown);
                          }
      });

}

function saveans($type,$q_no,$clickedoption)
{$urid=<?php echo$GLOBALS['urid']?>;
  $.ajax({

          type: "POST",
          url: "Services/saveuserans.php",
          ContentType: "application/json",
          data: {type:$type, q_no:$q_no,clickedoption:$clickedoption,urid:$urid},
          cache: false,
          success: function(e){
            console.log(e);
            ;
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('jqXHR:');
                          console.log(jqXHR);
                          console.log('textStatus:');
                          console.log(textStatus);
                          console.log('errorThrown:');
                          console.log(errorThrown);
                          }
      });

}

function savescore($score)
{$urid=<?php echo $_GET['urid'];?>;

  $.ajax({

          type: "POST",
          url: "Services/savescoreService.php",
          ContentType: "application/json",
          data: {urid:$urid, user_id:$user_id, score:$score},
          cache: false,
          success: function(e){
            ;
            console.log(e);

          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('jqXHR:');
            debugger;
                          console.log(jqXHR);
                          console.log('textStatus:');
                          console.log(textStatus);
                          console.log('errorThrown:');
                          console.log(errorThrown);
                          }
      });

}

</script>
