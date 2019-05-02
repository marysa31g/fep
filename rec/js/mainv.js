
$(document).ready(function(){

  $('div#p1').show();
  $('div#p2').hide();
  $('div#p3').hide();
  $('div#p4').hide();
  $('div#p5').hide();
  $('div#p6').hide();

  $('#p1').click(function()
  {
    $('div#p1').show();
    $('div#p2').hide();
    $('div#p3').hide();
    $('div#p4').hide();
    $('div#p5').hide();
    $('div#p6').hide();
  });
  $('#p2').click(function()
  {
    $('div#p1').hide();
    $('div#p2').show();
    $('div#p3').hide();
    $('div#p4').hide();
    $('div#p5').hide();
    $('div#p6').hide();
  });
  $('#p3').click(function()
  {
    $('div#p1').hide();
    $('div#p2').hide();
    $('div#p3').show();
    $('div#p4').hide();
    $('div#p5').hide();
    $('div#p6').hide();
  });
  $('#p4').click(function()
  {
    $('div#p1').hide();
    $('div#p2').hide();
    $('div#p3').hide();
    $('div#p4').show();
    $('div#p5').hide();
    $('div#p6').hide();
  });
  $('#p5').click(function()
  {
    $('div#p1').hide();
    $('div#p2').hide();
    $('div#p3').hide();
    $('div#p4').hide();
    $('div#p5').show();
    $('div#p6').hide();
  });
  $('#p6').click(function()
  {
    $('div#p1').hide();
    $('div#p2').hide();
    $('div#p3').hide();
    $('div#p4').hide();
    $('div#p5').hide();
    $('div#p6').show();
  });

  /*↑ mas codigo*/

});

