$(document).ready(function(){$('#getstartbutton').click(function()
{
  $('.startcolumn').css('display','none');
  $('.secondcolumn').css('display','block');
});
if ($(window).width() < 990) {

   $('#mainwindow').removeClass('container');
   $('#mainwindow').addClass('container-fluid');
}



});
// change color
function change_bg_color(elem,$colorcode)
{
  $qno=$(elem).attr('qno');
  $('.question_block_square'+$qno).css('background-color',$colorcode);
}
