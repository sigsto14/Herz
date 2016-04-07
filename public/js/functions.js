

    var auto= $('#noti'), refreshed_content;  
    refreshed_content = setInterval(function(){
    auto.fadeOut('fast').load('#noti').fadeIn("fast");}, 
    3000);                    
    console.log(refreshed_content);                    
    return true; 
