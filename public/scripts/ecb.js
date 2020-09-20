jQuery(document).ready(function($){
   $("aside header").on('click' , function(){
    $(this).siblings('.menu-container').slideToggle();
    });
})