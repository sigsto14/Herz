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

var soundID = $('#soundID').val();
var listID =  $(this).prev().find('option:selected').val(); 
$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/plAdd.php',
  data: { soundD: soundID, listID: listID},  
        dataType: 'text',

   success: function(data){ 
alert(data);
if(data == 'removed'){
  $('#favAdd').removeClass('icon-heart-2');
  $('#favAdd').addClass('icon-heart');
}

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

  $('#feedback').html('<div class="alert alert-danger">Motivera varför du vill anmäla klippet!</div>');
}
else {

 $('#feedback').html('<div class="alert alert-danger">Tack för att du hjälper oss hålla Herz trivsamt. Läs mer om våra regler här: <a href="#">Regler</a></div>');
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