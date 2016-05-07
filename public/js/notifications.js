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
}
}
},
   error: function() {

   }
});
 });

  



  interval(function(){
    interval(function(){
       $('#prenNoti').trigger('submit');
}, 5000, 100000);
}, 5000, 100000);

});

       