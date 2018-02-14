$( document ).ready(function() {
    console.log( "ready!" );
    
    $( ".titulo" ).click(function() {
      $( this ).next(".cont").toggle("blind");
    });
    
});