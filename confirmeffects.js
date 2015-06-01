

$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
    if ($("#panel").is(':visible')) {
    $("html, body").animate({scrollTop: $("#panel").offset().top});
}    
 
  
  });
 
});
