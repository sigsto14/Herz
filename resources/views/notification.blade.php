<div id="noti2">

<?php

              echo $notification;
?>
</div>


<script type="text/javascript">



$(document).ready(function(){ 

    var auto= $('#noti2'), refreshed_content;  
    refreshed_content = setInterval(function(){
    auto.fadeOut('fast').load('notification.blade.php').fadeIn("fast");}, 
    3000);                    
    console.log(refreshed_content);                    
    return true; 
});

</script>