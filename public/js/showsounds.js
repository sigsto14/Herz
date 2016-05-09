               $(document).ready(function()
{

	  $('#pren').click(function()
  {
var userID = $(this).next('#userID').val();
var channelID = $('#channelID').val();
$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/pren.php',
  data: { userID: userID, channelID: channelID},  
        dataType: 'text',

   success: function(data){ 
if(data == 'removed'){
  $('#pren').removeClass('icon-eye2b');
  $('#pren').addClass('icon-eye2');
}
else if(data == 'added'){
  $('#pren').removeClass('icon-eye2');
  $('#pren').addClass('icon-eye2b');
}
  },
   error: function() {}


 });
  });
 $('#favAdd').click(function()
  {
var userID = $(this).next('#userID').val();
var soundID = $('#soundID').val();
$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/fav.php',
  data: { userID: userID, soundID: soundID},  
        dataType: 'text',

   success: function(data){ 

if(data == 'removed'){
  $('#favAdd').removeClass('icon-heart-2');
  $('#favAdd').addClass('icon-heart');

}
else if(data == 'added'){
  $('#favAdd').removeClass('icon-heart');
  $('#favAdd').addClass('icon-heart-2');

}
  },
   error: function() {}


 });
  });

 $('#plAdd').click(function()
  {

var soundID = $(this).next('#soundID').val();
var listID =  $(this).prev().find('option:selected').val(); 
$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/plAdd.php',
  data: { soundID: soundID, listID: listID},  
        dataType: 'text',

   success: function(data){ 

if(data == 'japp'){
 $('#feedback').html('<div class="alert gray"><button type="button" id="close" tooltip="OK" class="knp"><span class="glyphicon glyphicon-ok"></span></button>Pod tillagd </div>');
 	  $('#close').click(function(){
 $('#feedback').html('');
	  });
}

  },
   error: function() {}


 });
  });

  $('#commentBtn').click(function()
  {

var soundID = $('#soundID').val();
var userID =  $('#userID').val();
var comment =  $('#comment').val();
if(comment == ''){
  $('#commentFB').html('<div class="alert gray">Skriv i något för att kommentera</div>');
}
else {
$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/comments.php',
  data: { soundID: soundID, userID: userID, comment: comment},  
        dataType: 'text',

   success: function(data){ 

$('#commentbox').html(data);

  },
   error: function() {}


 });
}
  });

  $('#commentRefresh').click(function()
  {

var soundID = $('#soundID').val();


$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/comments.php',
  data: { soundID: soundID},  
        dataType: 'text',

   success: function(data){ 

$('#commentbox').html(data);

  },
   error: function() {}


 });

  });

	  $('#reportBtn').click(function(e)
{
  e.preventDefault();
var msg = $('#msg').val();
var username = $('#username').val();
var soundID = $('#soundID').val();
if(msg == ''){

  $('#feedback').html('<div class="alert gray"><button id="close" tooltip="OK" class="knp"><span class="glyphicon glyphicon-ok"></span></button>Motivera varför du vill anmäla klippet!</div>');
      $('#close').click(function(){

 $('#feedback').html('');
    });
}
else {

 $('#feedback').html('<div class="alert alert-danger"><button id="close" tooltip="OK" class="knp"><span class="glyphicon glyphicon-ok" style="color: red;"></span></button>Tack för att du hjälper oss hålla Herz trivsamt.</div>');
 	  $('#close').click(function(){

 $('#feedback').html('');
	  });

  $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/report.php',
  data: { msg: msg, username: username, soundID: soundID},  
        dataType: 'text',

   success: function(data){



    },
   error: function() {}

 });
}
});



});