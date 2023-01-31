$( function() {
    $( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
} );

//$('#logout').click(function(){ submit(); return false; });

function submit() {
  
    let form = document.getElementById("logoutForm");
    form.submit();  
}