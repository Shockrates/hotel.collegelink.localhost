$( function() {
    $( "#check_in_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#check_out_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
} );

//Used to submit logoutform with a tag
function submit() {
  
    let form = document.getElementById("logoutForm");
    form.submit();  
}