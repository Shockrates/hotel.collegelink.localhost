$( function() {
    $( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
} );

//Used to submit logoutform with a tag
function submit() {
  
    let form = document.getElementById("logoutForm");
    form.submit();  
}