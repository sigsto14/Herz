               $(document).ready(function()
{



$('#NotiTrigger').click(function(){
$('.notify').removeClass('NOTI');

  $('#prenNoti').trigger('submit');

  });

$('#prenNoti').submit(function(e){

e.preventDefault();

var userID = $('#userID').val();

 $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/notiPren.php',
  data: { userID: userID},  
        dataType: 'text',

   success: function(data){ 
  var current = document.getElementById('prenNotiLI').innerHTML;
var c = current.length;
var nr = c + 2;
var d = data.length;


if(d == nr){ 
  $('#prenNotiLI').html(data);
}
else {
if(nr < 10){
  $('#prenNotiLI').html(data);
}
else{
$('#prenNotiLI').html(data);
 $('.notify').addClass('NOTI');


$.titleAlert("Herz - Nytt material!", {
    requireBlur:false,
    stopOnFocus:true,
    interval:700
});
}
}
},
   error: function() {

   }
});
 });

              







});
           $(document).ready(function()
{


  $('#NotiTrigger2').click(function(){
$('.notify2').removeClass('NOTI');

  $('#favNoti').trigger('submit');

  });

$('#favNoti').submit(function(e){
e.preventDefault();

var userID = $('#userID2').val();

 $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/notiFav.php',
  data: { userID: userID},  
        dataType: 'text',

   success: function(data){ 
  var current = document.getElementById('favNotiLI').innerHTML;
var c = current.length;
var nr = c + 2;
var d = data.length;


if(d == nr){ 
  $('#favNotiLI').html(data);
}
else {
if(nr < 10){
  $('#favNotiLI').html(data);
}
else{

$('#favNotiLI').html(data);
 $('.notify2').addClass('NOTI');
$.titleAlert("Herz - Ny favoritmarkering!", {
    requireBlur:false,
    stopOnFocus:true,
    interval:700
});
}
}
},
   error: function() {

   }
});
 });



});

                      $(document).ready(function()
{


  $('#NotiTrigger3').click(function(){
$('.notify3').removeClass('NOTI');

  $('#comNoti').trigger('submit');

  });

$('#comNoti').submit(function(e){
e.preventDefault();

var userID = $('#userID3').val();

 $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/notiCom.php',
  data: { userID: userID},  
        dataType: 'text',

   success: function(data){ 
  var current = document.getElementById('comNotiLI').innerHTML;
var c = current.length;
var nr = c + 2;
var d = data.length;


if(d == nr){ 
  $('#comNotiLI').html(data);
}
else {
if(nr < 10){
  $('#comNotiLI').html(data);
}
else{
$('#comNotiLI').html(data);
 $('.notify3').addClass('NOTI');

$.titleAlert("Herz - Ny kommentar!", {
    requireBlur:false,
    stopOnFocus:true,
    interval:700
});
}
}
},
   error: function() {

   }
});
 });



});
           $(document).ready(function()
{


function interval(func, wait, times){
    var interv = function(w, t){
        return function(){
            if(typeof t === "undefined" || t-- > 0){
                setTimeout(interv, w);
                try{
                    func.call(null);
                }
                catch(e){
                    t = 0;
                    throw e.toString();
                }
            }
        };
    }(wait, times);

    setTimeout(interv, wait);
};
         interval(function(){
    interval(function(){
       $('.noti').trigger('submit');

}, 5000, 100000);
}, 5000, 100000);




});