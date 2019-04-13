$(document).ready(function(){
  
   $("#DNI").keypress(function (e) {
     //Si la letra no es un dígito entonces no la tipea
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
     //Acepta solo valores númericos
     return false; 
     }
   });
   
    $('.link').hover(function(){
        $(this).css('background-color','#F5FFFA');
        $(this).css('color','green');
    },function(){
       $(this).css('color','blue');
     });
   
});